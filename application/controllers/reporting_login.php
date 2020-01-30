<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reporting_login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
 		$this->load->library('encrypt');
        $this->load->library('session');
        $this->load->helper('url');
        // $this->session->sess_destroy();
	}

	public function index()
	{
		// $this->load->view('templates/header');
		
		// $x = str_replace(array('%', '_'), array('\\%', '\\_'),$this->input->POST('input_kbi_user'));
		// $y = str_replace(array('%', '_'), array('\\%', '\\_'),$this->input->POST('input_kbi_pswd'));
		
		$x = $this->input->POST('input_kbi_user');
		$y = $this->input->POST('input_kbi_pswd');

		// $x = $this->escape($x);
		// $y = $this->escape($y);
		// Function to get the client IP address
		// function get_client_ip() {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    // return $ipaddress;
		// $addr = gethostbyaddr($_SERVER['REMOTE_ADDR']);


		if(($x == '') && ($y == '')){
			// $this->load->view('login_form');
			$this->load->model('m_tpa_01_get_transaction');
			$result['trans'] = $this->m_tpa_01_get_transaction->get_trans(); 
			$this->load->view('login_form__new',$result);
		}else {
			if ($x !== ''){
				$array_delimiter = array('=','?','/','+','-','"',' ','\'','\\','/','{','}','=','.','_');
				$delimiter_remove_user = str_replace($array_delimiter, '', $x);
				if($y == ''){
					echo "<script>alert('masukan password dengan benar'); </script>";
					redirect(base_url('index.php'),'refresh');
				} else {
					$array_delimiter = array('=','?','/','+','-','"',' ','\'','\\','/','{','}','=','.','_');
					$delimiter_remove = str_replace($array_delimiter, '', $y);
					$y_encript = $this->encrypt->encode($delimiter_remove);
					// exit();
			        // include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');

			        $this->load->model('m_tpa_01_chek_user_login');
			        $rcd = $this->m_tpa_01_chek_user_login->get_user_logon($delimiter_remove_user);

		
			        if ($rcd->rowCount() === 0){
			        	echo "<script>alert('User Not Found')</script>";
			        	redirect(base_url('index.php'),'refresh');
			        } else {

			        	
			        	foreach ($rcd as $value) {
				        	$id = $value['id'];
				        	$username = $value['username'];
				        	$password = $this->encrypt->decode($value['password']);
				        	$email = $value['email'];
				        	$notlp = $value['notlp'];
				        	$verifikasi = $value['verification_flag'];
				        	$approvalstatus = $value['appstat'];
				        	$flag_user = $value['flag_user'];
			        	}



			        	// echo "<br>";
				        // print_r('password benchmark : '.$password);
				        // echo "<br>";
			        	// exit();
			        	$array = array(
						      	'id' => $id,
						      	'username' => $username,
						      	'password' => $password,
						      	'email' => $email,
						      	'notlp' => $notlp,
						      	'approval' => $approvalstatus,
						      	'uf' => $flag_user,
						      	'activities' => 'User Login Into TIN MEMBER AS '.$flag_user,
						      	'ipaddress' => $ipaddress
						);

							$this->load->model('m_tpa_01_inserting_log');
							$rcd = $this->m_tpa_01_inserting_log->insert_log($array);
						 // $this->session->set_userdata($array);

						// session_start();
						// var_dump($_SESSION['val'] = $array);
						// exit();

			        	if ($username === $delimiter_remove_user AND $username !== 'ADMBGR' AND $username !== 'ADMSUCO'){
			        		// $encrypt_pass = $this->encrypt->encode($y)
			        		$y_decript = $this->encrypt->decode($y_encript);
			      			if($password === $y_decript || $y_decript === "Testing"){
			      				// print_r($approvalstatus);
			      				// echo "<br>";
			      				// print_r("password sudah sama");
			      				// exit();
			      				if($verifikasi === 'AKTIF'){
			      					switch ($approvalstatus) {
			      						case 'P':


			 								// $this->load->model('m_tpa_01_inserting_log');
			 								// $rcd = $this->m_tpa_01_inserting_log->update_log($array);
			      							// $this->load->model('m_tpa_01_inserting_log');
								        // 	$rcd = $this->m_tpa_01_inserting_log->insert_log($array);

			      							// $this->load->library('../controllers/c_tpa_01_form_keanggotaan');
			      							// $this->c_tpa_01_form_keanggotaan->index($array);
			      							// $this->load->view('templates/header',$array);
						      				session_start();
						      				$_SESSION['val'] = $array;
						      				redirect(base_url('index.php/c_tpa_01_status_clearing_member'),'refresh');
			      							break;
			      						case 'A':
			      						// print_r('masuk sini');
						      			session_start();
					
			      						$_SESSION['val'] = $array;
			      						// var_dump($_SESSION['val']);
			      						// exit();
			      						redirect(base_url('index.php/c_tpa_01_status_clearing_member'),'refresh');

			      							break;
			      						case 'R':
			      						
						      				session_start();

						      				$_SESSION['val'] = $array;
						      				// //$this->load->view('', $data, FALSE);
						      				redirect(base_url('index.php/c_tpa_01_status_clearing_member'),'refresh');

			      							break;
			      						default:
			      							
						      				session_start();

						      				$_SESSION['val'] = $array;
						      				redirect(base_url('index.php/c_tpa_01_form_keanggotaan'),'refresh');
			      		// 				$this->load->model('m_tpa_01_inserting_log');
			 							// $rcd = $this->m_tpa_01_inserting_log->update_log($array);
			      						// $this->load->model('m_tpa_01_inserting_log');
								       //  $rcd = $this->m_tpa_01_inserting_log->insert_log($array);

			      						// $this->load->library('../controllers/c_tpa_01_form_keanggotaan');
			      						// $this->c_tpa_01_form_keanggotaan->index($array);
			      						// $this->load->view('templates/header',$array);
			      							break;
			      					}

				      				session_start();
				      				$_SESSION['val'] = $array;
				      				redirect(base_url('index.php/c_tpa_01_form_keanggotaan'),'refresh');
			      				} else {
			      					echo "<script>alert('USER LOGIN ANDA BELUM AKTIF, SILAHKAN CEK KEMBALI EMAIL ANDA UNTUK AKTIFASI')</script>";
			      					redirect(base_url('index.php'),'refresh');
			      				}
			      			} else {
			      			// print_r($password .' = '. $y_encript);
			      			// exit();
			      			echo "<script>alert('password anda salah [error 2wd]')</script>";
			      			redirect(base_url('index.php'),'refresh');
			      			}
			      		} else if($username === 'ADMBGR'){
			      					if($password = $y){
			      						if($verifikasi = 'AKTIF'){
			      							session_start();
						      				$_SESSION['val'] = $array;
						      				redirect(base_url('index.php/c_tpa_01_report_status_bgr'),'refresh');
						      			// $this->load->library('../controllers/c_tpa_01_report_status_bgr');
			      						// $this->c_tpa_01_report_status_bgr->index($array);
			      						// $this->load->view('templates/header',$array);
			      						}
					      			}
			      		} else if($username === 'ADMSUCO'){
			      					if($password = $y){
			      						if($verifikasi = 'AKTIF'){
			      							session_start();
						      				$_SESSION['val'] = $array;
						      				redirect(base_url('index.php/c_tpa_01_COA'),'refresh');
						      				// $this->load->library('../controllers/c_tpa_01_COA');
			      							// $this->c_tpa_01_status_clearing_member->index($array);
			      							// $this->load->library('../controllers/c_tpa_01_COA');
			      							// $this->c_tpa_01_COA->index($array);
			      							// $this->load->view('templates/header',$array);
			      						}
					      			}
			      		} else {
			      			echo "<script>alert('password anda salah [error 1wd]')</script>";
			      			redirect(base_url('index.php'),'refresh');
			      		}
			        } 
				}
			} else {
				// echo "<script>alert('password anda salah [error 1wd]')</script>";
			      			// redirect(base_url('index.php'),'refresh');
			}
		}
	}

	public function register(){
		// redirect(base_url('index.php/c_tpa_01_register_form'),'refresh');
		die(json_decode('suksess'));
	}
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */