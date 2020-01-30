<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_document_status extends CI_Model {

	public function check_all_doc_stat($n){

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

	    $n = $db->escape($n);
	    
	    $query = "SELECT A.Code AS code ,A.CMID as cmid, A.StatusDomisiliFlag as flag, B.CMType as type 
	    			From 
	    			SKD.ClearingMember AS A LEFT JOIN
	    			SKD.ClearingMemberExchange AS B ON A.CMID = B.CMID WHERE A.Code = '".$n."'";

	    // print_r($query);
	    $rcd = $db->Execute($query);

	   	// print_r($rcd['type']);
	   	foreach ($rcd as $val) {
	   		$type_peserta = $val['type'];
	   		$flag_peserta = $val['flag'];
	   		$cmid_peserta = $val['cmid'];
	   	}
	   	if($type_peserta === 'B' AND $flag_peserta === 'D'){
	   			$query_cek_all = "SELECT 
	   						NoAktaPendiri,
		        			NoAktaPerubahan,
		        			DomisiliPerusahaan,
		        			NPWP,
		        			PerizinanInstansiEksportir,
		        			nib,
		        			IdentitasDiriPengurus,
		        			LaporanKeuangan
		        			FROM SKD.ClearingMember 
		        			WHERE CMID = '".$cmid_peserta."'";
		       // print_r($query_cek_all);
		       // exit();
		       $rcd_cek_all = $db->Execute($query_cek_all);

		       foreach ($rcd_cek_all as $value) {
		       		$NoAktaPendiri = $value['NoAktaPendiri'];
		       		$NoAktaPerubahan  = $value['NoAktaPerubahan'];
		        	$DomisiliPerusahaan  = $value['DomisiliPerusahaan'];
		        	$NPWP  = $value['NPWP'];
		        	$PerizinanInstansiEksportir  = $value['PerizinanInstansiEksportir'];
		        	$nib  = $value['nib'];
		        	$IdentitasDiriPengurus  = $value['IdentitasDiriPengurus'];
		        	$LaporanKeuangan  = $value['LaporanKeuangan'];
		       }

		       if ($NoAktaPendiri !== '' AND $NoAktaPerubahan !== '' AND $DomisiliPerusahaan !== '' AND 
		       		$NPWP !== '' AND $PerizinanInstansiEksportir !== '' AND $nib !== '' AND $IdentitasDiriPengurus !== ''
		       		AND $LaporanKeuangan !== '')
		       {
		       		$query_update  = "UPDATE SKD.ClearingMember SET ApprovalStatus = 'P', ActionFlag = 'I' WHERE CMID = '".$cmid_peserta."'";
		       		$query_update_  = "UPDATE SKD.CMProfile SET ApprovalStatus = 'P' , ActionFlag = 'I' WHERE CMID = '".$cmid_peserta."'";

		       		$result = $db->Execute($query_update);
		       		$result1 = $db->Execute($query_update_);
		       		$result_ = 'OK';
		       } else {
		       		$result_ = 'NOT OK';
		       }
		        // print_r($query_cek_all);
	   	} else if($type_peserta === 'B' AND $flag_peserta === 'L'){
	   			$query_cek_all = "SELECT 
	   						NoAktaPendiri,
		        			NoAktaPerubahan,
		        			DomisiliPerusahaan,
		        			NPWP,
		        			PerizinanInstansiEksportir,
		        			LaporanKeuangan,
		        			suratRefBankNegeri,
		        			companyProfile
		        			FROM SKD.ClearingMember 
		        			WHERE CMID = '".$cmid_peserta."'";

		       $rcd_chek_all = $db->Execute($query_cek_all);

		       foreach ($rcd_chek_all as $value) {
		       		$NoAktaPendiri = $value['NoAktaPendiri'];
		       		$NoAktaPerubahan  = $value['NoAktaPerubahan'];
		        	$DomisiliPerusahaan  = $value['DomisiliPerusahaan'];
		        	$NPWP  = $value['NPWP'];
		        	$PerizinanInstansiEksportir  = $value['PerizinanInstansiEksportir'];
		        	$LaporanKeuangan  = $value['LaporanKeuangan'];
		        	$suratRefBankNegeri = $value['suratRefBankNegeri'];
		        	$companyProfile = $value['companyProfile'];
		       }

		       if ($NoAktaPendiri !== '' AND $NoAktaPerubahan !== '' AND $DomisiliPerusahaan !== '' AND 
		       		$NPWP !== '' AND $PerizinanInstansiEksportir !== '' AND $LaporanKeuangan !== '' AND $suratRefBankNegeri !== ''
		       		AND $companyProfile !== '')
		       {
		       		$query_update  = "UPDATE SKD.ClearingMember SET ApprovalStatus = 'P' , ActionFlag = 'I' WHERE CMID = '".$cmid_peserta."'";
		       		$query_update_  = "UPDATE SKD.CMprofile SET ApprovalStatus = 'P' , ActionFlag = 'I' WHERE CMID = '".$cmid_peserta."'";
		       		$result = $db->Execute($query_update);
		       		$result1 = $db->Execute($query_update_);
		       		$result_ = 'OK';
		       } else {
		       		$result_ = 'NOT OK';
		       }

		} else {
			$query_cek_all = "SELECT 
	   						NoAktaPendiri,
		        			NoAktaPerubahan,
		        			DomisiliPerusahaan,
		        			NPWP,
		        			IdentitasKepabean,
		        			EksportirTerdaftarTimah,
		        			PerizinanInstansiEksportir,
		        			nib,
		        			IdentitasDiriPengurus,
		        			LaporanKeuangan 
		        			FROM SKD.ClearingMember 
		        			WHERE CMID = '".$cmid_peserta."'";
		        			// print_r($query_cek_all);
		        			// exit();
		       $rcd_chek_all = $db->Execute($query_cek_all);

		        foreach ($rcd_chek_all as $value) {
		       		$NoAktaPendiri = $value['NoAktaPendiri'];
		       		$NoAktaPerubahan  = $value['NoAktaPerubahan'];
		        	$DomisiliPerusahaan  = $value['DomisiliPerusahaan'];
		        	$NPWP  = $value['NPWP'];
		        	$IdentitasKepabean = $value['IdentitasKepabean'];
		        	$EksportirTerdaftarTimah = $value['EksportirTerdaftarTimah'];
		        	$PerizinanInstansiEksportir = $value['PerizinanInstansiEksportir'];
		        	$nib = $value['nib'];
		        	$LaporanKeuangan  = $value['LaporanKeuangan'];
		        	// $suratRefBankNegeri = $value['suratRefBankNegeri'];
		        	// $companyProfile = $value['companyProfile'];
		       }
		       // exit();
		       // print_r($NoAktaPendiri .' - '.  $NoAktaPerubahan .' - '.  $DomisiliPerusahaan .' - '. $NPWP .' - '.  $IdentitasKepabean .' - '.  $EksportirTerdaftarTimah  .' - '.  $PerizinanInstansiEksportir .' - '.  $nib  .' - '.  $LaporanKeuangan .' - ');
		       // exit();

		       if ($NoAktaPendiri !== '' AND $NoAktaPerubahan !== '' AND $DomisiliPerusahaan !== '' AND 
		       		$NPWP !== '' AND $IdentitasKepabean !== '' AND $EksportirTerdaftarTimah !== '' AND $PerizinanInstansiEksportir !== '' AND $nib !== '' AND $LaporanKeuangan !== '')
		       {
		       		$query_update  = "UPDATE SKD.ClearingMember SET ApprovalStatus = 'P' , ActionFlag = 'I' WHERE CMID = '".$cmid_peserta."'";
		       		$query_update_  = "UPDATE SKD.CMProfile SET ApprovalStatus = 'P' , ActionFlag = 'I' WHERE CMID = '".$cmid_peserta."'";
		       		$result = $db->Execute($query_update);
		       		$result1 = $db->Execute($query_update_);
		       		$result_ = 'OK';

		       } else {
		       		$result_ = 'NOT OK';
		       }
		}
		// print_r($result_);
		// exit();
	    return $result_;
	}	
}

/* End of file m_tpa_01_document_status.php */
/* Location: ./application/models/m_tpa_01_document_status.php */