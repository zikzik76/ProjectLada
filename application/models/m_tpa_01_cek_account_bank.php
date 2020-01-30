<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cek_account_bank extends CI_Model {
	public function get_account($n){
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

		$n = $db->escape($n);
		
		$query_get_cmid = "SELECT CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";
		$rcd_get_cmid = $db->Execute($query_get_cmid);
		$cmid_ = '';
		foreach ($rcd_get_cmid as $keys) {
			$cmid_ = $keys['CMID'];
		}
		// print_r($n);
		// exit();

		$query = "SELECT A.AccountNo AS AccountNo,
					A.AccountType AS AccountType,
					B.Code AS Investorcode,
				CASE
				WHEN A.AccountType = 'RD'
				AND B.Code LIKE '%05%' THEN
					'Used for depositing risk guarantee transactions in cash'
				WHEN A.AccountType = 'RD'
				AND B.Code LIKE '%36%' THEN
					'Used for transaction fee payments'
				WHEN A.AccountType = 'RS'
				AND B.Code LIKE '%05%' THEN
					'Used to pay for settlement of transactions that guarantee transaction risk in cash'
				WHEN A.AccountType = 'RS'
				AND B.Code LIKE '%36%' THEN
					'Used to pay for settlement of transactions that guarantee transaction risk in the form of a bank guarantee'
				WHEN A.AccountType = 'RS'
				AND B.Code LIKE '%45%' THEN
					'Used to pay for settlement of transactions'
				END AS description
				FROM
					SKD.BankAccount AS A
				LEFT JOIN SKD.Investor AS B ON A.InvestorID = B.InvestorID
				WHERE A.AccountType IN ('RS', 'RD') AND A.ApprovalStatus = 'A' AND A.CMID = ".$cmid_;

		$rcd = $db->Execute($query);

		return $rcd;
	}

	public function get_account_admin($n){
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

		$query_get_cmid = "SELECT CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";
		$rcd_get_cmid = $db->Execute($query_get_cmid);
		$cmid_ = '';
		foreach ($rcd_get_cmid as $keys) {
			$cmid_ = $keys['CMID'];
		}

		$n = $db->escape($n);
		
		$query = "SELECT AccountNo, AccountType FROM SKD.BankAccount" ;
		$rcd = $db->Execute($query);

		return $rcd;
	}
	

}

/* End of file m_tpa_01_cek_account_bank.php */
/* Location: ./application/models/m_tpa_01_cek_account_bank.php */