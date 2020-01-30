<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 15 Jun 2011
    Description         : Controller View Status Member
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('PUBPATH',str_replace('/system','',BASEPATH)); // added

class C_tpa_01_status_clearing_member extends CI_Controller {

	public function index()
	{
		session_start();

		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));

	
		// $_SESSION = array('val' => $var);


        $this->load->model('m_tpa_01_query_appstat');
	    $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);
	    // echo "<br>";
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
	        	// $rcd['stat_'] = $val['StatusDomisiliFlag'];
	     	}
	    }


        if($_SESSION['val']['uf'] === '100'){
			$this->load->model('m_tpa_01_query_status_cm');
	        $rcd['value'] = $this->m_tpa_01_query_status_cm->cm_stat_admin($_SESSION['val']['username']);
        } else {
	        $this->load->model('m_tpa_01_query_status_cm');
	        $rcd['value'] = $this->m_tpa_01_query_status_cm->cm_stat($_SESSION['val']['username']); 
        } 
		$this->load->view('templates/header',$priv);	
		$this->load->view('pages/v_tpa_01_status_clearing_member',$rcd);	
		$this->load->view('templates/footer');
		// exit();



		// die(json_encode($rcd));	
	}

	public function updatedoc(){
		$this->load->helper('url');
		
		$field1 = $this->input->post('peizinan_seller');
		// echo "<br>";
		$bookId_code = $this->input->post('bookId_code');
		// echo "<br>";
		$field_dbase = $this->input->post('bookId_');
		// echo "<br>";
		$this->load->model('m_tpa_01_cek_code');
		$effective_cm = $this->m_tpa_01_cek_code->cek_code_($bookId_code,$field_dbase);
		$e_date = '';
		// echo "<pre>";
		// print_r($effective_cm);
		// echo "</pre>";
		// $e_month = '';
		// $e_year = '';
		// exit();
		foreach ($effective_cm as $value) {
			$e_month = $value['month_code'];
			$e_year = substr($value['year_code'],2);
			$root_file = $value['rootfile'];
		}
		$named = $bookId_code.'0'.$e_month.$e_year;
		// echo "<br>";
		// print_r('root file : '.$root_file);
		// exit();
		$path_remove = str_replace('application/files/'.$named.'/', '', $root_file);

		// echo "<br>";
		$rootpath = PUBPATH.'application/files/'.$named.'/'.$path_remove;
		// echo "<br>";
		// print_r(glob($rootpath));
		// echo "<br>";
		// print_r($path_remove);
		// echo "<br>";
		// exit();
		// print_r(unlink(base_url('application/files/'.$named.'/'.$path_remove)));
		// print_r($root_file);
		// exit();
		if($root_file == ''){

			$path_update = ''; //akte pendirian perusahaan

		  	$config['upload_path'] = APPPATH.'files/'.$named;
			$config['allowed_types'] = 'PDF|pdf';
			$config['encrypt_name'] = TRUE;
			// $config['max_size'] = '15';
			$config['raw_name'] = 'file_anggota';
			$config['file_name'] = $path_remove;
			$this->load->library('form_validation');
			$this->load->library('upload', $config);

			if ( !$this->upload->do_upload('upload_field')){
			echo 'File yang anda Upload '.$field_dbase.' tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				// $this->ftp->mkdir('/ftp/files/'.$concat_code_cm, DIR_WRITE_MODE);
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data();
				$path_full = $upload_data['full_path'];	
				$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
				$path_update = $str_replace;				
			}
			// print_r($path_update);
			// exit();
			
			include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
			include (APPPATH.'libraries/adodb/adodb.inc.php');
			$db_host = 'KBIDEV-TIMAH-DBMS';
		    $db_user = 'sadev_lada';
		    $db_pass = 'Kbi@Kbi2021';
		    $db_data = 'TIN_KBI';

		    $db = NewADOConnection('odbc_mssql');
		    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		    $db->SetFetchMode(ADODB_FETCH_ASSOC);

		    	 $query = "UPDATE SKD.ClearingMember SET ".$field_dbase." = '".$path_update."', flag_ftp = '' WHERE Code ='".$bookId_code."'";
			    $rcd_ = $db->execute($query);

			     $query_2 = "UPDATE SKD.CMProfile SET ".$field_dbase." = '".$path_update."', flag_ftp = '' WHERE Code ='".$bookId_code."'";
			     $rcd_cm = $db->Execute($query_2);
		
		} else {
			unlink($rootpath);

			$path_update = ''; //akte pendirian perusahaan

		  	$config['upload_path'] = APPPATH.'files/'.$named;
			$config['allowed_types'] = 'PDF|pdf';
			$config['encrypt_name'] = TRUE;
			// $config['max_size'] = '15';
			$config['raw_name'] = 'file_anggota';
			$config['file_name'] = $path_remove;
			$this->load->library('form_validation');
			$this->load->library('upload', $config);

			if ( !$this->upload->do_upload('upload_field')){
			echo 'File yang anda Upload '.$field_dbase.' tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				// $this->ftp->mkdir('/ftp/files/'.$concat_code_cm, DIR_WRITE_MODE);
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data();
				$path_full = $upload_data['full_path'];	
				$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
				$path_update = $str_replace;				
			}
			// print_r($path_update);
			// exit();
			
			include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
			include (APPPATH.'libraries/adodb/adodb.inc.php');
			$db_host = 'KBIDEV-TIMAH-DBMS';
		    $db_user = 'sadev_lada';
		    $db_pass = 'Kbi@Kbi2021';
		    $db_data = 'TIN_KBI';

		    $db = NewADOConnection('odbc_mssql');
		    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		    $db->SetFetchMode(ADODB_FETCH_ASSOC);

		    	 $query = "UPDATE SKD.ClearingMember SET ".$field_dbase." = '".$path_update."', flag_ftp = '' WHERE Code ='".$bookId_code."'";
			    $rcd_ = $db->execute($query);

			     $query_2 = "UPDATE SKD.CMProfile SET ".$field_dbase." = '".$path_update."', flag_ftp = '' WHERE Code ='".$bookId_code."'";
			     $rcd_cm = $db->Execute($query_2);
		}
		// exit();

		redirect(base_url('index.php/C_tpa_01_status_clearing_member'),'refresh');


	}

	public function validate_files()
	{
		$seed_validate = $this->input->post('seed');
		$this->load->model('m_tpa_01_document_status');
		$result = $this->m_tpa_01_document_status->check_all_doc_stat($seed_validate);
		$data_checked = $result;
		// print_r($data_checked);
		// exit();
		$result_document = '';
		if($data_checked === 'OK'){
			$result_document['status'] = "'Data was correct, Your Data was send to our team For Verification";
			// redirect(base_url('index.php/C_tpa_01_status_clearing_member'),'refresh');
		} else {
			$result_document['status'] = "Your document wasn't complete, please upload file again when status in Failed Uploaded";
		}
		// redirect('index.php/C_tpa_01_status_clearing_member','refresh');
		die(json_encode($result_document));
		// die();
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */