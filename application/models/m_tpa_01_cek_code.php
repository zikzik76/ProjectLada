<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cek_code extends CI_Model {

	public function cek_code($n){
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

	    $n = $db->escape($n);

	    $query = "SELECT Code FROM SKD.ClearingMember WHERE Code='".$n."'";
	    $rcd = $db->Execute($query);

	    return $rcd;
	} 

	public function cek_code_($n,$e){
		 include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);

	   	$n = $db->escape($n);
	   	$e = $db->escape($e);

	    $query = "SELECT MONTH(EffectiveStartDate) as month_code, YEAR(EffectiveStartDate) AS year_code, ".$e." AS rootfile  FROM SKD.ClearingMember WHERE Code='".$n."'";
	    $rcd = $db->Execute($query);
	    
	    // print_r($query);
	    // exit();
	    return $rcd;
	}
	

}

/* End of file m_tpa_01_cek_code.php */
/* Location: ./application/models/m_tpa_01_cek_code.php */