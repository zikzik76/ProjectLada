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

	     $this->load->model('m_tpa_01_warehouse_dbo');
	    $data['value_brand'] = $this->m_tpa_01_warehouse_dbo->get_brand();

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_warehouse_management',$data);
		$this->load->view('templates/footer');
	}

	public function get_data_warehouse(){
		session_start();
		$date = str_replace(array('%', '_'), array('\\%', '\\_'),$this->input->post('st_date'));
		$warehouse = str_replace(array('%', '_'), array('\\%', '\\_'),$this->input->post('locationwarehouse'));
		$brand = str_replace(array('%', '_'), array('\\%', '\\_'),$this->input->post('brand'));
		// $date = $this->input->post('st_date');
		// $warehouse = $this->input->post('locationwarehouse');
		// $brand = $this->input->post('brand');
		$username = $_SESSION['val']['username'];
		// print_r()
		if($warehouse === ""){
			$warehouse = null;
		}

		if($brand === ""){
			$brand = null;
		}

		if($date === ""){
			$date = null;
		}

		// if($username !== 'admin'){
		// 	$this->load->model('m_tpa_01_get_warehouse_seller');
		// 	$result = $this->m_tpa_01_get_warehouse_seller->get_data($date,$username,$warehouse,$brand);
		// 	$var = "";

		// 	$counter = 0;
		// 	$arr_rcd = null;
		// 	foreach ($result as $value) {
		// 		$var['No'] = $counter+1;
		// 	 	$var['location'] = $value['location'];
		// 	 	$var['bstno'] = $value['bstno'];
		// 	 	$var['brand'] = $value['brand'];
		// 	 	$var['coano'] = $value['coano'];
		// 	 	$var['quantity'] = $value['vol'];
		// 	 	$var['total'] = $value['totalvolume'];
		// 	 	$var['total2'] = $value['totallot'];
		// 	 	$var['lot'] = $value['LOT'];

		// 		$arr_rcd[$counter] = $var;

		// 		$counter++;
		// 	}

		// } else {
		// 	$this->load->model('m_tpa_01_get_warehouse_seller');
		// 	$result = $this->m_tpa_01_get_warehouse_seller->get_data_admin($username,$warehouse,$brand);
		// 	$var = "";

		// 	$counter = 0;
		// 	$arr_rcd = array();
		// 	foreach ($result as $value) {
		// 		$var['No'] = $counter+1;
		// 	 	$var['location'] = $value['location'];
		// 	 	$var['bstno'] = $value['bstno'];
		// 	 	$var['brand'] = $value['brand'];
		// 	 	$var['coano'] = $value['coano'];
		// 	 	$var['quantity'] = $value['vol'];
		// 	 	$var['lot'] = $value['LOT'];
		// 	 	$var['total'] = $value['totalvolume'];
		// 	 	$var['total2'] = $value['totallot'];
		// 	 	// $var['download_btn'] = $value['bstno'];


		// 		$arr_rcd[$counter] = $var;

		// 		$counter++;
		// 	}

		// } 

		if($username !== 'admin'){
			if($warehouse !== null OR $brand !== null OR $date !== Null){
				$this->load->model('m_tpa_01_get_warehouse_seller');
				$result = $this->m_tpa_01_get_warehouse_seller->get_data($date,$username,$warehouse,$brand);
				$var = "";

				$counter = 0;
				$arr_rcd = null;
				foreach ($result as $value) 
				{
					$var['No'] = $counter+1;
				 	$var['location'] = $value['location'];
				 	$var['bstno'] = $value['bstno'];
				 	$var['brand'] = $value['brand'];
				 	$var['coano'] = $value['coano'];
				 	$var['quantity'] = $value['vol'];
				 	$var['total'] = $value['totalvolume'];
				 	$var['total2'] = $value['totallot'];
				 	$var['lot'] = $value['LOT'];

					$arr_rcd[$counter] = $var;

					$counter++;
				}
			} else {
				 redirect('https://'.$_SERVER['HTTP_HOST'],'refresh');
			}
		} else {
			if($warehouse !== null OR $brand !== null OR $date !== Null){
				$this->load->model('m_tpa_01_get_warehouse_seller');
				$result = $this->m_tpa_01_get_warehouse_seller->get_data_admin($username,$warehouse,$brand);
				$var = "";

				$counter = 0;
				$arr_rcd = array();
				foreach ($result as $value) {
					$var['No'] = $counter+1;
				 	$var['location'] = $value['location'];
				 	$var['bstno'] = $value['bstno'];
				 	$var['brand'] = $value['brand'];
				 	$var['coano'] = $value['coano'];
				 	$var['quantity'] = $value['vol'];
				 	$var['lot'] = $value['LOT'];
				 	$var['total'] = $value['totalvolume'];
				 	$var['total2'] = $value['totallot'];
				 	// $var['download_btn'] = $value['bstno'];


					$arr_rcd[$counter] = $var;

					$counter++;
				}
			} else {
				 redirect('https://'.$_SERVER['HTTP_HOST'],'refresh');
			}

		}


		die(json_encode($arr_rcd));
	}

	public function get_summary_warehouse(){
		session_start();
		// $date = $this->input->post('date_');
		// $warehouse = $this->input->post('warehouse_code');
		// $brand = $this->input->post('brand_');
		// $username = $_SESSION['val']['username'];
		$date = $this->input->post('st_date');
		$warehouse = $this->input->post('locationwarehouse');
		$brand = $this->input->post('brand');
		$username = $_SESSION['val']['username'];
		
		if($warehouse === ""){
			$warehouse = null;
		}

		if($brand === ""){
			$brand = null;
		}

		if($date === ""){
			$date = null;
		}

		// $test = $date.' - '.$warehouse;
		if($username !== 'admin'){
			$this->load->model('m_tpa_01_get_warehouse_seller');
			$result = $this->m_tpa_01_get_warehouse_seller->get_summary($date,$username,$warehouse,$brand);
			$var = "";

			$counter = 0;
			$arr_rcd = null;
			foreach ($result as $value) {

			 	$var['businessdate'] = $value['businessdate'];
			 	$var['product'] = $value['product'];
			 	$var['brand'] = $value['brand'];
			 	$var['lot'] = $value['lot'];
			 	$var['tonase'] = $value['tonase']/1000;

				$arr_rcd[$counter] = $var;

				$counter++;
			}

		} else {
			$this->load->model('m_tpa_01_get_warehouse_seller');
			$result = $this->m_tpa_01_get_warehouse_seller->get_summary_admin($username,$warehouse,$brand);
			$var = "";

			$counter = 0;
			$arr_rcd = array();
			foreach ($result as $value) {

				$var['businessdate'] = $value['businessdate'];
				$var['product'] = $value['product'];
				$var['brand'] = $value['brand'];
				$var['lot'] = $value['lot'];
				$var['tonase'] = $value['tonase']/1000;

				$arr_rcd[$counter] = $var;

				$counter++;
			}
		}

		die(json_encode($arr_rcd));
	}

	public function get_coa_bst_download(){
		 $this->load->helper(array('url','form','download'));
		$file_download = $this->input->POST('bst_num');
		// print_r($file_download);
		// exit();
		$str_replace = str_replace('/', '_', $file_download);


		// print_r($str_replace);
		// exit();
		 $files_imm = glob(APPPATH.'download\BST\\'.$str_replace.'.zip');
		 // print_r($files_imm);
		 // exit();
		if(!count($files_imm) > 0){
		echo "<script> alert('documents are not yet available, please be patient we are processing your reporting') </script>";
		// redirect(base_url('index.php/c_tpa_01_warehouse_management'),'refresh');
		} else {
			$rootPath = APPPATH.'download\BST\\'.$str_replace.'.zip';
			ob_end_clean();

			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.$str_replace.'.zip"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($rootPath));
			readfile($rootPath);
			// echo file_get_contents($rootPath);
			// exit();
		}
		// return false();
			// redirect(base_url('index.php/c_tpa_01_warehouse_management'),'refresh');		 
		 // $this->load->helper('download');
		 // $this->load->library('zip');
		// $bst_no = $this->input->post('data');
		// $changedelim = str_replace('/', '_', $bst_no);
		//  $path = APPPATH.'download/BST/BST_2019_08_V_KBI_00002.zip';
		//  // print_r($path);
		$text = 'Download finished';
		die(json_encode($text));
		// force_download(APPPATH.'download/BST/BST_2019_08_V_KBI_00002.zip',NULL);


	}



}

/* End of file c_tpa_01_warehouse_management.php */
/* Location: ./application/controllers/c_tpa_01_warehouse_management.php */