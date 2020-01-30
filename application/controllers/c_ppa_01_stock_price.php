<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_stock_price extends CI_Controller {

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

	    $query = "SELECT * FROM ClearingMember";
	    $query_2 = "SELECT a.businessdate as businessdate, b.clearingmembercode as code,a.goldtype as goldtype,a.volume as volume,a.price as price FROM StockPrice as a LEFT JOIN ClearingMember as b ON a.cmid = b.id";
	    $rcd['value'] = $db->Execute($query);
	    $rcd['value_table'] = $db->Execute($query_2);

		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_stock_price_form',$rcd);
		$this->load->view('templates/footer');
	}

	public function update_stock_price()
	{
		$this->load->helper(array('form', 'url'));

		$bs_date = $this->input->post('date_stp');
		$cm_code = $this->input->post('cm_chb_stp');
		$gt = $this->input->post('gt_bbox');
		$vol = $this->input->post('vol_val');
		$price = $this->input->post('price_val_tsp');

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


	    $query = "INSERT INTO StockPrice (businessdate,cmid,goldtype,volume,price) VALUES ('".$bs_date."','".$cm_code."','".$gt."','".$vol."','".$price."')";

	    $rcd = $db->Execute($query);
	    echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
	   	redirect(base_url('index.php/c_ppa_01_stock_price'),'refresh');
	}

}

/* End of file c_ppa_01_stock_price.php */
/* Location: ./application/controllers/c_ppa_01_stock_price.php */