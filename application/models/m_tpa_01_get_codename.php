<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_get_codename extends CI_Model {

	public function get_name($n){
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

	    $n = $db->escape($n);

	    $query = "SELECT Code,Name FROM SKD.ClearingMember WHERE  MemberStat = '".$n."'";
	    // // $query = "SELECT * FROM SKD.TradeFeed WHERE user_cm = '".$n."'";
	    // foreach ($query->result('Code') AS $code) {
	    // 	echo $code->Code;
	    // }
	    // exit();
	    // foreach ($db->execute($query) AS $value) {
	    // 	$code = $value['Code'];
	    // 	$name = $value['Name'];
	    // 	$rcd_array['code_ak'] = array($code);
	    // 	$rcd_array['name_ak'] = array($name);
	    // 	// print_r($rcd_Array_code);
	    // 	return $rcd_array;
	    // }
	    return $db->execute($query);
	    exit();

	}

}

/* End of file m_tpa_01_cek_anggota.php */
/* Location: ./application/models/m_tpa_01_cek_anggota.php */