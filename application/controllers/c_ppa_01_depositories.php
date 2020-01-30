<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_depositories extends CI_Controller {

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
	    $query_2 = "SELECT a.depoid as depo_id,b.clearingmembercode as cm_code,a.businessdate as businessdate,a.goldtype as gd,a.saldo as saldo FROM depository as a left join ClearingMember as b ON a.cmid = b.id";
	    $rcd['value'] = $db->Execute($query);
	    $rcd['value_table'] = $db->Execute($query_2);

		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_depositories_form',$rcd);
		$this->load->view('templates/footer');
	}

	public function update_depo(){
		$this->load->helper(array('form', 'url'));

		$depo_code = $this->input->post('depo_code');
		$cm_code = $this->input->post('cm_bbox');
		$bs_date = $this->input->post('d_picker');
		$gt = $this->input->post('gt_bbox');
		$saldo = $this->input->post('saldo_tb');

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


	    $query = "INSERT INTO depository (depoid,cmid,businessdate,goldtype,saldo) VALUES ('".$depo_code."','".$cm_code."','".$bs_date."','".$gt."','".$saldo."')";

	    $rcd = $db->Execute($query);
	    echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
	   	redirect(base_url('index.php/c_ppa_01_depositories'),'refresh');
	}

}

/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */