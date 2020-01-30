<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Query Insert Buyer to Database Timah
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_insert_buyer extends CI_Model {

	public function ClearingMemberTable($Code,$calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$perizinan_instansi,$member_stat,$no_acc,$acc_name,$bank_name,$nib,$idp,$lk,$rfbn,$compro,$domisili,$status_usaha,$address){

		
		// echo "<pre>";
		// print_r($email);
		// echo "</pre>";
		// echo "<br>";
		// echo "<pre>";
		// print_r($notlp);
		// echo "</pre>";
		// exit();
		// echo print_r('masuk');
		// print_r($i_code);
		// exit();

		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		if ($status_usaha === 'dalam')
		{
			$status_usaha_ = 'D';

		} else if($status_usaha === 'luar'){
			$status_usaha_ = 'L';
		} else {
			echo 'status usaha tidak ada'; 
		}
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
	    $calon = $db->escape($calon);
	    $email = $db->escape($email);
	    $notlp = $db->escape($notlp);
	    $jenis_anggota = $db->escape($jenis_anggota);
	    $akte_pendiri = $db->escape($akte_pendiri);
	    $akte_perubahan = $db->escape($akte_perubahan);
	    $domisili_perusahaan = $db->escape($domisili_perusahaan);
	    $npwp_perusahaan = $db->escape($npwp_perusahaan);
	    $perizinan_instansi = $db->escape($perizinan_instansi);
	    $member_stat = $db->escape($member_stat);
	    $no_acc = $db->escape($no_acc);
	    $acc_name = $db->escape($acc_name);
	    $bank_name = $db->escape($bank_name);
	    $nib = $db->escape($nib);
	    $idp = $db->escape($idp);
	    $lk = $db->escape($lk);
	    $rfbn = $db->escape($rfbn);
	    $compro = $db->escape($compro);
	    $domisili = $db->escape($domisili);
	    $status_usaha = $db->escape($status_usaha);
	    $address = $db->escape($address);
		$i_code = substr($Code, 0,-4);

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
	        			Address,
	        			email,
	        			PhoneNumber,
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
	        			user_cm,
	        			siup,
	        			nib,
	        			IdentitasDiriPengurus,
	        			LaporanKeuangan,
	        			suratRefBankNegeri,
	        			companyProfile,
	        			domisili,
	        			StatusDomisiliFlag
	        ) VALUES (
	        	UPPER('".$i_code."'),
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
	        	'".$address."',
	        	'".$email."',
	        	'".$notlp."',
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
	        	'".$_SESSION['val']['username']."',
	        	'',
	        	'".$nib."',
	        	'".$idp."',
	        	'".$lk."',
	        	'".$rfbn."',
	        	'".$compro."',
	        	'".$domisili."',
	        	'".$status_usaha_."'
	        )";
	        // print_r($query_clearing_member);
	        // exit();
	        // print_r($query_clearing_member);
	        // exit();
	        $rcd_Clearing_member = $db->Execute($query_clearing_member);
	     //    $query_identitiy_ON_cmprofile = "SET IDENTITY_INSERT SKD.CMProfile ON;";
	    	// $rcd_identitiy_ON_cmprofile = $db->Execute($query_identitiy_ON_cmprofile);
	        $query_clearig_member_profile = "INSERT INTO SKD.CMProfile (
	        					CMID,
	        					ApprovalStatus,
	        					EffectiveStartDate,
	        					Name,
	        					Code,
	        					CMStatus,
	        					ExchangeStatus,
	        					CreatedBy,
	        					CreatedDate,
	        					LastUpdatedBy,
	        					LastUpdatedDate,
	        					ActionFlag,
	        					Address,
	        					Email,
	        					PhoneNumber,
	        					InitialMarginMultiplier,
	        					MinReqInitialMarginIDR,
	        					MinReqInitialMarginUSD,
	        					RegistrationDate,
	        					CMAccountNo,
	        					CMBankName,
	        					CMAccountName
	        				) VALUES (
	        					".$CMID_SUM.",
	        					'P',
	        					GETDATE(),
	        					'".$calon."',
	        					UPPER('".$i_code."'),
	        					'N',
	        					'P',
	        					'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        					GETDATE(),
	        					'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	        					GETDATE(),
	        					'I',
	        					'".$address."',
	        					'".$email."',
	        					'".$notlp."',
	        					1,
	        					1,
	        					1,
	        					GETDATE(),
	        					'".$no_acc."',
	        					'".$bank_name."',
	        					'".$acc_name."')";
	        // exit();
	    $rcd_clearing_member_profile = $db->Execute($query_clearig_member_profile);

	    $query_identitiy_clearing_member_OFF = "SET IDENTITY_INSERT SKD.ClearingMember OFF";
	     $rcd_identitiy_clearing_member_OFF = $db->Execute($query_identitiy_clearing_member_OFF);
	    
	    $query_insert_exchange = "INSERT INTO SKD.ClearingMemberExchange (
	    						CMID,				
								ExchangeId,				
								ApprovalStatus,			
								EffectiveStartDate,					
								CMExchangeCode,			
								CMType,				
								-- CMExchangeID,					
								ExchangeLicenseNo,				
								ExchangeLicenseDate,							
								CreatedBy,				
								CreatedDate,				
								LastUpdatedBy,				
								LastUpdatedDate,				
								EffectiveEndDate,					
								ApprovalDesc,					
								OriginalCMExchangeID,						
								ActionFlag	
	    						) 
	    						VALUES 
	    						(
	    						".$CMID_SUM.",
	    						'1',
	    						'P',
	    						GETDATE(),
	    						".$CMID_SUM.",
	    						'B',
	    						".$CMID_SUM.",
	    						GETDATE(),
	    						'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	    						GETDATE(),
	    						'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
	    						GETDATE(),
	    						NULL,
	    						'OK Temp',
	    						NULL,
	    						'I'
	    						)";
	    // print_r($query_insert_exchange);
	    $rcd_insert_exchange = $db->Execute($query_insert_exchange);

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
	    							AgreementType = 'A',
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


	    $query_update_registrasion_login = "UPDATE SKD.RegistrationLoginMember SET flaguser = '201' WHERE username = '".$_SESSION['val']['username']."'";
	    $rcd_query_update_registrasion_login = $db->Execute($query_update_registrasion_login); 

	    $notification = 'Upload sukses, Harap Login Kembali';

	     return $notification;
	}

	public function update_clearing_member_and_CMProfile($Code){
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
	    $Code = $db->escape($Code);		
		$i_code = substr($Code, 0,-4);

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


/* End of file model_insert_pembeli.php */
/* Location: ./application/models/model_insert_pembeli.php */