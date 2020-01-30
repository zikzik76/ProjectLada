<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_insert_seller extends CI_Model {

	public function ClearingMemberTable_seller($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$id_kep_seller,$doc_ekspor_timah,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name){

		// echo print_r('masuk');
		$i_code = substr($concat_code_cm, 0,-4);
		// print_r($i_code);
		// exit();

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

	    $query_cmid = "SELECT MAX(CMID) AS CMID  FROM SKD.ClearingMember ORDER BY CMID DESC";
	    $rcd_cmid = $db->Execute($query_cmid);
	    $CMID_NUM = '';
	    foreach ($rcd_cmid as $value) {
	       $CMID_NUM = $value['CMID'];
	    }
	     $CMID_SUM = $CMID_NUM + 1;
	    $query_identitiy_ON = "SET IDENTITY_INSERT SKD.ClearingMember ON;";
	    $rcd_identitiy_ON = $db->Execute($query_identitiy_ON);
		$query_clearing_member = "INSERT INTO  SKD.ClearingMember(
	        			Code,
	        			ApprovalStatus,
	        			EffectiveStartDate,
	        			CMID,
	        			Name,
	        			CMStatus,
	        			ExchangeStatus,
	        			AgreementType,
	        			CreatedBy,
	        			CreatedDate,
	        			LastUpdatedBy,
	        			LastUpdatedDate,
	        			ActionFlag,
	        			InitialMarginMultiplier,
	        			MinReqInitialMarginIDR,
	        			MinReqInitialMarginUSD,
	        			MemberType,
	        			MemberStat,
	        			NoAktaPendiri,
	        			NoAktaPerubahan,
	        			DomisiliPerusahaan,
	        			NPWP,
	        			IdentitasKepabean,
	        			EksportirTerdaftarTimah,
	        			PerizinanInstansiEksportir,
	        			user_cm
	        ) VALUES (
	        	'".$i_code."',
	        	'P',
	        	GETDATE(),
	        	".$CMID_SUM.",
	        	'".$calon."',
	        	'N',
	        	'P',
	        	'A',
	        	'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        	GETDATE(),
	        	'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        	GETDATE(),
	        	'I',
	        	0,
	        	0,
	        	0,
	        	'".$jenis_anggota."',
	        	'".$member_stat."',
	        	'".$akte_pendiri."',
	        	'".$akte_perubahan."',
	        	'".$domisili_perusahaan."',
	        	'".$npwp_perusahaan."',
	        	'',
	        	'',
	        	'".$perizinan_instansi."',
	        	'".$_SESSION['val']['username']."'
	        )";
	        // print_r($query_clearing_member);
	        $rcd_Clearing_member = $db->Execute($query_clearing_member);

	        $query_clearig_member_profile = "INSERT INTO SKD.CMProfile (
	        					CMID,
	        					ApprovalStatus,
	        					EffectiveStartDate,
	        					Name,
	        					Code,
	        					CMStatus,
	        					CreatedBy,
	        					CreatedDate,
	        					LastUpdatedBy,
	        					LastUpdatedDate,
	        					ActionFlag,
	        					InitialMarginMultiplier,
	        					MinReqInitialMarginIDR,
	        					MinReqInitialMarginUSD,
	        					Email,
	        					PhoneNumber,
	        					RegistrationDate,
	        					CMAccountNo,
	        					CMBankName,
	        					CMAccountName
	        				) VALUES (
	        					".$CMID_SUM.",
	        					'p',
	        					GETDATE(),
	        					'".$calon."',
	        					'".$i_code."',
	        					'N',
	        					'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        					GETDATE(),
	        					'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        					GETDATE(),
	        					'I',
	        					1,
	        					1,
	        					1,
	        					'".$email."',
	        					'".$notlp."',
	        					GETDATE(),
	        					'".$no_acc."',
	        					'".$acc_name."',
	        					'".$bank_name."')";
	       	$rcd_clearing_member_profile = $db->Execute($query_clearig_member_profile);
	    $query_identitiy_clearing_member_OFF = "SET IDENTITY_INSERT SKD.ClearingMember OFF";
	    $rcd_identitiy_clearing_member_OFF = $db->Execute($query_identitiy_clearing_member_OFF);

	       	$query_select_cmid = "SELECT CMID FROM SKD.ClearingMember WHERE Code = '".$i_code."'";
		$rcd_select_cmid = $db->Execute($query_select_cmid);
		foreach ($rcd_select_cmid as $value_cmid) {
			$get_cmid = $value_cmid['CMID'];
		}
		// print_r($query_select_cmid);
		// exit();
		$query_select_image_number = "SELECT MAX(ImageID) AS ImageID FROM SKD.Image";
	    $rcd_query_select_image_number = $db->Execute($query_select_image_number);
	    $calculate_image_number = '';
	    foreach ($rcd_query_select_image_number AS $value_image) {
	    	$calculate_image_number = $value_image['ImageID'] + 1;
	    }
	    // print_r($calculate_image_number);
	    // exit();

	    $query_identitiy_image_ON = "SET IDENTITY_INSERT SKD.Image ON";
	    $rcd_identitiy__image_ON = $db->Execute($query_identitiy_image_ON);
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
	    // exit();
	    $rcd_query_insert_compimage = $db->Execute($query_insert_compimage);

	    $query_update_clearing = "UPDATE SKD.ClearingMember SET 
	    							PPKP = '', 
	    							Website = '', 
	    							AgreementNo ='', 
	    							AgreementDate = GETDATE(),
	    							CertNo = '',
	    							SPATraderNo ='',
	    							SPABrokerNo = '',
	    							PALNLicense = '',
	    							CompImageID = ".$calculate_image_number." WHERE CMID=".$get_cmid;
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
	    							CompImageID = ".$calculate_image_number." WHERE CMID=".$get_cmid;

	    $rcd_update_cmprofile = $db->Execute($query_update_CMProfile);
	    $query_update_clearing_member_compimage = "UPDATE SKD.ClearingMember SET CompImageID = ".$calculate_image_number;

	    $rcd_clearing_member_compimage = $db->Execute($query_update_clearing_member_compimage);

	     return TRUE;
	}

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
		$query_select_cmid = "SELECT CMID FROM SKD.ClearingMember WHERE code = ".$i_code;
		$rcd_select_cmid = $db->Execute($query_select_cmid);
		$query_select_image_number = "SELECT MAX(ImageID) FROM SKD.Image";
	    $rcd_query_select_image_number = $db->Execute($rcd_query_select_image_number);
	    $calculate_image_number = $rcd_query_select_image_number + 1;
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
	        							'(BLOB)',
	        							'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        							GETDATE(),
	        							'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        							GETDATE()
	        							)";
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

	    $query_update_clearing_member_compimage = "UPDATE SKD.ClearingMember SET CompImageID = ".$calculate_image_number;

	    $rcd_update_clearing = $db->Execute($query_update_clearing);
	    $rcd_update_cmprofile = $db->Execute($query_update_CMProfile);
	    $rcd_clearing_member_compimage = $db->Execute($query_update_clearing_member_compimage);

	     return TRUE;

	} 

}

/* End of file m_tpa_01_query_insert_seller.php */
/* Location: ./application/models/m_tpa_01_query_insert_seller.php */