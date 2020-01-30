
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_transaction extends CI_Model {

	public function get_data($n)
	{

		// $val = $n;
		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';
		// $db_host = '10.15.10.21';
	 //    $db_user = 'sppkAdmin';
	 //    $db_pass = 'P@ssw0rd2017';
	 //    $db_data = 'SPPK_KBI_DEV';

		$db = NewADOConnection('odbc_mssql');
		$dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		$db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		$db->SetFetchMode(ADODB_FETCH_ASSOC);

		// $query = 'SELECT * FROM EODTradeProgress WHERE BuyerId = "'.$n.'"';
		// $query = "SELECT * FROM SKD.EODTradeProgress WHERE BuyerId = 'BKPJ0588'";
		// $query = "SELECT
		// 			C.BusinessDate AS BusinessDate,
		// 			A.ExchangeRef AS ExchangeRef,
		// 			A.TradeTime AS TradeTime,
		// 			A.BuyerId AS BuyerId,
		// 			E.Code AS Investorcode,
		// 			A.ProductCode AS ProductCode,
		// 			A.ContractMonth AS ContractMonth,
		// 			A.Volume AS Volume,
		// 			A.Price AS Price,
		// 			A.ContractSize AS BuContractSizeyerId,
		// 			A.Amount AS Amount,
		// 			A.BuyerPaymentDue AS BuyerPaymentDue,
		// 			A.BuyerPaymentDate AS BuyerPaymentDate,
		// 			A.BuyerFullPayment AS BuyerFullPayment,
		// 			A.BuyerInvoice AS BuyerInvoice,
		// 			A.FullDelivery AS FullDelivery,
		// 			A.BuyerOutStanding AS BuyerOutStanding,
		// 			A.SellerFullReceive AS SellerFullReceive,
		// 			A.Done AS Done,
		// 			B.user_cm AS user_cm,
		// 			C.ShippingInstructionApproveDate AS ShippingInstructionApproveDate
		// 		FROM
		// 			SKD.EODTradeProgress AS A
		// 		LEFT JOIN SKD.ClearingMember AS B ON SUBSTRING (A.buyerId, 0, 5) = B.Code,
		// 		 (
		// 			SELECT
		// 				TOP 1 *
		// 			FROM
		// 				SKD.Tradefeed
		// 		) AS C,
		// 		 SKD.BankAccount AS D,
		// 		 SKD.Investor AS E
		// 		WHERE
		// 			A.ExchangeRef = C.ExchangeRef
		// 		AND B.CMID = D.CMID
		// 		AND D.InvestorID = E.InvestorID
		// 		AND B.user_cm = '".$n."'";
				// print_r($query);

		// $rcd = $db->execute($query);
		$n = $db->escape($n);
		$query_cm = "SELECT Code, CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";

	    $rcd_query_cm = $db->execute($query_cm);
	    $cmid = '';
	    foreach ($rcd_query_cm as $val) {
	    	$cmid = $val['CMID'];
	    	$code = $val['Code'];
	    	// print_r($cmid);
	    }

	    $substr = substr($code,0,1);

	    if($substr == 'B'){

			$query = "SELECT DISTINCT
					A.BusinessDate AS BusinessDate,
					A.ExchangeRef AS ExchangeRef,
					A.TradeTime AS TradeTime,
					A.BuyerId AS BuyerId,
					-- E.Code AS Investorcode,
					A.ProductCode AS ProductCode,
					A.ContractMonth AS ContractMonth,
					A.Volume AS Volume,
					A.Price AS Price,
					A.ContractSize AS BuContractSizeyerId,
					A.Amount AS Amount,
					A.BuyerPaymentDue AS BuyerPaymentDue,
					A.BuyerPaymentDate AS BuyerPaymentDate,
					A.BuyerFullPayment AS BuyerFullPayment,
					A.BuyerInvoice AS BuyerInvoice,
					A.FullDelivery AS FullDelivery,
					A.BuyerOutStanding AS BuyerOutStanding,
					A.SellerFullReceive AS SellerFullReceive,
					A.Done AS Done,
					B.user_cm AS user_cm,
					(
						SELECT
							TOP 1 C.ShippingInstructionApproveDate
						FROM
							SKD.Tradefeed AS C
						WHERE
							C.ExchangeRef = A.ExchangeRef
					) AS ShippingInstructionApproveDate
				FROM
					SKD.EODTradeProgress AS A
				LEFT JOIN SKD.ClearingMember AS B ON SUBSTRING (A.BuyerId, 0, 5) = B.Code,
				 SKD.BankAccount AS D,
				 SKD.Investor AS E
				WHERE
					B.CMID = D.CMID
				AND D.InvestorID = E.InvestorID
				AND B.user_cm = '".$n."'";
	    	
	    } else {
	    	$query = "SELECT DISTINCT
					A.BusinessDate AS BusinessDate,
					A.ExchangeRef AS ExchangeRef,
					A.TradeTime AS TradeTime,
					A.BuyerId AS BuyerId,
					-- E.Code AS Investorcode,
					A.ProductCode AS ProductCode,
					A.ContractMonth AS ContractMonth,
					A.Volume AS Volume,
					A.Price AS Price,
					A.ContractSize AS BuContractSizeyerId,
					A.Amount AS Amount,
					A.BuyerPaymentDue AS BuyerPaymentDue,
					A.BuyerPaymentDate AS BuyerPaymentDate,
					A.BuyerFullPayment AS BuyerFullPayment,
					A.BuyerInvoice AS BuyerInvoice,
					A.FullDelivery AS FullDelivery,
					A.BuyerOutStanding AS BuyerOutStanding,
					A.SellerFullReceive AS SellerFullReceive,
					A.Done AS Done,
					B.user_cm AS user_cm,
					(
						SELECT
							TOP 1 C.ShippingInstructionApproveDate
						FROM
							SKD.Tradefeed AS C
						WHERE
							C.ExchangeRef = A.ExchangeRef
					) AS ShippingInstructionApproveDate
				FROM
					SKD.EODTradeProgress AS A
				LEFT JOIN SKD.ClearingMember AS B ON SUBSTRING (A.Sellerid, 0, 5) = B.Code,
				 SKD.BankAccount AS D,
				 SKD.Investor AS E
				WHERE
					B.CMID = D.CMID
				AND D.InvestorID = E.InvestorID
				AND B.user_cm = '".$n."'";
	    }
		// echo "<pre>";
		// print_r($query);
		// echo "</pre>";
		// exit();
			
		$rcd = $db->execute($query);
		return $rcd;
	}

	public function get_data_admin($n)
	{

		// $val = $n;
		include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		include (APPPATH.'libraries/adodb/adodb.inc.php');

		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';
		// $db_host = '10.15.10.21';
	 //    $db_user = 'sppkAdmin';
	 //    $db_pass = 'P@ssw0rd2017';
	 //    $db_data = 'SPPK_KBI_DEV';

		$db = NewADOConnection('odbc_mssql');
		$dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		$db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$n = $db->escape($n);
		// $query = 'SELECT * FROM EODTradeProgress WHERE BuyerId = "'.$n.'"';
		// $query = "SELECT * FROM SKD.EODTradeProgress WHERE BuyerId = 'BKPJ0588'";
		// $query = "SELECT
		// 			A.BusinessDate,
		// 			A.ExchangeRef,
		// 			A.TradeTime,
		// 			A.BuyerId,
		// 			A.ProductCode,
		// 			A.ContractMonth,
		// 			A.Volume,
		// 			A.Price,
		// 			A.ContractSize,
		// 			A.Amount,
		// 			A.BuyerPaymentDue,
		// 			A.BuyerPaymentDate,
		// 			A.BuyerFullPayment,
		// 			A.BuyerInvoice,
		// 			A.FullDelivery,
		// 			A.Done,
		// 			B.user_cm
		// 		FROM
		// 			SKD.EODTradeProgress AS A LEFT JOIN SKD.ClearingMember AS B ON SUBSTRING(A.buyerId, 0, 5) = B.Code";

		$query = "SELECT DISTINCT
					A.BusinessDate AS BusinessDate,
					A.ExchangeRef AS ExchangeRef,
					A.TradeTime AS TradeTime,
					A.BuyerId AS BuyerId,
					-- E.Code AS Investorcode,
					A.ProductCode AS ProductCode,
					A.ContractMonth AS ContractMonth,
					A.Volume AS Volume,
					A.Price AS Price,
					A.ContractSize AS BuContractSizeyerId,
					A.Amount AS Amount,
					A.BuyerPaymentDue AS BuyerPaymentDue,
					A.BuyerPaymentDate AS BuyerPaymentDate,
					A.BuyerFullPayment AS BuyerFullPayment,
					A.BuyerInvoice AS BuyerInvoice,
					A.FullDelivery AS FullDelivery,
					A.BuyerOutStanding AS BuyerOutStanding,
					A.SellerFullReceive AS SellerFullReceive,
					A.Done AS Done,
					B.user_cm AS user_cm,
					(
						SELECT
							TOP 1 C.ShippingInstructionApproveDate
						FROM
							SKD.Tradefeed AS C
						WHERE
							C.ExchangeRef = A.ExchangeRef
					) AS ShippingInstructionApproveDate
				FROM
					SKD.EODTradeProgress AS A
				LEFT JOIN SKD.ClearingMember AS B ON SUBSTRING (A.BuyerId, 0, 5) = B.Code,
				 SKD.BankAccount AS D,
				 SKD.Investor AS E
				WHERE
					B.CMID = D.CMID
				AND D.InvestorID = E.InvestorID";
				// print_r($query);

		$rcd = $db->execute($query);
		// echo "<pre>";
		// print_r($rcd);
		// echo "</pre>";
		return $rcd;
	}

	public function get_buyer($user){
		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';

		$db = NewADOConnection('odbc_mssql');
		$dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
		$db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
		$db->SetFetchMode(ADODB_FETCH_ASSOC);

		// $query = "SELECT Code FROM TIN_KBI.SKD.ClearingMember WHERE SUBSTRING(CODE, 1,1) = 'B'";
		// if($stardate == '' or $enddate == ''){
				$user = $db->escape($user);
			$query = "SELECT DISTINCT
					SUBSTRING(ep.BuyerId,1,4) AS Buyer_id
				FROM
					skd.StagingSellerAllocation ssa
				LEFT JOIN skd.ClearingMember cm ON cm.CMID = ssa.sellerid
				LEFT JOIN SKD.EODTradeProgress ep ON cm.Code = SUBSTRING (ep.SellerId, 1, 4)
				WHERE
					cm.user_cm = '".$user."'";
		// } else {
		// 	$query = "SELECT
		// 	  '' AS StartDate,
		// 	  '' AS EndDate,
		// 	  ssa.brand,
		// 	  ep.Price,
		// 	  ssa.volume
		// 	FROM 
		// 	  SKD.EODTradeProgress ep 
		// 	  LEFT JOIN skd.ClearingMember cm ON SUBSTRING(ep.SellerId,1,4) = cm.Code
		// 	  LEFT JOIN SKD.StagingSellerAllocation ssa ON cm.CMID = ssa.sellerid
		// 	  WHERE cm.user_cm = '".$user."' AND ep.TradeTime BETWEEN '05/09/2019' AND '09/09/2019'
		// 	  GROUP BY ssa.brand,ssa.Volume,ep.Price";
		// }
		// print_r($query);
		// exit();
		$rcd = $db->Execute($query);

		return $rcd;
	}

	public function get_trans($user,$stardate, $enddate,$buyer){

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
			$stardate = $db->escape($stardate); 
			$enddate = $db->escape($enddate);
			$buyer = $db->escape($buyer);

			// $query = "SELECT Code FROM TIN_KBI.SKD.ClearingMember WHERE SUBSTRING(CODE, 1,1) = 'B'";
			if($stardate == '' or $enddate == ''){
				// $query = "SELECT
				//  *
				// FROM 
				//   SKD.EODTradeProgress ep 
				//   LEFT JOIN skd.ClearingMember cm ON SUBSTRING(ep.SellerId,1,4) = cm.Code
				//   LEFT JOIN SKD.StagingSellerAllocation ssa ON cm.CMID = ssa.sellerid
				//   WHERE cm.user_cm = '".$user."' AND ssa.BusinessDate = GETDATE()";

				  $query = "SELECT 
						   GETDATE() as StartDate,
				  			 GETDATE() as EndDate,
						  ssa.brand,
						    (SELECT hlp.FloorPrice+400 FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp WHERE hlp.BusinessDate = rtf.BusinessDate) AS SettlementPrice,
						  (sum(CONVERT(decimal, ssa.unit)) * 
						    (SELECT hlp.FloorPrice+400 FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp WHERE hlp.BusinessDate = rtf.BusinessDate)/
						      (sum(CONVERT(decimal, ssa.unit)))) AS Average,
						  ssa.Volume as volume,
						  ssa.unit
						  FROM TIN_KBI.SKD.RawTradeFeed rtf
						  LEFT JOIN TIN_KBI.skd.ClearingMember cm ON SUBSTRING(rtf.SellerInvCode,1,4) = cm.Code
						 LEFT JOIN TIN_KBI.SKD.StagingSellerAllocation ssa ON cm.CMID = ssa.sellerid
						  WHERE  cm.user_cm = '".$user."' AND rtf.BusinessDate = GETDATE()
						  GROUP BY ssa.brand,rtf.BusinessDate,ssa.volume,ssa.Unit";
			} else {
				// $query = "SELECT
				//   '".$stardate."'as StartDate,
				//   '".$enddate."' as EndDate,
				//   ssa.Brand as brand,
				//   ep.Price as price,
				//   ssa.Volume as volume
				// FROM 
				//   SKD.EODTradeProgress ep 
				//   LEFT JOIN skd.ClearingMember cm ON SUBSTRING(ep.SellerId,1,4) = cm.Code
				//   LEFT JOIN SKD.StagingSellerAllocation ssa ON cm.CMID = ssa.sellerid
				//   WHERE cm.user_cm = '".$user."' AND ep.TradeTime BETWEEN '".$stardate."' AND '".$enddate."'
				//   GROUP BY ssa.brand,ssa.Volume,ep.Price";

				  $query="SELECT 
						  '".$stardate."' as StartDate,
				  			'".$enddate."' as EndDate,
						  ssa.brand,
						  (SELECT hlp.FloorPrice+400 FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp WHERE hlp.BusinessDate = rtf.BusinessDate) AS SettlementPrice,
						  (sum(CONVERT(decimal, ssa.unit)) * 
						    (SELECT hlp.FloorPrice+400 FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp WHERE hlp.BusinessDate = rtf.BusinessDate)/
						      (sum(CONVERT(decimal, ssa.unit)))) AS Average,
						  ssa.Volume as volume,
						  ssa.unit
						  FROM TIN_KBI.SKD.RawTradeFeed rtf
						  LEFT JOIN TIN_KBI.skd.ClearingMember cm ON SUBSTRING(rtf.SellerInvCode,1,4) = cm.Code
						 LEFT JOIN TIN_KBI.SKD.StagingSellerAllocation ssa ON cm.CMID = ssa.sellerid
						  WHERE cm.user_cm = '".$user."' AND rtf.BusinessDate BETWEEN '".$stardate."' AND '".$enddate."'
						  GROUP BY ssa.brand,rtf.BusinessDate,ssa.volume,ssa.Unit"; 

			}
			// print_r($query);
			// exit();
			$rcd = $db->Execute($query);

			return $rcd;
		}


}

/* End of file m_tpa_01_query_transaction.php */
/* Location: ./application/models/m_tpa_01_query_transaction.php */