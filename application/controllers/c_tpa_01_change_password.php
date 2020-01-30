<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 15 Jun 2011
    Description         : Controller Reset Password
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  c_tpa_01_change_password extends CI_Controller {

	public function index()
	{
		// session_cache_limiter('private');
		// $cache_limiter = session_cache_limiter();

		/* set the cache expire to 30 minutes */
		// session_cache_expire(1);
		// $cache_expire = session_cache_expire();

		/* start the session */

		session_start();
		// session_start();
		
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));
         $this->load->model('m_tpa_01_query_appstat');
	    $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);
	    
        // $this->load->model('m_tpa_01_query_appstat');
        // $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);

        if($appstat === NULL) 
        {
        	echo 'Error 401 - CT120';
        } else {
        	foreach ($appstat as $val) {
	        	$priv['user_cm']  = $val['username'];
	        	$priv['flag_user'] = $val['flaguser'];
	        	$priv['type'] = $val['CMType'];
	        	$priv['stat_dom'] = $val['StatusDomisiliFlag'];
	        	$priv['stat_app'] = $val['ApprovalStatus'];
				$priv['stat_bd'] = $val['Business_Date'];
	        	$priv['stat_cielp'] = $val['Ceilling_price'];
	        	$priv['stat_cielf'] = $val['Floor_Price'];
	    	}
	    }

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_reset_password');
		$this->load->view('templates/footer');

	}

	public function validation_reset(){
		session_start();
		$this->load->library('encrypt');
		$rst_email = $this->input->post('rst_email');
		$rst_pass_old = $this->input->post('rst_pass_old');
		$rst_pass_old_encrypt = $this->encrypt->encode($rst_pass_old);
		$rst_pass_new = $this->input->post('rst_pass_new');
		$rst_c_pass_new = $this->input->post('rst_c_pass_new');
		$username = $_SESSION['val']['username'];
		
		$this->load->model('m_tpa_01_query_validation_reset');
		$result = $this->m_tpa_01_query_validation_reset->validation_data($rst_email,$rst_pass_old_encrypt,$rst_pass_new,$rst_c_pass_new,$username);

		// print_r($result);
		// exit();
		$count_account= count($result);
		// $value_ ='';
		// foreach ($result as $value) {
		// 	$value_ = $value['password'];
		// }
		// print_r($count_account);
		// echo "<br>";
		// echo "<pre>";
		// print_r($count_account);
		// echo "<pre>";
		// exit();
		if($count_account === NULL){
			echo '<div class="alert alert-danger alert-dismissable"><a href="" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>Email yang anda masukan tidak terdaftar password lama yang anda masukan salah</strong></div>';
		} else {
			$this->load->model('m_tpa_01_query_validation_reset');
			$result_reset = $this->m_tpa_01_query_validation_reset->reset_password_account($rst_email,$result,$rst_pass_new,$rst_c_pass_new,$username);
			
			// print_r('masuk ke sini');
			// exit();
			$this->load->library('encrypt');
			$this->load->library('email');

			$val['email'] = $this->encrypt->encode($rst_email);
			$val['old_pass'] = $rst_pass_old;
			$val['new_pass'] = $this->encrypt->encode($rst_pass_new);
			$val['c_new_pass'] = $this->encrypt->encode($rst_c_pass_new);
			$val['username'] = $this->encrypt->encode($username);

			// $val['email'] =$rst_email;
			// $val['old_pass_'] = $rst_pass_old;
			$val['new_pass_'] = $rst_pass_new;
			// $val['c_new_pass'] = $rst_c_pass_new;
			$val['username_'] = $username;


                    $this->email->initialize(array(
                      'protocol' => 'smtp',
                      'smtp_host' => '10.10.10.2',
                      'smtp_port' => 25,
                      'crlf' => '\r\n',
                      'newline' => '\r\n',
                      'mailtype' => 'html',
                      'wordwrap' => TRUE
                    ));

                    $data=array();
                    $mesg = $this->load->view('pages/v_tpa_01_reset_password_notification',$val, TRUE);
                    $this->email->from('Info@PTKBI.com', 'Info Reset Password Account Timah Informatics System (TIS)');
                    $this->email->to($rst_email);
                    $this->email->subject('Reset Password TIMAH PTKBI');
                    $this->email->message($mesg);
                    $this->email->send();

                    echo '<script> alert("Reset Password sudah dilakukan harap cek email anda");</script>';

			 redirect('http://'.$_SERVER['HTTP_HOST'],'refresh');

		}
		// print_r($count);
	}

	public function reset_password_validation(){
		$this->load->helper('url');
        $uri = $_SERVER['REQUEST_URI'];
        $this->load->library('session');
        $this->load->library('encrypt');

        // $this->encrypt->decode();
        // $config['enable_query_strings'] = FALSE;
        // print_r($uri);
        $str_len = strlen($uri);
        $str_find = substr($uri, strpos($uri,'?',0), $str_len);
        $str_replace = str_replace('?foo=','', $str_find);

		$explode_uri = explode('&&', $str_replace);        
        // print_r($str_replace);
        // echo "<pre>";
        // print_r($explode_uri);
        // echo "</pre>";

        $email = $this->encrypt->decode($explode_uri[0]);
        $old_pass = $this->encrypt->decode($explode_uri[1]);
        $new_pass = $this->encrypt->decode($explode_uri[2]);
        $c_new_pass = $this->encrypt->decode($explode_uri[3]);
        $_user_ = $this->encrypt->decode($explode_uri[4]);

        $this->load->model('m_tpa_01_query_validation_reset');
        $this->m_tpa_01_query_validation_reset->update_password($email,$old_pass,$new_pass,$c_new_pass,$_user_);
        // echo "<br>";
        // echo "<pre>";
        // print_r($email.' '.$a.' '. $b . ' ' .$c. ' '.$d);
        // echo "</pre>";
        echo '<script> alert("Reset Password Sukses silahkan Login");</script>';

		redirect('http://'.$_SERVER['HTTP_HOST'],'refresh');

	}

}

/* End of file  .php */
/* Location: ./application/controllers/ .php */