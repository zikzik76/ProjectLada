<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_get_warehouse_seller extends CI_Model {

	public function get_data($date,$user,$loc,$brand){
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


		$date = $db->escape($date);
		$user = $db->escape($user);
		$loc = $db->escape($loc);
		$brand = $db->escape($brand);

	

		$query = "WITH CTE AS (
SELECT businessdate, productid, brand, unit, volume, nobst,companyname, location, nocoa,
ROW_NUMBER() OVER (PARTITION BY 
businessdate, 
productid, 
brand,
nobst,nocoa
ORDER BY 
businessdate, 
productid, 
brand,
nobst,nocoa) AS NR
FROM
skd.stagingsellerallocation 
)
SELECT
						A.user_cm AS usr,
						B.companyname AS companyname,
						B.businessdate AS businessdate,
						C.location AS location,
						B.nobst AS bstno,
						B.brand AS brand,
						B.nocoa AS coano,						
						CAST(B.volume AS NUMERIC(18,2)) AS vol,
						CAST(B.unit AS NUMERIC(18,2)) AS LOT,
						(
							SELECT
								SUM (
									CAST(volume AS NUMERIC(18,2))
								)
							FROM
								CTE
							WHERE
								companyname = B.companyname AND
								location = C.location AND
								brand = B.brand AND
								businessdate = B.businessdate
						) AS totalvolume,
						(
							SELECT
								SUM (
									CAST(unit AS NUMERIC(18,2))
								)
							FROM
								CTE
							WHERE
								companyname = B.companyname AND
								location = C.location AND
								brand = B.brand AND
								businessdate = B.businessdate
						) AS totallot
					FROM
						SKD.ClearingMember AS A
					LEFT JOIN CTE AS B ON A.Name = B.companyname
					LEFT JOIN dbo.Warehouse AS C ON B.location = C.location
					WHERE (B.businessdate = '".$date."' OR '".$date."' = '') 
					AND A.user_cm = '".$user."' 
					AND (C.location = '".$loc."' OR '".$loc."' = '') 
					AND (B.brand = '".$brand."' OR '".$brand."' = '') AND NR=1";
		// print_r($query);
		$rcd = $db->Execute($query);

		return $rcd;
	}

	public function get_data_admin($user,$loc){
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
		$loc = $db->escape($loc);


		$query = "SELECT
						A.user_cm AS usr,
						B.companyname AS companyname,
						B.businessdate AS businessdate,
						C.location AS location,
						B.nobst AS bstno,
						B.brand AS brand,
						B.nocoa AS coano,
						B.volume AS vol,
						B.unit AS LOT,
						(
							SELECT
								SUM (
									CAST (CAST(volume AS NUMERIC) AS INT)
								)
							FROM
								SKD.StagingSellerAllocation
							WHERE
								companyname = B.companyname AND
								location = C.location AND
								brand = B.brand
						) AS totalvolume
					FROM
						SKD.ClearingMember AS A
					LEFT JOIN SKD.StagingSellerAllocation AS B ON A.Name = B.companyname
					LEFT JOIN dbo.Warehouse AS C ON B.location = C.location";

		$rcd = $db->Execute($query);

		return $rcd;
	}

	public function get_summary($date,$user,$loc,$brand){
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

		$date = $db->escape($date);
		$user = $db->escape($user);
		$loc = $db->escape($loc);
		$brand = $db->escape($brand);



		$query = "WITH CTE AS (
SELECT businessdate, productid, brand, unit, volume, nobst,companyname, location,
ROW_NUMBER() OVER (PARTITION BY 
businessdate, 
productid, 
brand,
nobst
ORDER BY 
businessdate, 
productid, 
brand,
nobst) AS NR
FROM
skd.stagingsellerallocation 
)
SELECT 
					a.businessdate AS businessdate, 
					a.productid as product, 
					a.brand as brand,
					sum(CONVERT(decimal, a.unit)) as lot, 
					sum(CONVERT(decimal, a.volume)) as tonase
					FROM CTE a
					LEFT JOIN skd.clearingmember b ON a.companyname = b.name
					LEFT JOIN dbo.warehouse c ON a.location = c.location
					WHERE b.user_cm = '".$user."' 
					AND (a.businessdate = '".$date."' OR '".$date."' = '')
					AND (C.location = '".$loc."' OR '".$loc."' = '')
					AND (a.brand = '".$brand."' OR '".$brand."' = '') 
					AND a.NR=1
					GROUP BY a.businessdate, a.productid, a.brand
					ORDER BY a.businessdate";

		$rcd = $db->Execute($query);

		return $rcd;
	}

	public function get_summary_admin($user,$loc,$brand){
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
		$loc = $db->escape($loc);
		$brand = $db->escape($brand);
		// $query = "SELECT 
		// 			a.businessdate AS businessdate, 
		// 			a.productid as product, 
		// 			a.brand as brand, 
		// 			sum(CONVERT(decimal, a.unit)) as lot, 
		// 			sum(CONVERT(decimal, a.volume)) as tonase
		// 			FROM skd.stagingsellerallocation a
		// 			LEFT JOIN skd.clearingmember b ON a.companyname = b.name
		// 			LEFT JOIN dbo.warehouse c ON a.location = c.location
		// 			WHERE b.user_cm = '".$user."'
		// 			AND (a.businessdate = '".$date."' OR '".$date."' = '')
		// 			AND (C.location = '".$loc."' OR '".$loc."' = '')
		// 			AND (a.brand = '".$brand."' OR '".$brand."' = '')
		// 			GROUP BY a.businessdate, a.productid, a.brand
		// 			ORDER BY a.businessdate";

		$query = "WITH CTE AS (
SELECT businessdate, productid, brand, unit, volume, nobst,companyname, location,
ROW_NUMBER() OVER (PARTITION BY 
businessdate, 
productid, 
brand,
nobst
ORDER BY 
businessdate, 
productid, 
brand,
nobst) AS NR
FROM
skd.stagingsellerallocation 
)
SELECT 
					a.businessdate AS businessdate, 
					a.productid as product, 
					a.brand as brand,
					sum(CONVERT(decimal, a.unit)) as lot, 
					sum(CONVERT(decimal, a.volume)) as tonase
					FROM CTE a
					LEFT JOIN skd.clearingmember b ON a.companyname = b.name
					LEFT JOIN dbo.warehouse c ON a.location = c.location
					WHERE b.user_cm = '".$user."' 
					AND (a.businessdate = '".$date."' OR '".$date."' = '')
					AND (C.location = '".$loc."' OR '".$loc."' = '')
					AND (a.brand = '".$brand."' OR '".$brand."' = '') 
					AND a.NR=1
					GROUP BY a.businessdate, a.productid, a.brand
					ORDER BY a.businessdate";

		// print_r($query);
		// exit();
		$rcd = $db->Execute($query);

		return $rcd;
	}

}

/* End of file m_tpa_01_get_warehouse_seller.php */
/* Location: ./application/models/m_tpa_01_get_warehouse_seller.php */