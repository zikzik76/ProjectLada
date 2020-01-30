<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_investor extends CI_Controller {

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
	    $query_2 = "SELECT b.clearingmembercode as code,a.investorcode as inv_code,a.investorname as inv_name FROM investor as a left join ClearingMember as b on a.cmid = b.id";
	    $rcd['value'] = $db->Execute($query);
	    $rcd['value_table'] = $db->Execute($query_2);



		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_investor_form',$rcd);
		$this->load->view('templates/footer');
	}

	public function update_investor(){
		$this->load->helper(array('form', 'url'));
		$cm_code = $this->input->post('cm_chb');
		$inv_code = $this->input->post('inv_code_tb');
		$inv_name = $this->input->post('inv_name_tb');

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

	    $query = "INSERT INTO Investor (cmid,investorcode,investorname) VALUES ('".$cm_code."','".$inv_code."','".$inv_name."') ";
	    $rcd = $db->Execute($query);
	    echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
	    redirect(base_url('index.php/c_ppa_01_investor'),'refresh');
	}

}

/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */