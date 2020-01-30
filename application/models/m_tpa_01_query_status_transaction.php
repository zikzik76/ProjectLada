<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Query View EOD Trade Progress Status
    Version             : 1.0 Production
=================================================================== 
-->


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_status_transaction extends CI_Model {

	public function get_data_status(){
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

		$query_stat = "SELECT DISTINCT BuyerFullpayment, SellerFulfillment,FullDelivery,ForcedClosed,SettlementSubmittedTime FROM SKD.EODTradeProgress Where BuyerId = 'BKPJ0588'";
		$rcd_stat = $db->execute($query_stat);

		foreach ($rcd_stat as $key){
			$result['BFP'] = $key['BuyerFullpayment'];
			// $data['SFF'] = $key['SellerFulfillment'];
			// $data['FD'] = $key['FullDelivery'];
			// $data['FC'] = $key['ForcedClosed'];
			// $data['SST'] = $key['SettlementSubmittedTime'];
		}



		return $result;
	}

}

/* End of file m_tpa_01_query_status.php */
/* Location: ./application/models/m_tpa_01_query_status.php */