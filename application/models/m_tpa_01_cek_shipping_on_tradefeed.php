<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cek_shipping_on_tradefeed extends CI_Model {

	public function Cek_trade($date,$cm,$user){
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

	    // $query = "SELECT Code FROM SKD.ClearingMember WHERE user_cm = '".$n."'";

		$date = $db->escape($date);
		$cm = $db->escape($cm);
		$user = $db->escape($user);	  
		
	    $query = "SELECT * FROM SKD.TradeFeed WHERE user_cm = '".$n."'";

	    $rcd = $db->execute($query);

	    return $rcd;
	}

}

/* End of file m_tpa_01_cek_anggota.php */
/* Location: ./application/models/m_tpa_01_cek_anggota.php */