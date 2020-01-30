<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Reporting Dashboard For Member
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_report_status extends CI_Controller {

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
		
		$this->load->model('m_tpa_01_cek_anggota_reporting');
		$result = $this->m_tpa_01_cek_anggota_reporting->cek_anggota($_SESSION['val']['username']);
		
		$code_cm = '';
		foreach ($result as $value) {
			$code_cm = $value['Code'];
		}

		$this->load->model('m_tpa_01_query_tradefeed');
		$rcd_nosi = $this->m_tpa_01_query_tradefeed->get_notice_of_shipment($code_cm);

		foreach($rcd_nosi as $val){
			$test = $val['NoSI'];
		}

		$this->load->view('templates/header', $priv);
		$this->load->view('pages/v_tpa_01_report_status', $rcd_nosi);
		$this->load->view('templates/footer');
		
	}

	public function download_report(){

		$startdate_convert = strtotime($this->input->post('st_date'));
		$enddate_convert = strtotime($this->input->post('ed_date'));
		$get_start_day = date('d',$startdate_convert);
		$get_end_day = date('d',$enddate_convert);

		$typeOfReport = $this->input->post('typeOfReport');

		$this->load->model('m_tpa_01_cek_anggota_reporting');
		$result = $this->m_tpa_01_cek_anggota_reporting->cek_anggota($_SESSION['val']['username']);
		// echo "<br>";
		$code_cm = '';
		foreach ($result as $value) {
			$code_cm = $value['Code'];
			$initialcode = $value['Initial_code'];
			$cmid = $value['CMID'];
		}
		// $current_day = '13';
		$current_day = (int)date('d',$startdate_convert);
		$current_day_files = date('d',$startdate_convert);
		// $current_month = '6';
		$current_month = (int)date('m',$startdate_convert);
		$current_month_files = date('m',$startdate_convert);
		// $current_year = '2019';
		$current_year = date('Y',$startdate_convert);

		$report_date = $current_year.'-'.$current_month_files.'-'.$current_day_files;

		$this->load->model('m_tpa_01_parameter');
		$revision = $this->m_tpa_01_parameter->get_revision($report_date);

		if($get_start_day === NULL){
			// echo "<script> alert('Masukan tanggal dengan benar, End Date tidak dapat lebih kecil dari start date') </script>";
			echo "<script> alert('Date failed, example = 01/01/2000 - 02/01/2000') </script>";
		} else {
			switch ($typeOfReport) {
				case 'DFS':
				// $test = 'X:\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-1_'.$code_cm.'_DFS.pdf';
				// print_r($test);
				// exit();
				if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_DFS.pdf')){
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					exit();
				} else {
					$file_dfs = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_DFS.pdf';

		            header('Content-Type: application/pdf');
		            header('Content-Disposition: attachment; filename='.basename($file_dfs));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_dfs));
		            ob_clean();
		            flush();
		            readfile($file_dfs);

		            echo 'Download Report DFS Success';

				}
					break;
				case 'DT':
				if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_RincianKeuanganHarian.xlsx')){
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					exit();
				} else {
					$file_dt = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_RincianKeuanganHarian.xlsx';

		            header('Content-Type: application/xlsx');
		            header('Content-Disposition: attachment; filename='.basename($file_dt));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_dt));
		            ob_clean();
		            flush();
		            readfile($file_dt);

		            echo 'Download Report Daily Transaction Success';
				}
					break;
				case 'TR':
				if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_TradeRegister.pdf')){
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					exit();
				} else {
		            echo 'Download Report Trade Allocation Success';
					$file_tr = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_TradeRegister.pdf';

		            // header('Content-Type: application/pdf');
		            header('Content-Type: application/pdf');
		            header('Content-Disposition: attachment; filename='.basename($file_tr));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_tr));
		            ob_clean();
		            flush();
		            readfile($file_tr);

				}
					break;
				case 'SF':
				if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_SecFun.pdf')){
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					exit();
				} else {
		            echo 'Download Report SecFund Success';
					$file_tr = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_SecFun.pdf';

		            // header('Content-Type: application/pdf');
		            header('Content-Type: application/pdf');
		            header('Content-Disposition: attachment; filename='.basename($file_tr));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_tr));
		            ob_clean();
		            flush();
		            readfile($file_tr);

				}
					break;
				case 'CM':
				if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'CollateralIssuer.pdf')){
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					exit();
				} else {
		            echo 'Download Report Collateral Member Success';
					$file_tr = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_CollateralIssuer.pdf';

		            header('Content-Type: application/pdf');
		            header('Content-Disposition: attachment; filename='.basename($file_tr));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_tr));
		            ob_clean();
		            flush();
		            readfile($file_tr);

				}
					break;
				case 'NP':

				if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_NotaPemberitahuan.pdf')){
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					exit();
				} else {
					$file_np = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_NotaPemberitahuan.pdf';

		            header('Content-Type: application/pdf');
		            header('Content-Disposition: attachment; filename='.basename($file_np));
		            header('Content-Transfer-Encoding: binary');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($file_np));
		            ob_clean();
		            flush();
		            readfile($file_np);

		            echo 'Download Report Nota Pemberitahuan Success';
				}
					break;
				case 'KE':
					$files_ke = glob('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_*KontrakElektronik*');
					$counting = count($files_ke);
					// $files_ke = glob('X:\MonthlyMembership\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day_files.'_'.$code_cm.'*');
					if(!count($files_ke) > 0){
	
					echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					} else {
						for($i = 0 ; $i <= $counting ; $i++){
							$files_array = $files_ke[$i];
							$files_1 = $files_ke[0];
							$files_2 = $files_ke[1];
						}
						$rootPath = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day;
			 		ob_end_clean();

					$zipname = 'e-Contract_'.$code_cm.'.zip';
					$zipname_ = substr($zipname, 3, strlen($zipname));
				    $zip = new ZipArchive;
				    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
				    $files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($rootPath),
					    RecursiveIteratorIterator::LEAVES_ONLY
					);

					foreach ($files as $file)
					{
							// $replace_str = str_replace($rootPath,'e-Contract_'.$code_cm,$file);
						// $relativePath = substr($rootPath, strlen($rootPath) + 1);
					        $zip->addFile($files_1);
					        // echo "<script>console.log('".$files_1."');</script>";
					        $zip->addFile($files_2);
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
					break;
				case 'TC':
				// $test = 'X:\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-1_'.$code_cm.'_DFS.pdf';
				// print_r($test);
				// exit();
				$substr = substr($code_cm,0,1);
				// print_r($substr);
				// exit();
				if($substr === 'B'){

					if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_TradeConfirmationBuyer.pdf')){
						echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
						redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
						exit();
					} else {
						$file_dfs = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_TradeConfirmationBuyer.pdf';

			            header('Content-Type: application/pdf');
			            header('Content-Disposition: attachment; filename='.basename($file_dfs));
			            header('Content-Transfer-Encoding: binary');
			            header('Expires: 0');
			            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			            header('Pragma: public');
			            header('Content-Length: ' . filesize($file_dfs));
			            ob_clean();
			            flush();
			            readfile($file_dfs);

			            echo 'Download Report DFS Success';

					}
				} else {
					if(!file_exists('C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_TradeConfirmationSeller.pdf')){
						echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
						redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
						exit();
					} else {
						$file_dfs = 'C:\xampp\htdocs\application\download\RptEOD\AK\\'.$current_year.'\\'.$current_month.'\\'.$current_day.'\\'.$current_year.$current_month_files.$current_day_files.'-'.$revision.'_'.$code_cm.'_TradeConfirmationSeller.pdf';

			            header('Content-Type: application/pdf');
			            header('Content-Disposition: attachment; filename='.basename($file_dfs));
			            header('Content-Transfer-Encoding: binary');
			            header('Expires: 0');
			            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			            header('Pragma: public');
			            header('Content-Length: ' . filesize($file_dfs));
			            ob_clean();
			            flush();
			            readfile($file_dfs);

			            echo 'Download Report DFS Success';

					}
				}
					break;
				case 'NOS':
						$businessdate = $current_year.'-'.$current_month_files.'-'.$current_day_files;
						$this->load->model('m_tpa_01_buyer_noticeofshipment');
							$get_buyer = $this->m_tpa_01_buyer_noticeofshipment->get_exchangeref($cmid,$businessdate);
							foreach ($get_buyer as $val) {
								$value = $val['ExchangeRef'];
								// print_r($value);
								// exit();
							}
							$get_si_no = $this->m_tpa_01_buyer_noticeofshipment->get_NoSI($value,$businessdate);
						foreach ($get_si_no as $value_) {
								$get_str = $value_['NoSI'];
								$replace_get_str = str_replace('.', '_', $get_str);
								$replace_get_str_ = str_replace('/', '_', $replace_get_str);
	
						}

						if(!file_exists('C:\xampp\htdocs\application\download\NoticeOfShipment\\'.$replace_get_str_.'.pdf')){
							echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
							redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
							exit();
						} else {
							$file_NOS = 'C:\xampp\htdocs\application\download\NoticeOfShipment\\'.$replace_get_str_.'.pdf';

				            header('Content-Type: application/pdf');
				            header('Content-Disposition: attachment; filename='.basename($file_NOS));
				            header('Content-Transfer-Encoding: binary');
				            header('Expires: 0');
				            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				            header('Pragma: public');
				            header('Content-Length: ' . filesize($file_NOS));
				            ob_clean();
				            flush();
				            readfile($file_NOS);

				            echo 'Download Report Notice Of Shipment Success';

						}


	
					// if($initialcode == 'B'){
					// 	$businessdate = $current_year.'-'.$current_month_files.'-'.$current_day_files;
					// 	$this->load->model('m_tpa_01_buyer_noticeofshipment');
					// 	$result_count = $this->m_tpa_01_buyer_noticeofshipment->get_data_count($cmid,$businessdate);
					// 	$var = 0;
					// 	foreach ($result_count as $counting) {
					// 		$var = $counting['result_count'];
					// 	}
					// 	if($var == 0){
					// 		echo "<script>alert('No Document, please choose another date')</script>";
					// 		redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					// 	} else{

					// 		$this->load->model('m_tpa_01_buyer_noticeofshipment');
					// 		$get_buyer = $this->m_tpa_01_buyer_noticeofshipment->get_exchangeref($cmid,$businessdate);
					// 		foreach ($get_buyer as $val) {
					// 			$value = $val['ExchangeRef'];
					// 			// print_r($value);
					// 			// exit();
					// 		}
					// 		$get_si_no = $this->m_tpa_01_buyer_noticeofshipment->get_NoSI($value,$businessdate);
					// 		// print_r($get_si_no);
					// 		// exit();
					// 		$rootPath = 'C:\xampp\htdocs\application\download\NoticeOfShipment\\';
					//  		ob_end_clean();

					// 		$zipname = 'NoticeOfShipment_.zip';
					// 		$zipname_ = substr($zipname, 3, strlen($zipname));
					// 	    $zip = new ZipArchive;
					// 	    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
					// 	    $files = new RecursiveIteratorIterator(
					// 		new RecursiveDirectoryIterator($rootPath),
					// 		    RecursiveIteratorIterator::LEAVES_ONLY
					// 		);


					// 		// $counter = 0;
					// 		// $result_array = array();
					// 		foreach ($get_si_no as $value_) {
					// 				$get_str = $value_['NoSI'];
					// 				$replace_get_str = str_replace('.', '_', $get_str);
					// 				$replace_get_str_ = str_replace('/', '_', $replace_get_str);
					// 				// print_r($replace_get_str_);
					// 				// exit();
					// 			  $zip->addFile('C:\xampp\htdocs\application\download\NoticeOfShipment\\'.$replace_get_str_.'.pdf'); 

					// 			// $counter++;
					// 		}

					// 		$zip->close();

					// 		 header('Content-Description: File Transfer');
					// 		header('Content-Type: application/octet-stream');
					// 		header('Content-Disposition: attachment; filename='.$zipname);
					// 		header('Content-Transfer-Encoding: binary');
					// 		header('Expires: 0');
					// 		header('Cache-Control: must-revalidate');
					// 		header('Pragma: public');
					// 		header('Content-Length: ' . filesize($zipname));
					// 		readfile($zipname);
					// 	}
					// } else {
					// 	$businessdate = $current_year.'-'.$current_month_files.'-'.$current_day_files;
					// 	$this->load->model('m_tpa_01_seller_noticeofshipment');
					// 	$result_count = $this->m_tpa_01_seller_noticeofshipment->get_data_count($cmid,$businessdate);
					// 	$var = 0;
					// 	foreach ($result_count as $counting) {
					// 		$var = $counting['result_count'];
					// 	}
					// 	if($var == 0){
					// 		echo "<script>alert('No Document, please choose another date')</script>";
					// 		redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					// 	} else{

					// 		$this->load->model('m_tpa_01_seller_noticeofshipment');
					// 		$get_seller = $this->m_tpa_01_seller_noticeofshipment->get_exchangeref($cmid,$businessdate);
					// 		$rootPath = 'C:\xampp\htdocs\application\download\NoticeOfShipment\\';
					//  		ob_end_clean();

					// 		$zipname = 'NoticeOfShipment_.zip';
					// 		$zipname_ = substr($zipname, 3, strlen($zipname));
					// 	    $zip = new ZipArchive;
					// 	    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
					// 	    $files = new RecursiveIteratorIterator(
					// 		new RecursiveDirectoryIterator($rootPath),
					// 		    RecursiveIteratorIterator::LEAVES_ONLY
					// 		);


					// 		$counter = 0;
					// 		$result_array = array();
					// 		foreach ($get_seller as $value_seller) {
					
					// 			  $zip->addFile('C:\xampp\htdocs\application\download\NoticeOfShipment\\'.$value_seller['ExchangeRef'].'.pdf'); 

					// 			$counter++;
					// 		}

					// 		$zip->close();

					// 		 header('Content-Description: File Transfer');
					// 		header('Content-Type: application/octet-stream');
					// 		header('Content-Disposition: attachment; filename='.$zipname);
					// 		header('Content-Transfer-Encoding: binary');
					// 		header('Expires: 0');
					// 		header('Cache-Control: must-revalidate');
					// 		header('Pragma: public');
					// 		header('Content-Length: ' . filesize($zipname));
					// 		readfile($zipname);
					// 	}
					// }

					break;
				case 'IMM':
					// $this->load->helper('directory');
					// $files_imm = glob('X:\Membership\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day_files.'_'.$code_cm.'*');
					$files_imm = glob('C:\xampp\htdocs\application\download\Membership\\'.$code_cm.'.zip');

					// Set the parameters
					// $x = glob('Y:\*');
					// print_r($x);
					// exit();
					// $x = glob('C:\xampp\htdocs\application\download\Membership\\'.$code_cm.'\*');
					// // // print_r('file:\\\\10.10.10.170\kbi\Membership');
					// print_r($x);
					// exit();
					// print_r($x);
					// exit();
					// $path = '\\10.10.10.160\Membership\\'.$code_cm;

					// $user = "kbi";
					// $pass = "Jakarta01";
					// $drive_letter = "X";

					// system("net use ".$drive_letter.": \"".$path."\" ".$pass." /user:".$user." /persistent:no>nul 2>&1");
					// $location = $drive_letter.":/Membership/".$code_cm;

					// if ($handle = opendir($location)) {
					//     while (false !== ($entry = readdir($handle))) {
					// 	echo "$entry";
					//     } 
					//     closedir($handle);
					// }

					// exit();
					// print_r(require('X:\Membership'));
					// exit();
					// fopen('\\\\10.10.10.170\\Membership\\text.txt', 'r');
					// fopen('\\\\10.10.10.170\\D:\\', 'r');
					// $files_imm = glob(FCPATH.'*');
					// print_r($files_imm);
					// exit();
					// $file =  fopen("ftp://10.10.10.170:Jakarta01/" . 'D:/Membership/', "wb");
					 // echo "<a href='\\'.'\\10.10.10.170\kbi\Membership\BDG5\20190812_BDG5_FakturPajak.pdf'> TEST </a>";
					// print_r(folder_exist('x:/Membership'));
					// print_r(is_dir('X:\Membership\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day_files.'_'.$code_cm));
				// print_r($_SERVER['DOCUMENT_ROOT']);
				// print_r($current_year.$current_month_files.$current_day_files.'_'.$code_cm);
					// $files_imm = glob(base_url());
				// $handle = opendir();
					// opendir("x:/Membership");
					// exit();
					// var_dump(scandir('X:/'));
					// exit();

					
					if(!count($files_imm) > 0){
						echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
						redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					} else {
						$rootPath = 'C:\xampp\htdocs\application\download\Membership\\'.$code_cm.'.zip';
			 			ob_end_clean();

						/*
						$zipname = $rootPath.'.zip';
						$zipname_ = substr($zipname, 3, strlen($zipname));
						$zip = new ZipArchive;
						$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
						$files = new RecursiveIteratorIterator(
							new RecursiveDirectoryIterator($rootPath),
								RecursiveIteratorIterator::LEAVES_ONLY
						);

						foreach ($files as $name => $file)
						{
							if (!$file->isDir())
							{
								$filePath = $file->getRealPath();
								$relativePath = substr($filePath, strlen($rootPath) + 1);
								$zip->addFile($filePath, $relativePath);
							} 
						}

						// Zip archive will be created only after closing object
						$zip->close();
						*/
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.$code_cm.'.zip"');
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate');
						header('Pragma: public');
						header('Content-Length: ' . filesize($rootPath));
						readfile($rootPath);
					}
					break;
				case 'IAM':

				// $files_iam = glob('X:\AnnualMembership\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day_files.'_'.$code_cm.'*');
				$files_iam = glob('C:\xampp\htdocs\application\download\AnnualMembership\\'.$code_cm.'.zip');

				// 	if(!count($files_iam) > 0){
				// 	echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
				// 	redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
				// 	} else {
				// 	$rootPath = 'X:/AnnualMembership/'.$code_cm;
				// 	ob_end_clean();
				// 	$zipname = $rootPath.'.zip';
				// 	$zipname_ = substr($zipname, 3, strlen($zipname));
	
				//     $zip = new ZipArchive;
				//     $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);


				//     $files = new RecursiveIteratorIterator(
				// 	new RecursiveDirectoryIterator($rootPath),
				// 	    RecursiveIteratorIterator::LEAVES_ONLY
				// 	);

				// 	foreach ($files as $name => $file)
				// 	{
				// 	    if (!$file->isDir())
				// 	    {

				// 	        $filePath = $file->getRealPath();
				// 	        $relativePath = substr($filePath, strlen($rootPath) + 1);
				// 	        $zip->addFile($filePath, $relativePath);
				// 	    } 
				// 	}
				// 	$zip->close();


					
				//     header('Content-Description: File Transfer');
				// 	header('Content-Type: application/octet-stream');
				// 	header('Content-Disposition: attachment; filename='.$zipname);
				// 	header('Content-Transfer-Encoding: binary');
				// 	header('Expires: 0');
				// 	header('Cache-Control: must-revalidate');
				// 	header('Pragma: public');
				// 	header('Content-Length: ' . filesize($zipname));
				// 	readfile($zipname);
				// 	}
				if(!count($files_iam) > 0){
						echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
						redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					} else {
						$rootPath = 'C:\xampp\htdocs\application\download\AnnualMembership\\'.$code_cm.'.zip';
			 			ob_end_clean();

						/*
						$zipname = $rootPath.'.zip';
						$zipname_ = substr($zipname, 3, strlen($zipname));
						$zip = new ZipArchive;
						$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
						$files = new RecursiveIteratorIterator(
							new RecursiveDirectoryIterator($rootPath),
								RecursiveIteratorIterator::LEAVES_ONLY
						);

						foreach ($files as $name => $file)
						{
							if (!$file->isDir())
							{
								$filePath = $file->getRealPath();
								$relativePath = substr($filePath, strlen($rootPath) + 1);
								$zip->addFile($filePath, $relativePath);
							} 
						}

						// Zip archive will be created only after closing object
						$zip->close();
						*/
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.$code_cm.'.zip"');
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate');
						header('Pragma: public');
						header('Content-Length: ' . filesize($rootPath));
						readfile($rootPath);
					}
					break;
				case 'IFK':
					// $files_ifk = glob('X:\FeeClearing\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day_files.'_'.$code_cm.'*');
					$files_ifk = glob('C:\xampp\htdocs\application\download\FeeClearing\\'.$code_cm.'.zip');
					// print_r($files_ifk);
					// exit();
					// if(!count($files_ifk) > 0){
					// 	// echo 'file gagal di download';
					// 						echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
					// redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					// } else {
					// $rootPath = 'X:/FeeClearing/'.$code_cm;
					// ob_end_clean();
					// // $zipname = 'Fee_clearing_'.$code_cm.'\\'.$current_year.$current_month_files.$current_day.'.zip';
					// $zipname = $rootPath.'.zip';
					// // print_r($zipname);
					// // echo "<br>";
					// // print_r( count($rootPath));
					// // echo "<br>";
					// $zipname_ = substr($zipname, 3, strlen($zipname));
					// // print_r($zipname_);
					// // exit();
				 //    $zip = new ZipArchive;
				 //    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);


				 //    $files = new RecursiveIteratorIterator(
					// new RecursiveDirectoryIterator($rootPath),
					//     RecursiveIteratorIterator::LEAVES_ONLY
					// );

					// foreach ($files as $name => $file)
					// {
					//     // Skip directories (they would be added automatically)
					//     if (!$file->isDir())
					//     {
					//         // Get real and relative path for current file
					//         $filePath = $file->getRealPath();
					//         $relativePath = substr($filePath, strlen($rootPath) + 1);
					//         // Add current file to archive
					//         // print_r($getRealPath);
					//         // exit();
					//         $zip->addFile($filePath, $relativePath);
					//     } 
					// }

					// // Zip archive will be created only after closing object
					// $zip->close();

				 //    header('Content-Description: File Transfer');
					// header('Content-Type: application/octet-stream');
					// header('Content-Disposition: attachment; filename='.$zipname);
					// header('Content-Transfer-Encoding: binary');
					// header('Expires: 0');
					// header('Cache-Control: must-revalidate');
					// header('Pragma: public');
					// header('Content-Length: ' . filesize($zipname));
					// readfile($zipname);
					// }
					if(!count($files_ifk) > 0){
						echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
						redirect(base_url('index.php/c_tpa_01_report_status'),'refresh');
					} else {
						$rootPath = 'C:\xampp\htdocs\application\download\FeeClearing\\'.$code_cm.'.zip';
			 			ob_end_clean();

						/*
						$zipname = $rootPath.'.zip';
						$zipname_ = substr($zipname, 3, strlen($zipname));
						$zip = new ZipArchive;
						$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
						$files = new RecursiveIteratorIterator(
							new RecursiveDirectoryIterator($rootPath),
								RecursiveIteratorIterator::LEAVES_ONLY
						);

						foreach ($files as $name => $file)
						{
							if (!$file->isDir())
							{
								$filePath = $file->getRealPath();
								$relativePath = substr($filePath, strlen($rootPath) + 1);
								$zip->addFile($filePath, $relativePath);
							} 
						}

						// Zip archive will be created only after closing object
						$zip->close();
						*/
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.$code_cm.'.zip"');
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate');
						header('Pragma: public');
						header('Content-Length: ' . filesize($rootPath));
						readfile($rootPath);
					}
					break;
				
				default:
					echo "<script>alert('anda belum melakukan pilihan pada Reporting option');</script>";
					break;
			}
		}



	}
	


	// public function download_dfs()
	// {
	// 	force_download('DFS_data.pdf',);
	// }



}

/* End of file c_tpa_01_report_status.php */
/* Location: ./application/controllers/c_tpa_01_report_status.php */