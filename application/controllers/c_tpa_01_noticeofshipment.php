<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 15 Jun 2011
    Description         : Controller Notice Of Shipment Upload
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('PUBPATH',str_replace('/system','',BASEPATH));

class c_tpa_01_noticeofshipment extends CI_Controller {

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
	    // print_r($_SESSION['val']['uf']);
	    // exit();
	    if($_SESSION['val']['uf'] === '100'){
	       $this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['value_2'] = $this->m_tpa_01_query_tradefeed->get_tradefeed_admin($_SESSION['val']['username']);
			$this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['wh'] = $this->m_tpa_01_query_tradefeed->get_warehouse_admin($_SESSION['val']['username']);
			$rcd_result['wh1'] = $this->m_tpa_01_query_tradefeed->get_warehouse_admin($_SESSION['val']['username']);
        } else {
			$this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['value'] = $this->m_tpa_01_query_tradefeed->get_tradefeed($_SESSION['val']['username']);
			$rcd_result['value_1'] = $this->m_tpa_01_query_tradefeed->get_tradefeed_approve($_SESSION['val']['username']);

			$this->load->model('m_tpa_01_query_tradefeed');
			$rcd_result['wh'] = $this->m_tpa_01_query_tradefeed->get_warehouse($_SESSION['val']['username']);
			$rcd_result['wh1'] = $this->m_tpa_01_query_tradefeed->get_warehouse($_SESSION['val']['username']);
        } 

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_noticeofshipment',$rcd_result);
		$this->load->view('templates/footer');

	}


		public function setemail(){
			session_start();

			$bst_array = $this->input->post('array_bst');
			$id_array = $this->input->post('array_id');
			$explode_id =explode(',',$id_array);
			$str = str_replace(' ','',$bst_array);
			$str_explode = explode(',',$str);

			$counter = 0;
			$arr_rcd = array();
			$shipping_instruction = '';
			$this->load->model('m_tpa_01_searchbtsfeed');
			foreach ($explode_id as $value) {

				$var[$counter] = $str_explode[$counter];
				$varId[$counter] = $value;
					// $counter++;
					// exit();
				$ress = $this->m_tpa_01_searchbtsfeed->get_bts($varId[$counter],$var[$counter]);
				$bts_no = '';
				$month = '';
				$year = '';
				$day = '';
				foreach ($ress as $val) {
					$bts_no = $val['SellerRef'];
					$month = $val['month'];
					$year = $val['year'];
					$day = $val['day'];
				}
				if($bts_no === ''){
					echo '<script>alert("BST Tidak ada dalam sistem")</script>';
				}else{
		 			// $this->load->library('email');
		             
		    //         $config['upload_path'] = APPPATH.'files/noticeofshipment';
		    //         $config['allowed_types'] = 'pdf|PDF';

		    //         $this->load->library('upload', $config);
		    //         $this->upload->do_upload('inputGroup');
		    //         $upload_data = $this->upload->data();

		 			// $this->email->initialize(array(
			   // 		'protocol' => 'smtp',
			   //      'smtp_host' => '10.10.10.2',
			   //      'smtp_port' => 25,
			   //      'crlf' => '\r\n',
			   //      'newline' => '\r\n',
			   //      'mailtype' => 'html',
			   //      'wordwrap' => TRUE
			   //      ));

			   //      $data=array();
			   //      // $mesg = $this->load->view('pages/v_tpa_01_notif_verification',$value, TRUE);
			   //       $this->email->attach($upload_data['full_path']);
		    //          // $this->email->attach('inputGroup');
			   //      $this->email->from('Info@PTKBI.com', 'Info notice of shipment upload');
			   //      $this->email->to('reza@ptkbi.com');
			   //      $this->email->subject('Notice Of shipment Upload');
			   //      $this->email->message($bts_no);
			   //      // $this->email->send();
		    //          if ($this->email->send()) {
		    //              echo "Mail Send";
		    //              return true;
		    //          } else {
		    //              show_error($this->email->print_debugger());
		    //          }
				}
			}
					print_r($var[$counter]);
			$counter++;


 			// $email = $this->input->post('inputGroup');
 			// print_r($_FILES[$email);
 			exit();

         }
}

/* End of file c_tpa_01_tradefeed.php 
/* Location: ./application/controllers/c_tpa_01_tradefeed.php */
// D:\\KBI\\RptEOD\\AK\\