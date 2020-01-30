<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 15 Jun 2011
    Description         : Controller Upload Document Shipping Instruction
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('PUBPATH',str_replace('/system','',BASEPATH));

class c_tpa_01_tradefeed extends CI_Controller {

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

	    if($_SESSION['val']['uf'] === '100'){
	       $this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['value'] = $this->m_tpa_01_query_tradefeed->get_tradefeed_admin($_SESSION['val']['username']);
			$this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['wh'] = $this->m_tpa_01_query_tradefeed->get_warehouse_admin($_SESSION['val']['username']);
			$rcd_result['wh1'] = $this->m_tpa_01_query_tradefeed->get_warehouse_admin($_SESSION['val']['username']);
        } else {
			$this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['value'] = $this->m_tpa_01_query_tradefeed->get_tradefeed($_SESSION['val']['username']);

			$this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['wh'] = $this->m_tpa_01_query_tradefeed->get_warehouse($_SESSION['val']['username']);
			$rcd_result['wh1'] = $this->m_tpa_01_query_tradefeed->get_warehouse($_SESSION['val']['username']);
        } 

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_tradefeed',$rcd_result);
		$this->load->view('templates/footer');

	}


	public function upload_doc()
	{
		// print_r('TEST');
		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));
		//$post['bst'] = $this->input->post('send_bst');
		$post['flag'] = $this->input->post('send_path');
		//$post['si'] = $this->input->post('si_num');
		print_r($post['si'] = $this->input->post('si'));
		print_r($post['tof'] = $this->input->post('tof'));
		print_r($post['boc'] = $this->input->post('boc'));
		print_r($post['cs'] = $this->input->post('cs'));
		print_r($post['sh'] = $this->input->post('sh'));
		print_r($post['pod'] = $this->input->post('pod'));

		// $bst_array = json_decode($this->input->post('bst_array'));
		// $id_array = json_decode($this->input->post('tdid'));

		$bst_array = $this->input->post('array_bst');
		$id_array = $this->input->post('array_id');

		$str = str_replace(' ','',$bst_array);

		$str_explode = explode(',',$str);
		$explode_id =explode(',',$id_array);
		$var = '';
		$varId = '';
		$counter = 0;
		exit();
		$this->load->model('m_tpa_01_searchbtsfeed');
		for ($i=0; $i < count($explode_id); $i++) { 
			$var = $str_explode[$i];
			$varId = $explode_id[$i];
			echo "<pre>";
			print_r($varId);
			echo "</pre>";
			echo "<br>";
			echo "<pre>";
			print_r($var);
			echo "</pre>";

			// print_r($varId);
			// exit();
			$ress[$i] = $this->m_tpa_01_searchbtsfeed->get_bts($varId,$var);

			$bts_no = '';
			$month = '';
			$year = '';
			$day = '';
			foreach ($ress[$i] as $value[$i]) {
				$bts_no = $value[$i]['SellerRef'];
				$month = $value[$i]['month'];
				$year = $value[$i]['year'];
				$day = $value[$i]['day'];
		
			}
			// print_r($bts_no);
			// echo "<br>";
			// print_r($ress[$i]);
			// return $i;
			// exit();
			$path_array[$i] = APPPATH.'files/SI/'.$year.'0'.$month.''.$day.'/'.$varId;

			print_r($path_array[$i]);
			exit();
			if($bts_no === ''){
				echo 'BST Tidak ada dalam sistem';
			} else {
					// print_r('masuk ke sini');
					$config['upload_path'] = $path_array[$i];
					$config['allowed_types'] = 'PDF|pdf';
					$config['encrypt_name'] = TRUE;
					$config['raw_name'] = 'file_anggota';
					$config['file_name'] = $bts_no;
					$this->load->library('form_validation');
					$this->load->library('upload', $config);
					$field_file = 'inputGroup';

					$shipping_instruction = ''; 
					// $path_file = 
				if(!file_exists($path_array[$i]))
				{
					mkdir($path_array[$i], 0777, true);
					if (!$this->upload->do_upload($field_file))
					{

						// echo '<script>alert("Upload failed, file format type must be PDF")</script>';
						 $msg = $this->upload->display_errors('', '');
						 echo $msg;
					}else{
						$data[$i] = array('upload_data' => $this->upload->data());
						$upload_data[$i] = $this->upload->data();
						// $upload_data = $this->files_model->insert_file($data['file_name']);
						$path_full = $upload_data[$i]['full_path'];	
						$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
						$shipping_instruction = $str_replace;		
									

						$this->load->model('m_tpa_01_query_tradefeed');
						$x[$i] = $this->m_tpa_01_query_tradefeed->update_SI($shipping_instruction,$varId,$var,$post['si']);

					}
					
				} else {
					if (!$this->upload->do_upload($field_file))
					{

						echo '<script>alert("Upload failed, file format type must be PDF")</script>';

					}else{
						$data[$i] = array('upload_data' => $this->upload->data());
						$upload_data[$i] = $this->upload->data();
						// $upload_data = $this->files_model->insert_file($data['file_name']);
						$path_full = $upload_data[$i]['full_path'];	
						$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
						$shipping_instruction = $str_replace;		
									

						$this->load->model('m_tpa_01_query_tradefeed');
						$x[$i] = $this->m_tpa_01_query_tradefeed->update_SI($shipping_instruction,$varId,$var,$post['si']);

					}
				}
			}
			redirect('index.php/c_tpa_01_tradefeed','refresh');
		}

	}

	public function updloaddoc(){

       $this->load->helper(array('url','form'));

		$bst = $this->input->post('bookId_');
		$trade_id = $this->input->post('bookId_code');

		$this->load->model('m_tpa_01_cekSIStat');
		$result = $this->m_tpa_01_cekSIStat->cek_si($bst,$trade_id);

		foreach ($result as $value) {
			$val_url = $value['ShippingInstructionUrl'];
			// $val_bd = $value['BusinessDate'];
			$val_day = $value['day_trade'];
			$val_month = $value['month_trade'];
			$val_year = $value['year_trade'];
			$val_id	= $value['TradeFeedID'];
		}
		$count_result = count($result);

			$config['upload_path'] = APPPATH.'files/SI/'.$val_year.'0'.$val_month.''.$val_day.'/'.$val_id;
			$config['allowed_types'] = 'PDF|pdf';
			$config['encrypt_name'] = TRUE;
			$config['raw_name'] = 'file_anggota';
			$config['file_name'] = $bst;


			$upload_naming = 'upload_field'.$trade_id;
			// print_r($upload_naming);
		if($val_url !== ''){
			$this->load->library('form_validation');
			$this->load->library('upload');
			$this->upload->initialize($config);
			// print_r(PUBPATH.$val_url);
			// exit();
			unlink(PUBPATH.$val_url);

			$path_update = '';

			if (!$this->upload->do_upload($upload_naming)){
					echo 'File yang anda Upload Shipping Instruction tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
						$error = array('error' => $this->upload->display_errors());
				// print_r($error);
						echo '<script>alert("Upload failed, file format type must be PDF , Erorr '+$error+'")</script>';
					}else{
						// $this->ftp->mkdir('/ftp/files/'.$concat_code_cm, DIR_WRITE_MODE);
						$data = array('upload_data' => $this->upload->data());
						$upload_data = $this->upload->data();
						$path_full = $upload_data['full_path'];	
						$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
						$path_update = $str_replace;		
						$this->load->model('m_tpa_01_siupdate');
						$result = $this->m_tpa_01_siupdate->si_update($path_update,$bst,$trade_id);
				}

			echo '<script>alert("Upload Success, Data Approval On Progress")</script>';
			redirect(base_url('index.php/c_tpa_01_tradefeed'),'refresh');


		} else {
			$this->load->library('form_validation');
			$this->load->library('upload');
			$this->upload->initialize($config);
			$path_update = '';

;
				if ( !$this->upload->do_upload($upload_naming)){
					echo 'File yang anda Upload Shipping Instruction tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
					}else{
						// $this->ftp->mkdir('/ftp/files/'.$concat_code_cm, DIR_WRITE_MODE);
						$data = array('upload_data' => $this->upload->data());
						$upload_data = $this->upload->data();
						$path_full = $upload_data['full_path'];	
						$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
						$path_update = $str_replace;		

						$this->load->model('m_tpa_01_siupdate');
						$result = $this->m_tpa_01_siupdate->si_update($path_update,$bst,$trade_id);
				}
				echo '<script>alert("Upload Success, Data Approval On Progress")</script>';
		redirect(base_url('index.php/c_tpa_01_tradefeed'),'refresh');

		}

		// echo($bst. ' - ' .$trade_id);
	}
}

/* End of file c_tpa_01_tradefeed.php */
/* Location: ./application/controllers/c_tpa_01_tradefeed.php */
// D:\\KBI\\RptEOD\\AK\\