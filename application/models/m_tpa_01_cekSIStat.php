<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cekSIStat extends CI_Model {

	public function cek_si($n,$m){
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
	    $m = $db->escape($m);
	    
	    $query = "SELECT TradeFeedID,
	    				DAY(BusinessDate) AS day_trade,
	    				MONTH(BusinessDate) AS month_trade, 
					    YEAR(BusinessDate) AS year_trade,
					    ShippingInstructionUrl
	    FROM SKD.TradeFeed WHERE SellerRef = '".$n."' AND TradeFeedID = '".$m."'";
	    $rcd = $db->Execute($query);

	    return $rcd;
	}	

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */