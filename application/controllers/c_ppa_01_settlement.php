<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_settlement extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form', 'url'));
		include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		include (APPPATH.'libraries/adodb/adodb.inc.php');
	    $db_host = '10.10.100.178';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi2015';
	    $db_data = 'EMASONLINE_DEV';
	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);

	   	$query2 = "SELECT businessdate, goldtype, price FROM SettlementPrice";
	    $rcd_2['value'] = $db->execute($query2);
		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_settlement_price_form', $rcd_2);
		$this->load->view('templates/footer');
	}

	public function update_settlement(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('phpexcel/PHPExcel');
		$this->load->library('phpexcel/IOFactory');

		$bd = $this->input->post('date_sp');
		$bd = date('Y-m-d', strtotime($bd));
		$gd = $this->input->post('cm_bbox');
		$pr = $this->input->post('price_val');
		include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		include (APPPATH.'libraries/adodb/adodb.inc.php');
	    $db_host = '10.10.100.178';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi2015';
	    $db_data = 'EMASONLINE_DEV';
	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);

	    $query = "INSERT INTO SettlementPrice (businessdate, goldtype, price) VALUES ('". $bd ."','".$gd."','".$pr."')";

	    $rcd = $db->execute($query);

	    $query2 = "SELECT businessdate, goldtype, price FROM SettlementPrice";
	    $rcd_2['value'] = $db->execute($query2);
		
		echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
		redirect(base_url('index.php/c_ppa_01_settlement'),'refresh');
	}

}

/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */