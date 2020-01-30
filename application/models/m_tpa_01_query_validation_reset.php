<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Validation for Reset a Password	
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_validation_reset extends CI_Model {

	public function validation_data($email,$rst_pass_old,$rst_pass_new,$rst_pass_c_new,$rst_user){

		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		$this->load->library('encrypt');
	    include (APPPATH.'libraries/adodb/adodb.inc.php');

	    $rst_pass_old_decrypt = $this->encrypt->decode($rst_pass_old);
		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);


	    $email = $db->escape($email);
	    $rst_pass_old = $db->escape($rst_pass_old);
	    $rst_pass_new = $db->escape($rst_pass_new);
	    $rst_pass_c_new = $db->escape($rst_pass_c_new);
	    $rst_user = $db->escape($rst_user);

	    $query = "SELECT * FROM SKD.RegistrationLoginMember WHERE email ='".$email."' AND username = '".$rst_user."'" ;
	    // print_r($query);
	    // echo "<br>";
	    $rcd = $db->Execute($query);
	    // echo "<br>";
	    // print_r($rcd );
	    // echo "<br>";
	    $rcd_decrypt = '';
	    $rcd_ = '';
	    foreach ($rcd as $value) {
	    	$rcd_ = $value['password'];
	    	$rcd_decrypt = $this->encrypt->decode($rcd_);
	    	// print_r($rcd_);
	    }
	    // echo "<br>";
	    // print_r($rcd_decrypt .'='. $rst_pass_old_decrypt );
	    // echo "<br>";
	    if($rcd_decrypt == $rst_pass_old_decrypt){
	    	return $rcd_;
	    	// print_r($rcd_decrypt);
	    } else {
	    	return FALSE;
	    }
	    // exit();
	}

	public function reset_password_account($email,$rst_pass_old,$rst_pass_new,$rst_pass_c_new,$rst_user){

		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		$this->load->library('encrypt');
		$rst_pass_old_reset = $this->encrypt->decode($rst_pass_old);
		// print_r($rst_pass_old);
		// echo "<br>";
		// print_r($rst_pass_old_reset);
		// exit();
	    include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);
	    // $query_check

	    $email = $db->escape($email);
	    $rst_pass_old = $db->escape($rst_pass_old);
	    $rst_pass_new = $db->escape($rst_pass_new);
	    $rst_pass_c_new = $db->escape($rst_pass_c_new);
	    $rst_user = $db->escape($rst_user);

	    $query_check = "SELECT password FROM SKD.RegistrationLoginMember WHERE username ='".$rst_user."' AND email = '".$email."'";
	    // print_r($query_check);
	    // echo "<br>";
	   	$rcd_checking = $db->Execute($query_check);
	    // echo "<br>";
	    // print_r($rcd_checking[0]);
	    foreach ($rcd_checking as $value) {
	    	$result = $value['password'];
	    }
	    $decrypt_password_par = $this->encrypt->decode($result);
	    // print_r($decrypt_password_par);
	    if($rst_pass_old_reset === $decrypt_password_par){
		    $query = "UPDATE SKD.RegistrationLoginMember SET password = '', c_password = '' WHERE 
		    			username ='".$rst_user."' AND email = '".$email."'";
		    $rcd = $db->Execute($query);
	    	
	    return $rcd;
	    } else {
	    	return false;
	    }


	}

	public function update_password($email,$rst_pass_old,$rst_pass_new,$rst_pass_c_new,$rst_user){
		$this->load->library('encrypt');
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    
	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);

	    	    $email = $db->escape($email);
	    $rst_pass_old = $db->escape($rst_pass_old);
	    $rst_pass_new = $db->escape($rst_pass_new);
	    $rst_pass_c_new = $db->escape($rst_pass_c_new);
	    $rst_user = $db->escape($rst_user);

	    $rst_pass_new_encrypt = $this->encrypt->encode($rst_pass_new);
	    $rst_pass_c_new_encrypt = $this->encrypt->encode($rst_pass_c_new);
	    
	    $query = "UPDATE SKD.RegistrationLoginMember SET password = '".$rst_pass_new_encrypt."', c_password = '".$rst_pass_c_new_encrypt."' WHERE 
	    			username ='".$rst_user."' AND email = '".$email."' AND password = ''";
	   	// print_r($query);
	   	// exit();
	    $rcd = $db->Execute($query);

	    return false;
	}
}

/* End of file m_tpa_01_query_validation_reset.php */
/* Location: ./application/models/m_tpa_01_query_validation_reset.php */