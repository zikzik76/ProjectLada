<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Reporting Dashboard For BGR
    Version             : 1.0 Production
=================================================================== 
-->


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_report_status_bgr extends CI_Controller {

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

	public function index(){

		// stat_value()

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

	    // $this->load->view('')

		$this->load->view('templates/header', $priv);
		$this->load->view('pages/v_tpa_01_report_status_bgr');
		$this->load->view('templates/footer');
		
	}

	public function download_report(){
		// echo "<pre>";
		// print_r($this->input->post('st_date'));
		// print_r($this->input->post('ed_date'));
		// echo "<br>";
		$startdate_convert = strtotime($this->input->post('st_date'));
		$enddate_convert = strtotime($this->input->post('ed_date'));
		$get_start_day = date('d',$startdate_convert);
		$get_end_day = date('d',$enddate_convert);

		$typeOfReport = $this->input->post('typeOfReport');
		// echo "<pre>";
		// echo "</pre>";
		// echo "<br>";
		// echo "<pre>";
		// print_r($_SESSION['val']['username']);

		$this->load->model('m_tpa_01_cek_anggota_reporting');
		$result = $this->m_tpa_01_cek_anggota_reporting->cek_anggota($_SESSION['val']['username']);

		// echo "<br>";
		$code_cm = '';
		foreach ($result as $value) {
			$code_cm = $value['Code'];
		}
		// $current_day = '10';
		// $current_day = '14';
		// $current_day = date('d',$startdate_convert);
		// $current_month = '1';
		// $current_month = '06';
		// $current_month = date('m',$startdate_convert);
		// $current_year = '2019';
		// $current_year = date('Y',$startdate_convert);

		$current_day = (int)date('d',$startdate_convert);
		$current_day_files = date('d',$startdate_convert);
		$current_month = (int)date('m',$startdate_convert);
		$current_month_files = date('m',$startdate_convert);
		// print_r($current_day);
		$current_year = date('Y',$startdate_convert);
		$current_day_files = date('d',$startdate_convert);
		$current_month_files = date('m',$startdate_convert);

		$this->load->model('m_tpa_01_cek_last_revision');
		$result_last_revision = $this->m_tpa_01_cek_last_revision->get_last_revison($current_year,$current_month_files,$current_day_files);
		foreach ($result_last_revision as $val_revision) {
			$revision = $val_revision['Revision'];
		}

		switch ($typeOfReport) {
			case 'SI':
				# code...
				$files = glob('C:\xampp\htdocs\application\files\SI\\'.$current_year.$current_month_files.$current_day_files);
				// print_r($files);
				// exit();
				// $rootPath = 'Z:\application\files\SI\20190614';
				if(!count($files) > 0){
					echo '<script>alert("document not found");</script>';
					redirect(base_url('index.php/c_tpa_01_report_status_bgr'),'refresh');
				} else {

					$rootPath = 'C:\xampp\htdocs\application\files\SI\\'.$current_year.$current_month_files.$current_day_files;
					// $files_ifk = glob('X:\FeeClearing\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day.'_'.$code_cm.'*');
								// print_r($files_ifk);
								// exit();

					// print_r($rootPath);
					// exit();
					$zipname = 'All_Shipping_Instruction_'.$current_year.$current_month_files.$current_day_files.'.zip';
				    $zip = new ZipArchive;
				    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
				    ob_end_clean();


				    $files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($rootPath),
					    RecursiveIteratorIterator::LEAVES_ONLY
					);

					foreach ($files as $name => $file)
					{
					    // Skip directories (they would be added automatically)
					    if (!$file->isDir())
					    {
					        // Get real and relative path for current file
					        $filePath = $file->getRealPath();
					        $relativePath = substr($filePath, strlen($rootPath) + 1);
					        // Add current file to archive
					        $zip->addFile($filePath, $relativePath);
					    } 
					}

					// Zip archive will be created only after closing object
					$zip->close();

				    header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.$zipname);
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($zipname));
					readfile($zipname);
				}

				redirect(base_url('index.php/c_tpa_01_report_status_bgr'),'refresh');
				break;

			case 'TR':

					$files_ke = glob('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'*TradeRegister*');

					// print_r('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'*TradeRegister*');
					// exit();
					$counting = count($files_ke);

					if(!$counting > 0){
	
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status_bgr'),'refresh');
					} else {

					$rootPath = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day;
			 		ob_end_clean();

					$zipname = 'Trade_Allocation.zip';
					$zipname_ = substr($zipname, 3, strlen($zipname));
				    $zip = new ZipArchive;
				    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

					$set = '';
					for($i = 0 ; $i <= $counting -1; $i++){
						$num = $i;
						$set.$num = $files_ke[$num];
						$relativePath = substr($set.$num, strlen($rootPath) + 1);
						$zip->addFile($set.$num,$relativePath);
					}
				  
					$zip->close();

					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.$zipname);
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($zipname));
					readfile($zipname);
					}
				
				break;
			
			case 'KE':

					$files_ke = glob('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'*KontrakElektronik*');
					$counting = count($files_ke);

					if(!$counting > 0){
	
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status_bgr'),'refresh');
					} else {

					$rootPath = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day;
			 		ob_end_clean();

					$zipname = 'BPTB.zip';
					$zipname_ = substr($zipname, 3, strlen($zipname));
				    $zip = new ZipArchive;
				    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

					$set = '';
					for($i = 0 ; $i <= $counting -1; $i++){
						$num = $i;
						$set.$num = $files_ke[$num];
						$relativePath = substr($set.$num, strlen($rootPath) + 1);
						$zip->addFile($set.$num,$relativePath);
					}
				  
					$zip->close();

					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.$zipname);
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($zipname));
					readfile($zipname);
					}

				break;
			default:
				echo "<script>alert('file not found')</script>";
									redirect(base_url('index.php/c_tpa_01_report_status_bgr'),'refresh');
				break;
		}



		// echo "<script>alert('Document tidak ditemukan atau belum ter-Generate')</script>";
	   
	}

	public function get_ak(){
		$stat_val = $this->input->post('stat_val');

		// $result = '';
		if($stat_val === 'BU'){
			$stat_val_changing = 'Badan Usaha';
		} else {
			$stat_val_changing = 'Perorangan';
		}
		
		$this->load->model('m_tpa_01_get_codename');
		$rcd_ak = $this->m_tpa_01_get_codename->get_name($stat_val_changing);
		$var = "";
		// exit();
		// for ($i=0; $i < count($rcd_ak); $i++) { 
		$counter = 0;
		$arr_rcd = array();
		foreach ($rcd_ak as $value) {

		 	$var['name_ak'] = $value['Name'];
		 	$var['name_code'] = $value['Code'];
		 	$var['empty_val'] = $stat_val;

			$arr_rcd[$counter] = $var;

			$counter++;
		}
		die(json_encode($arr_rcd));
	
	}
}

/* End of file c_tpa_01_report_status.php */
/* Location: ./application/controllers/c_tpa_01_report_status.php */