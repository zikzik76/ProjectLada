<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_clearing_member extends CI_Controller {

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
	    $rcd['value'] = $db->Execute($query);

		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_clearing_member_form',$rcd);
		$this->load->view('templates/footer');
	}

	public function update_clearing(){
		$this->load->helper(array('form', 'url'));

		$cm_code = $this->input->post('cm_code');
		$cm_name = $this->input->post('cm_name');

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


	    $query = "INSERT INTO ClearingMember (clearingmembercode,clearingmembername) VALUES ('".$cm_code."','".$cm_name."')";
	    $rcd = $db->Execute($query);
	    echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
	   	redirect(base_url('index.php/c_ppa_01_clearing_member'),'refresh');
	}

}

/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */