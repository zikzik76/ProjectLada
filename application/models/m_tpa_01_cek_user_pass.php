<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cek_user_pass extends CI_Model {

	public function get_checkin($user,$encrypt_pass){
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

        $user = $db->escape($user);
        $encrypt_pass = $db->escape($encrypt_pass);
        
        $query = "SELECT * FROM SKD.RegistrationLoginMember where username = '".$user."' AND password = '".$encrypt_pass."'";
        $rcd = $db->execute($query);

        return $rcd;
	}	

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */