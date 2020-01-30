<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : - Query Get Tradefeed
						  - Query update Shipping Instruction	
    Version             : 1.0 Production
=================================================================== 
-->


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_query_tradefeed extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_tradefeed($n)
	{
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
	    $query_cm = "SELECT Code, CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";

	    $rcd_query_cm = $db->execute($query_cm);
	    $cmid = '';
	    foreach ($rcd_query_cm as $val) {
	    	$cmid = $val['CMID'];
	    	$code = $val['Code'];
	    	// print_r($cmid);
	    }

	    $substr = substr($code,0,1);
	    // print_r($substr);
	    if($substr == 'B'){

		    $query = "SELECT
						A.*, B.Code AS code, B.Name AS Name,
						C.code AS WarehouseCode, C.location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code WHERE BuyerCMID= ".$cmid." AND (A.ShippingInstructionFlag IS NULL OR A.ShippingInstructionFlag = 'R' OR A.ShippingInstructionFlag = 'P')";
					// WHERE B.user_cm='".$n."' AND (A.ShippingInstructionFlag IS NULL OR A.ShippingInstructionFlag = 'R' OR A.ShippingInstructionFlag = 'P') AND BuyerCMID = ".$cmid;
	    } else {
	    	$query = "SELECT
						A.*, B.Code AS code, B.Name AS Name,
						C.code AS WarehouseCode, C.location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code 
					WHERE  A.SellerCMID = ".$cmid."AND (A.ShippingInstructionFlag IS NULL OR A.ShippingInstructionFlag = 'R' OR A.ShippingInstructionFlag = 'P')";
					 // B.user_cm='".$n."' AND (A.ShippingInstructionFlag IS NULL OR A.ShippingInstructionFlag = 'R' OR A.ShippingInstructionFlag = 'P') AND SellerCMID = ".$cmid ;
	    }

	  	$rcd_ = $db->Execute($query);

	  	return $rcd_;
	}

	public function get_warehouse($n){
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
	    $query_cm = "SELECT Code, CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";

	    $rcd_query_cm = $db->execute($query_cm);
	    $cmid = '';
	    foreach ($rcd_query_cm as $val) {
	    	$cmid = $val['CMID'];
	    	$code = $val['Code'];
	    	// print_r($cmid);
	    }

	    $substr = substr($code,0,1);
	    // print_r($substr);
	    // exit();
	    if($substr == 'B'){

		    $query = "SELECT DISTINCT
						-- B.Code AS code,
						C.code AS WarehouseCode, C.location AS location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code WHERE A.BuyerCMID =".$cmid; 
					// WHERE B.user_cm='".$n."'";
	    } else {
	    	  $query = "SELECT DISTINCT
						-- B.Code AS code,
						C.code AS WarehouseCode, C.location AS location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code WHERE A.SellerCMID =".$cmid; 
				// print_r($query);
				// exit();
	    }	    


	  	$rcd_ = $db->Execute($query);

	  	return $rcd_;
	}

	public function get_tradefeed_approve($n)
	{
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
	    $query_cm = "SELECT Code, CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";

	    $rcd_query_cm = $db->execute($query_cm);
	    $cmid = '';
	    foreach ($rcd_query_cm as $val) {
	    	$cmid = $val['CMID'];
	    	$code = $val['Code'];
	    	// print_r($cmid);
	    }

	    $substr = substr($code,0,1);
 // print_r($substr);
	    if($substr === 'B'){
	    	// print_r("buyer");

		    $query = "SELECT
						A.*, B.Code AS code, B.Name AS Name,
						C.code AS WarehouseCode, C.location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code 
					WHERE A.BuyerCMID='".$cmid."' AND A.ShippingInstructionFlag = 'A'";

			// $query = "SELECT
			// 			A.BusinessDate,
			// 			A.SellerRef,
			// 			A.ExchangeRef,
			// 			A.TradeTime ,A.ContractID,
			// 			A.Price,
			// 			A.Quantity,
			// 			B.Code AS code,
			// 			B.Name AS Name,
			// 			C.code AS WarehouseCode,
			// 			C.location
			// 		FROM
			// 			SKD.Tradefeed AS A
			// 		LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
			// 		LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
			// 			A.SellerRef,
			// 			LEN(A.SellerRef) - 1,
			// 			3
			// 		) = C.code
			// 		WHERE
			// 			A.BuyerCMID = '".$cmid."'
			// 		AND A.ShippingInstructionFlag = 'A'";
	    } else {

	    	// print_r("Seller");
	    	$query = "SELECT
						A.*, B.Code AS code, B.Name AS Name,
						C.code AS WarehouseCode, C.location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code 
					WHERE A.SellerCMID='".$cmid."' AND A.ShippingInstructionFlag = 'A'";
	    }

	  	$rcd_ = $db->Execute($query);

	  	return $rcd_;
	}

	public function get_tradefeed_approve_admin($n)
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
	    $n = $db->escape($n);
	    $query_cm = "SELECT Code, CMID FROM SKD.ClearingMember WHERE user_cm = '".$n."'";

	    $rcd_query_cm = $db->execute($query_cm);
	    $cmid = '';
	    foreach ($rcd_query_cm as $val) {
	    	$cmid = $val['CMID'];
	    	$code = $val['Code'];
	    }

	    // $substr = substr($code,0,1);
	    // if($substr === 'B'){
		    $query = "SELECT
						A.*, B.Code AS code, B.Name AS Name,
						C.code AS WarehouseCode, C.location
					FROM
						SKD.Tradefeed AS A
					LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
						A.SellerRef,
						LEN(A.SellerRef) - 1,
						3
					) = C.code 
					WHERE A.ShippingInstructionFlag = 'A'";
	    // } else {

	    // 	$query = "SELECT
					// 	A.*, B.Code AS code, B.Name AS Name,
					// 	C.code AS WarehouseCode, C.location
					// FROM
					// 	SKD.Tradefeed AS A
					// LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
					// LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
					// 	A.SellerRef,
					// 	LEN(A.SellerRef) - 1,
					// 	3
					// ) = C.code 
					// WHERE A.SellerCMID='".$cmid."' AND A.ShippingInstructionFlag = 'A'";
	    // }

	  	$rcd_ = $db->Execute($query);

	  	return $rcd_;
	}

	// public function get_warehouse($n){
	// 	include (APPPATH.'libraries/adodb/adodb.inc.php');

	// 	$db_host = 'KBIDEV-TIMAH-DBMS';
	// 	$db_user = 'sadev_lada';
	// 	$db_pass = 'Kbi@Kbi2021';
	// 	$db_data = 'TIN_KBI';

	//     $db = NewADOConnection('odbc_mssql');
	//     $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	//     $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	//     $db->SetFetchMode(ADODB_FETCH_ASSOC);

	//     $query = "SELECT DISTINCT
	// 				B.Code AS code,
	// 				C.code AS WarehouseCode, C.location AS location
	// 			FROM
	// 				SKD.Tradefeed AS A
	// 			LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
	// 			LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
	// 				A.SellerRef,
	// 				LEN(A.SellerRef) - 1,
	// 				3
	// 			) = C.code 
	// 			WHERE B.user_cm='".$n."'";

	//   	$rcd_ = $db->Execute($query);

	//   	return $rcd_;
	// }


	public function update_SI($url,$varId,$var,$si,$tof,$boc,$cs,$sh,$pod,$id,$bts,$cs_name,$sh_name,$pol,$whloc)
	{
		// print_r($url.' - '.$varId.' - '.$var.' - '.$si.' - '.$tof.' - '.$boc.' - '.$cs.' - '.$sh.' - '.$pod.' - '.$id.' - '.$bts.' - '.$sh_name.' - seller timah CSNAME '.$cs_name.' - '.$pol.' - '.$whloc);
		// exit();

		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
	    include (APPPATH.'libraries/adodb/adodb.inc.php');

	    // print_r(appa)

		$db_host = 'KBIDEV-TIMAH-DBMS';
		$db_user = 'sadev_lada';
		$db_pass = 'Kbi@Kbi2021';
		$db_data = 'TIN_KBI';


	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);
	    
	    $url = $db->escape($url);
	    $varId = $db->escape($varId);
	    $var = $db->escape($var);
	    $si = $db->escape($si);
	    $tof = $db->escape($tof);
	    $boc = $db->escape($boc);
	    $cs = $db->escape($cs);
	    $sh = $db->escape($sh);
	    $pod = $db->escape($pod);
	    $id = $db->escape($id);
	    $bts = $db->escape($bts);
	    $cs_name = $db->escape($cs_name);
	    $sh_name = $db->escape($sh_name);
	    $pol = $db->escape($pol);
	    $whloc = $db->escape($whloc);
	 //    // print_r($var);

	 //    // exit();
	    $query_RT = "UPDATE SKD.Rawtradefeed SET 
	    			ShippingInstructionUrl = '".$url."',
	    			ShippingInstructionFlag = 'P', 
	    			ShippingInstructionUpdate = GETDATE(),
	    			NoSi = '".$si."', 
	    			TermOfTransaction = '".$tof."',
	    			ADP = '".$boc."',
	    			Shipper = '".$sh."',
	    			Consignee = '".$cs."',
	    			Warehouse = '".$whloc."',
	    			PortLoading = '".$pol."',
	    			PortDischarge = '".$pod."',
	    			ShipperName = '".$sh_name."',
	    			ConsigneeName = '".$cs_name."'
	    			WHERE	TradefeedID = ".$id."	AND sellerRef = '".$bts."'";
	    $query_T = "UPDATE SKD.TradeFeed SET 
	    			ShippingInstructionUrl = '".$url."',
	    			ShippingInstructionFlag = 'P', 
	    			ShippingInstructionUpdate = GETDATE(),
	    			NoSi = '".$si."', 
	    			TermOfTransaction = '".$tof."',
	    			ADP = '".$boc."',
	    			Shipper = '".$sh."',
	    			Consignee = '".$cs."',
	    			Warehouse = '".$whloc."',
	    			PortLoading = '".$pol."',
	    			PortDischarge = '".$pod."',
	    			ShipperName = '".$sh_name."',
	    			ConsigneeName = '".$cs_name."'
	    			WHERE	TradefeedID = ".$id."	AND sellerRef = '".$bts."'";
	 	
	 	$rcd = $db->Execute($query_RT);
	 	$rcd_ = $db->Execute($query_T);
	    // print_r($query);

	    // exit();
	 //   	$rcd_ = $db->Execute($query_RT);
	    // $rcd_['T'] = $db->Execute($query_T);

	    return true;
	}	

	public function get_tradefeed_admin($n)
	{
		// include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
		$this->input->post($n);
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
	  	$query = "SELECT * FROM SKD.Tradefeed AS A 
	  				 LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID ";
	  	// $query = "SELECT
				// 	A.BusinessDate,
				// 	A.ExchangeRef,
				// 	A.ApprovalStatus,
				// 	A.TradeTime,
				// 	A.ContractId,
				// 	A.Price,
				// 	A.
				// FROM
				// 	SKD.TradeFeed AS A
				// LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
				// WHERE
				// 	B.user_cm = '".$n."' ";

	  	$rcd_ = $db->Execute($query);

	  	// echo "<pre>";
	  	// print_r($rcd_);
	  	// echo "</pre>";

	  	return $rcd_;
	}

	public function get_warehouse_admin($n){
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
	    $query = "SELECT DISTINCT
					B.Code AS code,
					C.code AS WarehouseCode, C.location AS location
				FROM
					SKD.Tradefeed AS A
				LEFT JOIN SKD.ClearingMember AS B ON A.BuyerCMID = B.CMID
				LEFT JOIN dbo.Warehouse AS C ON SUBSTRING (
					A.SellerRef,
					LEN(A.SellerRef) - 1,
					3
				) = C.code";

	  	$rcd_ = $db->Execute($query);

	  	return $rcd_;
	}

	public function get_notice_of_shipment($code)
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

	    $code = $db->escape($code);
	    $query = 	"select distinct NoSI from skd.tradefeed t
					inner join skd.ClearingMember cmb on t.BuyerCMID = cmb.CMID
					inner join skd.ClearingMember cms on t.SellerCMID = cms.CMID
					where (cmb.Code = '".$code."' or cms.Code = '".$code."')";

	  	$rcd_ = $db->Execute($query);

	  	return $rcd_;
	}

}

/* End of file m_tpa_01_tradefeed.php */
/* Location: ./application/models/m_tpa_01_tradefeed.php */