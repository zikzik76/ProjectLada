<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_update_input_cm_cmp_image extends CI_Model {

	public function update_clearing_member_and_CMProfile($Code){
		$i_code = substr($Code, 0,-4);
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

	    $Code = $db->escape($Code);
		$query_select_cmid = "SELECT CMID FROM SKD.ClearingMember WHERE code = ".$i_code;
		$rcd_select_cmid = $db->Execute($query_select_cmid);
		// print_r($query_select_cmid);
		// exit();
		$query_select_image_number = "SELECT MAX(ImageID) FROM SKD.Image";
	    $rcd_query_select_image_number = $db->Execute($rcd_query_select_image_number);
	    $calculate_image_number = $rcd_query_select_image_number + 1;
	    $query_identitiy__image_ON = "SET IDENTITY_INSERT SKD.Image ON;";
	    $rcd_identitiy__image_ON = $db->Execute($query_identitiy__image_ON);
	    $query_insert_compimage = "INSERT INTO SKD.Image(
	        							ImageID,
	        							ApprovalStatus,
	        							Image,
	        							CreatedBy,
	        							CreatedDate,
	        							LastUpdatedBy,
	        							LastUpdatedDate
	        							)
	        							VALUES 
	        							(
	        							".$calculate_image_number.",
	        							'P',
	        							'',
	        							'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        							GETDATE(),
	        							'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        							GETDATE()
	        							)";
	     // print_r($query_insert_compimage);
	    $rcd_query_insert_compimage = $db->Execute($query_insert_compimage);

	    $query_update_clearing = "UPDATE SKD.ClearingMember SET 
	    							PPKP = '', 
	    							Website = '', 
	    							AgreementNo ='', 
	    							AgreementDate = GETDATE(),
	    							CertNo = '',
	    							SPATraderNo ='',
	    							SPABrokerNo = ''
	    							PALNLicense = '',
	    							CompImageID = ".$calculate_image_number." WHERE CMID=".$rcd_select_cmid;
	    $rcd_update_clearing = $db->Execute($query_update_clearing);
	    $query_update_CMProfile = "UPDATE SKD.CMProfile SET
	    							PPKP = '',
	    							Website = '',
	    							AgreementNo = '',
	    							AgreementDate= GETDATE(),
	    							CertNo = '',
	    							SPATraderNo = '',
	    							SPABrokerNo = '',
	    							PALNLicense = '',
	    							CompImageID = ".$calculate_image_number." WHERE CMID=".$rcd_select_cmid;

	    $rcd_update_cmprofile = $db->Execute($query_update_CMProfile);
	    $query_update_clearing_member_compimage = "UPDATE SKD.ClearingMember SET CompImageID = ".$calculate_image_number;

	    $rcd_clearing_member_compimage = $db->Execute($query_update_clearing_member_compimage);

	     return TRUE;
	}
	

}

/* End of file update_input_CM_CMP_.php */
/* Location: ./application/models/update_input_CM_CMP_.php */