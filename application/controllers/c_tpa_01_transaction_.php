
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_transaction_ extends CI_Controller {

	public function index()
	{
		// print_r('Masuk sini');
		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));

        $startdate = $this->input->post('input_start_date');
	    $enddate = $this->input->post('input_end_date');
	    $buyer = $this->input->post('buyer_select');

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

		
 		$this->load->model('m_tpa_01_query_transaction');
		$data['buyer']= $this->m_tpa_01_query_transaction->get_buyer($_SESSION['val']['username'],$startdate,$enddate,$buyer);
  

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_tpa_01_transaction_',$data);
		$this->load->view('templates/footer');

	} 

	public function get_data_transaction(){
		session_start();
		// $this->load->helper('form');
        // $this->load->helper('html');
        // $this->load->helper('security');
        // $this->load->library('session');
		$this->load->helper(array('url','form'));


		$startdate = $this->input->post('input_start_date');
	    $enddate = $this->input->post('input_end_date');
	    $buyer = $this->input->post('buyer_select');

	    $this->load->model('m_tpa_01_query_transaction');
		$result = $this->m_tpa_01_query_transaction->get_trans($_SESSION['val']['username'],$startdate,$enddate,$buyer);
		$var = '';
		$counter = 0;
		$data_array = array();
		foreach ($result as $value) {
			$var['No'] = $counter+1;
			$var['startdate_'] = $value['StartDate'];
			$var['enddate_'] =$value['EndDate'];
			$var['brand_'] = $value['brand'];
			if($value['SettlementPrice'] == '' OR $value['SettlementPrice'] = NULL ){
				$var['average_'] = $value['SettlementPrice'];	
			} else {
				$var['average_'] = $value['Average'];	
			}
			$var['volume_'] = $value['volume'];
			$var['Sp'] = $value['SettlementPrice'];
			$data_array[$counter] = $var;
			$counter++;
		}


		die(json_encode($data_array));
		


	}


}