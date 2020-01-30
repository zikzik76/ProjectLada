<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 15 Jun 2011
    Description         : View Progress Of Transaction (EODTradeProgress)
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_transaction_progress extends CI_Controller {

	public function index()
	{

		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));

         $this->load->model('m_tpa_01_query_appstat');
        $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);
        // echo "<pre>";
        // print_r($appstat);
        // echo  "</pre>";
        // exit();

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


	    if($_SESSION['val']['uf'] === '100'){
	        $this->load->model('m_tpa_01_query_transaction');
			$data['value']= $this->m_tpa_01_query_transaction->get_data_admin($_SESSION['val']['username']);
			$this->load->model('m_tpa_01_cek_account_bank');
			$data['val'] = $this->m_tpa_01_cek_account_bank->get_account_admin($_SESSION['val']['username']);
        } else {
	        $this->load->model('m_tpa_01_query_transaction');
			$data['value']= $this->m_tpa_01_query_transaction->get_data($_SESSION['val']['username']);

			$this->load->model('m_tpa_01_cek_account_bank');
			$data['val'] = $this->m_tpa_01_cek_account_bank->get_account($_SESSION['val']['username']);
	       
        } 
        
		// $data['value_stat'] = $this->m_tpa_01_query_transaction->status_progress();
		// $data['value_lenght'] = count($data['value_stat']);
		// print_r($data['value']);
		// exit();
		// $result['value'] =$data;
		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_transaction_progress',$data);
		$this->load->view('templates/footer');

	}

	public function apload_form_app(){
		// print_r($x);
		// exit();
		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));
		$xchange = $this->input->post('exchange_upload');
		// $xchange = $this->input->post('Exchange');
		// print_r($x);

		$config['upload_path'] = APPPATH.'files/appform';
		$config['allowed_types'] = 'PDF|pdf';
		$config['encrypt_name'] = TRUE;
		$config['raw_name'] = 'file_anggota';
		$config['file_name'] = $xchange;
		$this->load->library('form_validation');
		$this->load->library('upload', $config);
		$file_path = 'app_form_upload'.$xchange;

		$app_form = ''; //akte pendirian perusahaan
		if ( !$this->upload->do_upload($file_path)){
		echo 'File yang anda Upload App Form tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			 // $msg=$this->upload->display_errors();
			 // print_r($msg);
		}else{
				// $this->ftp->mkdir('/ftp/files/'.$concat_code_cm, DIR_WRITE_MODE);
			$data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data();
			$path_full = $upload_data['full_path'];	
			$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
			$app_form = $str_replace;				
		// print_r($app_form);
		}

		$this->load->model('m_tpa_01_query_upload_app_form');
		$appload = $this->m_tpa_01_query_upload_app_form->update_tradeprogress_app_form($xchange,$app_form);

	}
}