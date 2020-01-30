<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_flaguser extends CI_Model {

	public function get_flaguser($a){
		 include (APPPATH.'libraries/adodb/adodb.inc.php');

        $db_host = 'KBIDEV-TIMAH-DBMS';
        $db_user = 'sadev_lada';
        $db_pass = 'Kbi@Kbi2021';
        $db_data = 'TIN_KBI';

        $db = NewADOConnection('odbc_mssql');
        $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
        $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
                $a = $db->escape($a);
        $query = "SELECT flaguser FROM SKD.RegistrationLoginMember WHERE username = '".$a."'";

        $rcd_ = $db->Execute($query);
        $rcd = '';
       	foreach ($rcd_ as $value) {
       		$rcd = $value['flaguser']; 
       	}

        return $rcd;

	}
	

}

/* End of file m_tpa_01_query_flaguser.php */
/* Location: ./application/models/m_tpa_01_query_flaguser.php */