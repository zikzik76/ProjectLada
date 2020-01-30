<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : downloading FORM
    Version             : 1.0 Production
=================================================================== 
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_download_form extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		//Do your magic here
		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form','download'));
	}

	public function index()
	{
		 $this->load->model('m_tpa_01_query_appstat');
        $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);

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
		$this->load->view('pages/v_tpa_01_download_form');
		$this->load->view('templates/footer');
	}

	public function download_doc(){
		$value_post = $this->input->post('seed');
		// print_r($value_post);
		// die(json_encode($value_post));
		// exit();
		switch ($value_post) {
				case 'APP':
				if(!file_exists('application/document/form/APP.docx')){
					echo "<script> alert('dokumen belum tersedia') </script>";
					redirect(base_url('index.php/c_tpa_01_download_form'),'refresh');
					exit();
				} else {
					$file_dfs = 'application/document/form/APP.docx';

		            header('Content-Type: application/octet-stream ; charset=utf-8');
		            header('Content-Disposition: attachment; filename='.basename($file_dfs));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_dfs));
		            ob_clean();
		            flush();
		            readfile($file_dfs);

				}
				break;
				case 'ADP':
				if(!file_exists('application/document/form/ADP.docx')){
					echo "<script> alert('dokumen belum tersedia') </script>";
					redirect(base_url('index.php/c_tpa_01_download_form'),'refresh');
					exit();
				} else {
					$file_dfs = 'application/document/form/ADP.docx';

		            header('Content-Type: application/octet-stream ; charset=utf-8');
		            header('Content-Disposition: attachment; filename='.basename($file_dfs));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_dfs));
		            ob_clean();
		            flush();
		            readfile($file_dfs);

				}
					break;
				default:
					// die(json_encode('document null'));
					break;
		}

	}

}

/* End of file c_tpa_01_download_form.php */
/* Location: ./application/controllers/c_tpa_01_download_form.php */