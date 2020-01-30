<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Get number of BST	
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_searchbtsfeed extends CI_Model {

	public function get_bts($n,$m){
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
	    // $var = $m;
	    // $str = implode('\',\'BST', $var);
	    // $str_replace = substr($str, 3,strlen($str)-1);
	    // echo "<br>";
	    // print_r($str_replace);
	    // echo "<br>";
	    // $query = "SELECT sellerRef FROM SKD.Tradefeed WHERE TradeFeedID = '".$n."'";
	    $query = "SELECT MONTH(BusinessDate) AS month,
	    			YEAR(BusinessDate) AS year,
	    			DAY(BusinessDate) AS day, SellerRef FROM SKD.Tradefeed WHERE TradeFeedID = '".$n."' AND SellerRef = '".$m."'";
	    $rcd = $db->Execute($query);
	    			// print_r($rcd);

	    			// exit();
	    // foreach ($rcd as $key) {
	    // 	$rcd_ = $key['SellerRef'];
	    // }

	    // print_r($$rcd['bts_no_']);
	    return $rcd;
	}
	

}

/* End of file m_tpa_searchbtsfeed.php */
/* Location: ./application/models/m_tpa_searchbtsfeed.php */