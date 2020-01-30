<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_warehouse_management extends CI_Controller {


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

	    $this->load->model('m_tpa_01_warehouse_dbo');
	    $data['val'] = $this->m_tpa_01_warehouse_dbo->get_warehouse();

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_warehouse_management',$data);
		$this->load->view('templates/footer');
	}

	public function get_data_warehouse(){
		session_start();
		$date = $this->input->post('date_');
		$warehouse = $this->input->post('warehouse_code');
		$username = $_SESSION['val']['username'];
		// echo(phpinfo());
		// // $test = $date.' - '.$warehouse;
		// if($username !== 'admin'){
		// 	$this->load->model('m_tpa_01_get_warehouse_seller');
		// 	$result = $this->m_tpa_01_get_warehouse_seller->get_data($username,$warehouse);
		// 	$var = "";

		// 	$counter = 0;
		// 	$arr_rcd = array();
		// 	foreach ($result as $value) {

		// 	 	$var['location'] = $value['location'];
		// 	 	$var['bstno'] = $value['bstno'];
		// 	 	$var['brand'] = $value['brand'];
		// 	 	$var['coano'] = $value['coano'];
		// 	 	$var['quantity'] = $value['vol'];


		// 		$arr_rcd[$counter] = $var;

		// 		$counter++;
		// 	}

		// } else {
		// 	$this->load->model('m_tpa_01_get_warehouse_seller');
		// 	$result = $this->m_tpa_01_get_warehouse_seller->get_data_admin($username,$warehouse);
		// 	$var = "";

		// 	$counter = 0;
		// 	$arr_rcd = array();
		// 	foreach ($result as $value) {

		// 	 	$var['location'] = $value['location'];
		// 	 	$var['bstno'] = $value['bstno'];
		// 	 	$var['brand'] = $value['brand'];
		// 	 	$var['coano'] = $value['coano'];
		// 	 	$var['quantity'] = $value['vol'];


		// 		$arr_rcd[$counter] = $var;

		// 		$counter++;
		// 	}

		// }

		// print_r($arr_rcd);
		// exit();
		die(json_encode($arr_rcd));
	}

	public function get_coa_bst_download(){
		 $this->load->helper(array('url','form'));
		$bst_no = $this->input->post('data');
		$changedelim = str_replace('/', '_', $bst_no);
		// print_r($changedelim);
		$files_ke = glob('X:\BST\\'.$changedelim.'\*.pdf');
		// echo "<br>";
		// print_r('X:\BST\\'.$changedelim.'\*.pdf');
		// echo "<br>";
		// print_r($files_ke);
		// exit();
		$counting = count($files_ke);
		// $files_ke = glob('X:\MonthlyMembership\\'.$code_cm.'\\'.$current_year.$current_month_files.$current_day_files.'_'.$code_cm.'*');
		if(!count($files_ke) > 0){
	
		$str = "Document not available";
		die(json_encode($str));
		exit();
		// redirect(base_url('index.php/c_tpa_01_warehouse_mana'),'refresh');
		} else {
			for($i = 0 ; $i <= $counting ; $i++){
				// $files_array = $files_ke[$i];
				$files_1 = $files_ke[0];
				$files_2 = $files_ke[1];
			}
			$rootPath = 'X:\BST\\'.$changedelim;
			// print_r($files_1." - ".$files_2);
			// exit();
			// ob_end_clean();
			// ob_clean();
			$zipname = 'BST_COA_'.$changedelim.'.zip';
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
		        $zip->addFile($files_1);
		        $zip->addFile($files_2);
			}

			// Zip archive will be created only after closing object
			$zip->close();
			header('Content-Description: File Transfer');
			// header('Content-Type: application/octet-stream');
			header('Content-Type: application/json');
			header('Content-Disposition: attachment; filename='.$zipname);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($zipname));
			readfile($zipname);
			// header('content-type: application/json');
			 ob_clean();
			 flush();
			die(json_encode(array('DownloadPath' => base_url(). $zipname)));
			// $str = "Document Download Success, please check your download folder";
			// die(json_encode($str));

		}
	}

}

/* End of file c_tpa_01_warehouse_management.php */
/* Location: ./application/controllers/c_tpa_01_warehouse_management.php */