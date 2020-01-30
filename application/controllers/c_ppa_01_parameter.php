<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_parameter extends CI_Controller {

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

	    $query = "SELECT * FROM parameter";
	    $rcd['value'] = $db->execute($query);

		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_parameter_form', $rcd);
		$this->load->view('templates/footer');
	}

	public function update_paramenter(){

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
	    $nm = $this->input->post('pm_name_tb');
	    $v1 = $this->input->post('pmval_1_tb');
	    $v2 = $this->input->post('pmval_2_tb');
	    $query_1 = "INSERT INTO parameter (name,value1,value2) VALUES ('".$nm."','".$v1."','".$v2."')";
	    $rcd_1 = $db->execute($query_1);

	   // $query = "SELECT * FROM parameter";
	   //  $rcd['value'] = $db->execute($query);
	    echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
		redirect(base_url('index.php/c_ppa_01_parameter'),'refresh');
	} 
}

/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */