<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_validate_data extends CI_Model {

	public function get_validation_status()
	{
		include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
	    include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);

	    // $query = "SELECT * FROM "
	}

}

/* End of file m_tpa_01_validate_data.php */
/* Location: ./application/models/m_tpa_01_validate_data.php */