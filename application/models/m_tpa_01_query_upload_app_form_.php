<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_upload_app_form extends CI_Model 
{

	public function update_tradeprogress_app_form($exchange, $urlpath)
	{
		include (APPPATH.'libraries/adodb/adodb.inc.php');
		$db_host = 'KBIDEV-TIMAH-DBMS';
        $db_user = 'sadev_lada';
        $db_pass = 'Kbi@Kbi2021';
        $db_data = 'TIN_KBI';

        $db = NewADOConnection('odbc_mssql');
        $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
        $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
        $db->SetFetchMode(ADODB_FETCH_ASSOC);

        $query = "UPDATE SKD.EODTradeProgress SET AppFormPath = '".$urlpath."' WHERE ExchangeRef = '".$exchange."'";
        // print_r($query);
        // exit();
        $result = $db->Execute($query);

        $text = 'OK';
        return $text;
	}

}

/* End of file m_tpa_01_query_upload_app_form.php */
/* Location: ./application/models/m_tpa_01_query_upload_app_form.php */