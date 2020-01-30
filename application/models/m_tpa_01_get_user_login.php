<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_get_user_login extends CI_Model {

	public function get_user_logon($delimiter_remove_user)
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
			    
			     $delimiter_remove_user = $db->escape($delimiter_remove_user); 			        
			        
			    $query_logon = "SELECT
						A.id AS id,
						A.username AS username,
						A.Password AS password,
						A.email AS email,
						A.notlp AS notlp,
						A.verification_flag AS verification_flag,
						B.ApprovalStatus AS appstat,
						A.flaguser AS flag_user
						FROM
						SKD.RegistrationLoginMember AS A
						LEFT JOIN SKD.ClearingMember AS B ON A.username = B.user_cm
						WHERE
						A.username = '".$delimiter_remove_user."'";

			    $rcd = $db->Execute($query_logon);


	return $rcd;
	}

}

/* End of file m_tpa_01_get_user_logon.php */
/* Location: ./application/models/m_tpa_01_get_user_logon.php */