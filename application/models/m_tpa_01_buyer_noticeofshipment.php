<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_buyer_noticeofshipment extends CI_Model {

	public function get_exchangeref($n,$m){
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
		$m = $db->escape($m);
	    // $query = "SELECT Code FROM SKD.ClearingMember WHERE user_cm = '".$n."'";
	    $query = "SELECT DISTINCT ExchangeRef FROM SKD.TradeFeed WHERE BuyerCMID = '".$n."' AND BusinessDate = '".$m."' ORDER BY ExchangeRef ASC";

	    // print_r($query);
	    // exit();
	    $rcd = $db->execute($query);

	    return $rcd;
	}

	public function get_NoSI($n,$date){
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
	    $date = $db->escape($date);
	    // $query = "SELECT Code FROM SKD.ClearingMember WHERE user_cm = '".$n."'";
	    $query = "SELECT DISTINCT NoSI FROM SKD.TradeFeed WHERE ExchangeRef = '".$n."' AND BusinessDate = '".$date."'";

	    // print_r($query);
	    // exit();
	    $rcd = $db->execute($query);

	    return $rcd;
	}

	public function get_data_count($n,$m){
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
	    $m = $db->escape($m);
	    // $query = "SELECT Code FROM SKD.ClearingMember WHERE user_cm = '".$n."'";
	    $query = "SELECT DISTINCT COUNT(ExchangeRef) AS result_count FROM SKD.TradeFeed WHERE BuyerCMID = '".$n."' AND BusinessDate = '".$m."'";

	    // print_r($query);
	    // exit();
	    $rcd = $db->execute($query);

	    return $rcd;
	}

}

/* End of file m_tpa_01_buyer_noticeofshipment.php */
/* Location: ./application/models/m_tpa_01_buyer_noticeofshipment.php */