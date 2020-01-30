<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_insert_query extends CI_Model {

	public function insert_data($user,$encrypt_pass,$encrypt_cpass,$email,$tlp,$session_code,$captcha){
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

        $user = $db->escape($user);
        $encrypt_pass = $db->escape($encrypt_pass);
        $encrypt_cpass = $db->escape($encrypt_cpass);
        $email = $db->escape($email);
        $tlp = $db->escape($tlp);
        $session_code = $db->escape($session_code);
        $captcha = $db->escape($captcha);

        $query_insert = "INSERT INTO SKD.RegistrationLoginMember (
                    username,
                    password,
                    c_password,
                    email,
                    notlp,
                    session_captcha,
                    captcha,
                    verification_flag,
                    created_date,
                    flaguser
                    ) 
                VALUES 
                    (
                    '".$user."',
                    '".$encrypt_pass."',
                    '".$encrypt_cpass."',
                    '".$email."',
                    '".$tlp."',
                    '".$session_code."',
                    '".$captcha."',
                    'proses verifikasi',
                    GETDATE(),
                    '101'
                    )";
        $rcd = $db->Execute($query_insert);
        // print_r($query_insert);
        // exit();
        return $rcd;
	}
	

}

/* End of file m_tpa_01_insert_query.php */
/* Location: ./application/models/m_tpa_01_insert_query.php */