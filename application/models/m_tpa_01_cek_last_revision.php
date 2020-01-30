<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cek_last_revision extends CI_Model {

	public function get_last_revison($current_year,$current_month_files,$current_day_files){
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

	    // $query = "SELECT Code FROM SKD.ClearingMember WHERE user_cm = '".$n."'";
	    $query = "SELECT EODRevision AS Revision FROM SKD.EODRevision WHERE BusinessDate = '".$current_year.'-'.$current_month_files.'-'.$current_day_files."'";

	    // print_r($query);
	    // print_r($query);
	    // exit();
	    // echo "<pre>";
	    // // print_r($query);
	    // Echo "</pre>";
	    // exit();
	    $rcd = $db->execute($query);
	    
	    return $rcd;
	}

	

}

/* End of file m_tpa_01_buyer_noticeofshipment.php */
/* Location: ./application/models/m_tpa_01_buyer_noticeofshipment.php */