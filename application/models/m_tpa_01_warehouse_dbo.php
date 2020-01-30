<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_warehouse_dbo extends CI_Model {

	public function get_warehouse(){
		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';

		$db = NewADOConnection('odbc_mssql');
		$dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		$db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		$db->SetFetchMode(ADODB_FETCH_ASSOC);

		$query = "SELECT * FROM dbo.Warehouse";

		$rcd_ = $db->Execute($query);
		// echo "<pre>";
		// print_r($rcd_);
		// echo "</pre>";
		// exit();

		return $rcd_;
	}

	public function get_warehouse_admin(){
		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';

		$db = NewADOConnection('odbc_mssql');
		$dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		$db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		$db->SetFetchMode(ADODB_FETCH_ASSOC);

		$query = "SELECT * FROM dbo.Warehouse";

		$rcd_ = $db->Execute($query);
		// echo "<pre>";
		// print_r($rcd_);
		// echo "</pre>";
		// exit();

		return $rcd_;
	}
	
	public function get_brand(){
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';

		$db = NewADOConnection('odbc_mssql');
		$dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		$db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		$db->SetFetchMode(ADODB_FETCH_ASSOC);

		$query = "SELECT DISTINCT brand FROM SKD.StagingSellerAllocation";

		$rcd_ = $db->Execute($query);

		return $rcd_;
	}

}

/* End of file m_tpa_01_warehouse_dbo.php */
/* Location: ./application/models/m_tpa_01_warehouse_dbo.php */