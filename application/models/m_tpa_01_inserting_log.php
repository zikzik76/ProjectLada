<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_inserting_log extends CI_Model 
{
 	public function insert_log($array)
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
		$un = $db->escape($array['username']);
		// $query = "SELECT logonuser,username FROM SKD.ApplicationTINMemberLog WHERE username = '".$array['username']."'";
		$query = "SELECT logonuser,username FROM SKD.ApplicationTINMemberLog WHERE username = '".$array['username']."'";
		$rcd_check_logon = $db->Execute($query);
		$count_login_user = '';
		foreach ($rcd_check_logon as $value) {
			$count_login_user = $value['logonuser'];
		}
		// if($count_login_user < 1){
		$query = "INSERT INTO SKD.ApplicationTINMemberLog(
		   			username,
		   			email,
		   			notlp,
		 			logactivities,
		   			logactivitiesdate,
		   			logonuser,
		   			modulactivities,
		   			ipaddress,
		   			flag_user,
		   			approval_status
				) values 
				(
					'".$array['username']."',
					'".$array['email']."',
					'".$array['notlp']."',
					'".$array['activities']."',
					GETDATE(),
					'1',
					'Login',
					'".$array['ipaddress']."',
					'".$array['uf']."',
					'".$array['approval']."'
				)";

			    $rcd = $db->Execute($query);
		// } else {
		// 	echo "<script>alert('Another User has Login, please wait a momment')</script>";
		// 	redirect(base_url('index.php'),'refresh');

		// 	return false;

		// }

	return $rcd;
 	}
	

	public function update_log($array){
		 include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$un = $db->escape($array['username']);
		// $query = "SELECT logonuser,username FROM SKD.ApplicationTINMemberLog WHERE username = '".$array['username']."'";
		$current_date_report = $db->escape($current_date_report);

		$query = "SELECT logonuser,username FROM SKD.ApplicationTINMemberLog WHERE username = '".$array['username']."'";
		$rcd_check_logon = $db->Execute($query);
		$count_login_user = '';
		foreach ($rcd_check_logon as $value) {
			$count_login_user = $value['logonuser'];
		}
		if($count_login_user >= 1){
			$query = "UPDATE SKD.ApplicationTINMemberLog SET logonuser = 0 WHERE username = '".$array['username']."'";

			$rcd = $db->Execute($query);
		} else {
			echo "<script>alert('Another User has Login, please wait a momment')</script>";
			redirect(base_url('index.php'),'refresh');

			return false;

		}
		// if($rcd_check_logon['logonuser'] === )
			        


	return $rcd;
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */