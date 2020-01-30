<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_parameter extends CI_Model {
    public function get_revision($current_date_report){
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);

	    $query_select = "SELECT DISTINCT EODRevision FROM SKD.EODRevision WHERE BusinessDate = '".$current_date_report."'";
        $rcd_parameter = $db->Execute($query_select);
        
        foreach ($rcd_parameter as $value) {
            $rcd = $value['EODRevision']; 
        }
	    
	    return $rcd;
	}
}