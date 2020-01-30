<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Query checking Clearing Member Status
    Version             : 1.0 Production
=================================================================== 
-->


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_status_cm extends CI_Model {

	public function cm_stat($user){
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

 					$query = "SELECT
						A.Code AS Code,
						A.Name AS Name,
						A.MemberType AS MemberType,
						A.MemberStat AS MemberStat,
						A.NoAktaPendiri AS NoAktaPendiri,
						A.NoAktaPerubahan AS NoAktaPerubahan,
						A.DomisiliPerusahaan AS DomisiliPerusahaan,
						A.NPWP AS NPWP,
						A.IdentitasKepabean AS IdentitasKepabean,
						A.EksportirTerdaftarTimah AS EksportirTerdaftarTimah,
						A.PerizinanInstansiEksportir AS PerizinanInstansiEksportir,
						A.CreatedDate AS CreatedDate,
						A.ApprovalStatus AS ApprovalStatus,
						A.CMStatus AS CMStatus,
						B.CMType AS CMType,
						A.siup AS SIUP,
	        			A.nib AS NIB,
	        			A.IdentitasDiriPengurus AS IdentitasPengurus,
	        			A.LaporanKeuangan AS LaporanKeuangan,
	        			A.suratRefBankNegeri AS suratRef,
	        			A.companyProfile AS CompanyProfile,
	        			A.StatusDomisiliFlag AS dom_stat,
	        			A.ApprovalStatus AS ApprovalStatus_,
	        			A.ApprovalDesc AS ApprovalDesc

					FROM
						SKD.ClearingMember AS A LEFT JOIN SKD.ClearingMemberExchange AS B ON A.CMID = B.CMID
					WHERE
						A.user_cm ='".$user."'";
			// print_r($query);
			// exit();
		    $rcd = $db->Execute($query);

		return $rcd;		
	}

	public function cm_stat_admin(){
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

 					$query = "SELECT
						A.Code AS Code,
						A.Name AS Name,
						A.MemberType AS MemberType,
						A.MemberStat AS MemberStat,
						A.NoAktaPendiri AS NoAktaPendiri,
						A.NoAktaPerubahan AS NoAktaPerubahan,
						A.DomisiliPerusahaan AS DomisiliPerusahaan,
						A.NPWP AS NPWP,
						A.IdentitasKepabean AS IdentitasKepabean,
						A.EksportirTerdaftarTimah AS EksportirTerdaftarTimah,
						A.PerizinanInstansiEksportir AS PerizinanInstansiEksportir,
						A.CreatedDate AS CreatedDate,
						A.ApprovalStatus AS ApprovalStatus,
						A.CMStatus AS CMStatus,
						B.CMType AS CMType,
						A.siup AS SIUP,
	        			A.nib AS NIB,
	        			A.IdentitasDiriPengurus AS IdentitasPengurus,
	        			A.LaporanKeuangan AS LaporanKeuangan,
	        			A.suratRefBankNegeri AS suratRefBankNegeri,
	        			A.companyProfile AS CompanyProfile,
	        			A.ApprovalDesc AS ApprovalDesc

					FROM
						SKD.ClearingMember AS A LEFT JOIN SKD.ClearingMemberExchange AS B ON A.CMID = B.CMID";

		    $rcd = $db->Execute($query);

		return $rcd;		
	}

}

/* End of file m_tpa_01_query_status_cm.php */
/* Location: ./application/models/m_tpa_01_query_status_cm.php */