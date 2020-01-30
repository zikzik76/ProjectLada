<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_get_transaction extends CI_Model {

	public function get_tlead(){
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

	    $query = "SELECT DISTINCT
						rtf.ProductCode AS ProductCode, hlp.FloorPrice AS Price
					FROM
						TIN_BBJ_Staging.dbo.HiLoPrice hlp
					LEFT JOIN TIN_BBJ_Staging.dbo.RawTradeFeed rtf ON hlp.BusinessDate = rtf.BusinessDate
					WHERE
						hlp.BusinessDate = '2019-08-15'";
	    $rcd = $db->Execute($query);
	    return $rcd;
	}

	public function get_trans(){
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


		$query = "SELECT DISTINCT 
				       hlp.BusinessDate AS BusinessDate
				      ,p.ProductCode AS productid
				      ,(SUBSTRING(p.ProductCode,1,2)) AS initial
				      ,(SUBSTRING(p.ProductCode,6,8)) AS cprod
				      ,CASE p.ProductCode
				        WHEN 'TLEAD300' THEN
				          CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                    THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
                      THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
                          THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                     THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp1.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp1))
                             ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
                             END
                           ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
                           END
                        ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
                        END
                      ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
                      END
                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')                              
				          END 
				        WHEN 'TLEAD200' THEN
				          CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
				       	  THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                    THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
                      THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                  THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp2.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp2))
				                  ELSE 
				                    (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
				                  END
				                ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
				                END
                      ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
                      END
                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
                    END
                  ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
                  END
				        WHEN 'TLEAD100' THEN
				          CASE 
				          WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
				         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
				              THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
                           THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                    THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp3.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp3))
				                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
				                  END
				                ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
				                END
				              ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')      
				              END
                     ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')      
				             END
                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')      
				            END
				         WHEN 'TLEAD050' THEN
				          CASE
				          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
				         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
				              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                            THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                      THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp4.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp4))
				                      ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEA099')
				                      END
				                    ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
				                    END
				                 ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
				                END
                       ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
				               END
  				          ELSE
  				          (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
  				         END
				         WHEN 'TPURE099' THEN
				          CASE
				          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
				              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
				                THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
				                  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
				                    THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice  WHERE ID = (SELECT MAX(hlp5.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp5))
				                     ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
				                    END
				                  ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
				                  END
				                ELSE (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
				                END
				              ELSE (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
				              END
				          ELSE
				          (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
				         END 
				      END AS Price
				    FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp, SKD.Product p  
				      LEFT JOIN SKD.RawTradeFeed rtf ON p.ProductCode = rtf.ProductCode
				      WHERE 
				      hlp.BusinessDate = CASE WHEN (SELECT BusinessDate FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp6 WHERE BusinessDate = GETDATE()) IS NULL  
				                            THEN (SELECT MAX(BusinessDate) FROM TIN_BBJ_Staging.dbo.HiLoPrice)
				                             ELSE GETDATE()
				                       END 
				                       ORDER BY initial,cprod DESC";
	    $rcd = $db->Execute($query);
		// print_r($rcd);
		// exit();
	    return $rcd;
	} 

		public function get_trans2(){
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

		// $query = "SELECT DISTINCT 
		// 		  rtf.BusinessDate,
		// 		  ssa.productid, 
		// 		  ssa.brand,
		// 		(SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = rtf.BusinessDate ) AS Price,
		// 		  SUBSTRING(ssa.productid,6,8) AS Cprod
		// 		  FROM SKD.StagingSellerAllocation ssa 
		// 		  LEFT JOIN TIN_KBI.SKD.RawTradeFeed rtf ON ssa.productid = rtf.ProductCode
		// 		  LEFT JOIN TIN_BBJ_Staging.dbo.HiLoPrice hlp ON rtf.BusinessDate = hlp.BusinessDate
		// 		  WHERE rtf.BusinessDate = '2019-08-21' ORDER BY Cprod DESC";
		// $query = "    SELECT DISTINCT 
		// 		       hlp.BusinessDate AS BusinessDate
		// 		      ,p.ProductCode AS productid
		// 		      ,(SUBSTRING(p.ProductCode,1,2)) AS initial
		// 		      ,(SUBSTRING(p.ProductCode,6,8)) AS cprod
		// 		      ,CASE p.ProductCode
		// 		        WHEN 'TLEAD300' THEN
		// 		          CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
		// 		             THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp1.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp1))
		// 		          ELSE
		// 		          (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD300')
		// 		          END 
		// 		        WHEN 'TLEAD200' THEN
		// 		          CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
		// 		       	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
		// 		            THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp2.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp2))
		// 		            ELSE 
		// 		              (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
		// 		            END
		// 		          ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
		// 		        END
		// 		        WHEN 'TLEAD100' THEN
		// 		          CASE 
		// 		          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
		// 		         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
		// 		              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
		// 		                THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp3.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp3))
		// 		                ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
		// 		                END
		// 		              ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
		// 		              END
		// 		            ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')      
		// 		         END
		// 		         WHEN 'TLEAD050' THEN
		// 		          CASE
		// 		          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
		// 		         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
		// 		              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
		// 		                THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
		// 		                  THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp4.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp4))
		// 		                  ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
		// 		                  END
		// 		                ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
		// 		                END
		// 		              ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
		// 		              END
		// 		          ELSE
		// 		          (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
		// 		         END
		// 		         WHEN 'TPURE099' THEN
		// 		          CASE
		// 		          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
		// 		         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
		// 		              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
		// 		                THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
		// 		                  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
		// 		                    THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice  WHERE ID = (SELECT MAX(hlp5.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp5))
		// 		                     ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
		// 		                    END
		// 		                  ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
		// 		                  END
		// 		                ELSE (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
		// 		                END
		// 		              ELSE (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
		// 		              END
		// 		          ELSE
		// 		          (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
		// 		         END 
		// 		      END AS Price
		// 		    FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp, SKD.Product p  
		// 		      LEFT JOIN SKD.RawTradeFeed rtf ON p.ProductCode = rtf.ProductCode
		// 		      WHERE 
		// 		      hlp.BusinessDate = CASE WHEN (SELECT BusinessDate FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp6 WHERE BusinessDate = GETDATE()) IS NULL  
		// 		                            THEN (SELECT MAX(BusinessDate) FROM TIN_BBJ_Staging.dbo.HiLoPrice)
		// 		                             ELSE GETDATE()
		// 		                       END
		// 		    ORDER BY initial,cprod DESC";	

		$query = "SELECT DISTINCT 
				       hlp.BusinessDate AS BusinessDate
				      ,p.ProductCode AS productid
				      ,(SUBSTRING(p.ProductCode,1,2)) AS initial
				      ,(SUBSTRING(p.ProductCode,6,8)) AS cprod
				      ,CASE p.ProductCode
				        WHEN 'TLEAD300' THEN
				          CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                    THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
                      THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
                          THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                     THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp1.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp1))
                             ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
                             END
                           ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
                           END
                        ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
                        END
                      ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
                      END
                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')                              
				          END 
				        WHEN 'TLEAD200' THEN
				          CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
				       	  THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                    THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
                      THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                  THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp2.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp2))
				                  ELSE 
				                    (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
				                  END
				                ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
				                END
                      ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
                      END
                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
                    END
                  ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
                  END
				        WHEN 'TLEAD100' THEN
				          CASE 
				          WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
				         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
				              THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
                           THEN CASE WHEN (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                    THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp3.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp3))
				                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
				                  END
				                ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
				                END
				              ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')      
				              END
                     ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')      
				             END
                    ELSE (SELECT TOP 1 MAX(Price) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')      
				            END
				         WHEN 'TLEAD050' THEN
				          CASE
				          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
				         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
				              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
                        THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
                            THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				                      THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice WHERE ID = (SELECT MAX(hlp4.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp4))
				                      ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEA099')
				                      END
				                    ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
				                    END
				                 ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
				                END
                       ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
				               END
  				          ELSE
  				          (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
  				         END
				         WHEN 'TPURE099' THEN
				          CASE
				          WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099') IS NULL
				         	  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050') IS NULL
				              THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100') IS NULL
				                THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200') IS NULL
				                  THEN CASE WHEN (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300') IS NULL
				                    THEN (SELECT TOP 1 FloorPrice + 400 FROM TIN_BBJ_Staging.dbo.HiLoPrice  WHERE ID = (SELECT MAX(hlp5.ID) FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp5))
				                     ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD300')
				                    END
				                  ELSE (SELECT TOP 1 MAX(Price + 400) FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD200')
				                  END
				                ELSE (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD100')
				                END
				              ELSE (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TLEAD050')
				              END
				          ELSE
				          (SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate =  hlp.BusinessDate AND ProductCode = 'TPURE099')
				         END 
				      END AS Price
				    FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp, SKD.Product p  
				      LEFT JOIN SKD.RawTradeFeed rtf ON p.ProductCode = rtf.ProductCode
				      WHERE 
				      hlp.BusinessDate = CASE WHEN (SELECT BusinessDate FROM TIN_BBJ_Staging.dbo.HiLoPrice hlp6 WHERE BusinessDate = GETDATE()) IS NULL  
				                            THEN (SELECT MAX(BusinessDate) FROM TIN_BBJ_Staging.dbo.HiLoPrice)
				                             ELSE GETDATE()
				                       END 
				                       ORDER BY initial,cprod DESC";
	    $rcd = $db->Execute($query);
		// print_r($rcd);
		// exit();
	    return $rcd;
	} 

	public function get_last_trans(){
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

		$query = "SELECT DISTINCT 
				  rtf.BusinessDate,
				  ssa.productid, 
				  ssa.brand,
				(SELECT TOP 1 Price + 400 FROM TIN_KBI.SKD.RawTradeFeed WHERE BusinessDate = rtf.BusinessDate ) AS Price,
				  SUBSTRING(ssa.productid,6,8) AS Cprod
				  FROM SKD.StagingSellerAllocation ssa 
				  LEFT JOIN TIN_KBI.SKD.RawTradeFeed rtf ON ssa.productid = rtf.ProductCode
				  LEFT JOIN TIN_BBJ_Staging.dbo.HiLoPrice hlp ON rtf.BusinessDate = hlp.BusinessDate
				  WHERE rtf.BusinessDate = (SELECT MAX(rtf1.BusinessDate) FROM TIN_KBI.SKD.RawTradeFeed rtf1)
  					ORDER BY Cprod DESC";
	    $rcd = $db->Execute($query);
		// print_r($rcd);
		// exit();
	    return $rcd;
	} 

}

/* End of file m_tpa_01_cek_code.php */
/* Location: ./application/models/m_tpa_01_cek_code.php */