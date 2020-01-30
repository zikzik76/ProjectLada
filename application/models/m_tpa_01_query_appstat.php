<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_appstat extends CI_Model {

	public function approval_status($a){
		// session_start();

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
	    // $query_select = "SELECT
					// 	A.username,
					// 	A.flaguser,
					// 	C.CMType,
					// 	B.StatusDomisiliFlag,
					// 	B.ApprovalStatus,
					// 	D.DateValue AS Business_Date,
					// 	E.CeilingPrice AS Ceilling_price,
					// 	E.FloorPrice AS Floor_Price
					// FROM
					// 	SKD.RegistrationLoginMember AS A
					// LEFT JOIN SKD.CMProfile AS B ON A.username = B.user_cm
					// LEFT JOIN SKD.ClearingMemberExchange AS C ON B.CMID = C.CMID,
					//  SKD.Parameter AS D,
					//  SKD.CeilingPrice AS E
					// WHERE
					// 	A.username = '".$a."'
					// AND D.Code = 'BusinessDate'";
	    // print_r($query_select);
	    // exit();
		// $query_select = "SELECT
		// 					D.username,
		// 					D.flaguser,
		// 					C.CMType,
		// 					A.StatusDomisiliFlag,
		// 					A.ApprovalStatus,
		// 					E.DateValue AS Business_Date,
		// 					F.CeilingPrice AS Ceilling_price,
		// 					F.FloorPrice AS Floor_Price
		// 				FROM
		// 					SKD.ClearingMember AS A
		// 				LEFT JOIN SKD.CMProfile AS B ON A.user_cm = B.user_cm
		// 				LEFT JOIN SKD.ClearingMemberExchange AS C ON A.CMID = C.CMID
		// 				LEFT JOIN SKD.RegistrationLoginMember AS D ON A.user_cm = D.username,
		// 				 SKD.Parameter AS E,
		// 				 SKD.CeilingPrice AS F
		// 				WHERE
		// 					A.user_cm = '".$a."'
		// 				AND E.Code = 'BusinessDate'";
		// print_r($query_select);
		// exit();
	    $a = $db->escape($a);
		$query_select = "SELECT
							A.username,
							A.flaguser,
							D.CMType,
							C.StatusDomisiliFlag,
							C.ApprovalStatus,
							E.DateValue AS Business_Date,
							F.CeilingPrice AS Ceilling_price,
							F.FloorPrice AS Floor_Price
						FROM
							SKD.RegistrationLoginMember AS A
						LEFT JOIN SKD.ClearingMember AS B ON A.username = B.user_cm
						LEFT JOIN SKD.CMProfile AS C ON B.CMID = C.CMID
						LEFT JOIN SKD.ClearingMemberExchange AS D ON C.CMID = D.CMID,
						 SKD.Parameter AS E,
						 SKD.CeilingPrice AS F
						WHERE
							A.username = '".$a."'
						AND E.Code = 'BusinessDate'";
	    $rcd_appsatat = $db->Execute($query_select);
	    
	    return $rcd_appsatat;

	}

	public function approval_status_admin($a){
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
	    // $query_select = "SELECT ApprovalStatus FROM SKD.ClearingMember Where user_cm = '".$a."'";
	    $query_select = "SELECT A.username,A.flaguser,C.CMType,B.StatusDomisiliFlag,B.ApprovalStatus
	    				 FROM SKD.RegistrationLoginMember AS A
	    				 LEFT JOIN SKD.CMProfile AS B ON A.username = B.user_cm
	    				 LEFT JOIN SKD.ClearingMemberExchange AS C ON B.CMID = C.CMID";
	    
	    $rcd_appsatat = $db->Execute($query_select);
	    
	    return $rcd_appsatat;
	}
	

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */