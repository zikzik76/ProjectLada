<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_insert_coa extends CI_Model {
	public function insertAll()
	{
		$db_host = 'KBIDEV-TIMAH-DBMS';
	    $db_user = 'sadev_lada';
	    $db_pass = 'Kbi@Kbi2021';
	    $db_data = 'TIN_KBI';

	    $db = NewADOConnection('odbc_mssql');
	    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
	    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
	    $db->SetFetchMode(ADODB_FETCH_ASSOC);
	    $coaid = $db->escape($coaid);
	    $bundle = $db->escape($bundle);
		$weight = $db->escape($weight);
		
		$this->insert_coa_detail();
		$this->insert_coa_bundle();
		$this->insert_coa_mineral();
		$this->insert_coa_marking();
	}
	public function insert_coa_detail($bst_no,$coa_no,$lop_number,$trade_AccountNumber,$contract_Code,$warehouse_loc,$batch_Number,$quantity,$depositor_,$brand__,$pic,$commodity,$DoAnalis)
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
		
		$bst_no = $db->escape($bst_no);
		$coa_no = $db->escape($coa_no);
		$lop_number = $db->escape($lop_number);
		$trade_AccountNumber = $db->escape($trade_AccountNumber);
		$contract_Code = $db->escape($contract_Code);
		$warehouse_loc = $db->escape($warehouse_loc);
		$batch_Number = $db->escape($batch_Number);
		$quantity = $db->escape($quantity);
		$depositor_ = $db->escape($depositor_);
		$brand__ = $db->escape($brand__);
		$pic = $db->escape($pic);
		$commodity = $db->escape($commodity);
		$DoAnalis = $db->escape($DoAnalis);				

		$query = "INSERT INTO SKD.COA
					(
						NoBST,
						TradeAccountNumber,
						WarehouseLoc,
						Depositor,
						RegisteredTINExportNo,
						COANo,
						BatchNumber,
						Quantity,
						LevelOfPurity,
						ContractCode,
						Brand,
						PIC,
						Commodity,
						DateOfAnalis
					) 
					VALUES 
					(
					'".$bst_no."',
					'".$trade_AccountNumber."',
					'".$warehouse_loc."',
					'".$depositor_."',
					'',
					'".$coa_no."',
					'".$batch_Number."',
					'".$quantity."',
					'".$lop_number."',
					'".$contract_Code."',
					'".$brand__."',
					'".$pic."',
					'".$commodity."',
					'".$DoAnalis."'
					)";
		// print_r($query);
		// exit();
		$rcd = $db->Execute($query);				
			$query_get_id = "SELECT MAX(CoaId) AS LastCoaId FROM SKD.COA;";

			$rcd_get_id = $db->Execute($query_get_id);

			return $rcd_get_id;

	}
	
	public function insert_coa_bundle($coaid,$bundle,$weight)
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
	    $coaid = $db->escape($coaid);
	    $bundle = $db->escape($bundle);
	    $weight = $db->escape($weight);

	  	$query = "INSERT INTO SKD.CoaBundle
	  				(
	  					BundleCode,
	  					Weight,
	  					CoaId
	  				) 
	  				VALUES 
	  				(
	  					'".$bundle."',
	  					'".$weight."',
	  					'".$coaid."'
	  				)";
	  	// print_r($query);
	  	// exit();
	  	$rcd = $db->Execute($query);


	  	// $query_get_id = "SELECT MAX(CoaId) AS LastCoaId FROM SKD.COA;";

	  	// $rcd_get_id = $db->Execute($query_get_id);


	    return false;
	}

	public function insert_coa_mineral($coaid,$mineralinitial,$content)
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
	    
	    $coaid = $db->escape($coaid);
	    $mineralinitial = $db->escape($mineralinitial);
	    $content = $db->escape($content);
	  	$query = "INSERT INTO SKD.CoaMinerals
	  				(
	  					MineralInitial,
	  					contents,
	  					CoaId
	  				) 
	  				VALUES 
	  				(
	  					'".$mineralinitial."',
	  					'".$content."',
	  					'".$coaid."'
	  				)";
	  	// print_r($query);
	  	// exit();
	  	$rcd = $db->Execute($query);


	  	// $query_get_id = "SELECT MAX(CoaId) AS LastCoaId FROM SKD.COA;";

	  	// $rcd_get_id = $db->Execute($query_get_id);


	    return false;
	}
	public function insert_coa_marking($coaid,$Name,$Number)
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
	    
	    $coaid = $db->escape($coaid);
	    $Name = $db->escape($Name);
	    $Number = $db->escape($Number);
	  	$query = "INSERT INTO CoaMarking
	  				(
	  					Name,
	  					Number,
	  					coaId
	  				) 
	  				VALUES 
	  				(
	  					'".$Name."',
	  					'".$Number."',
	  					'".$coaid."'
	  				)";
	  	// print_r($query);
	  	// exit();
	  	$rcd = $db->Execute($query);


	  	// $query_get_id = "SELECT MAX(CoaId) AS LastCoaId FROM SKD.COA;";

	  	// $rcd_get_id = $db->Execute($query_get_id);


	    return false;
	}

	function insert_excel($data)
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

		foreach ($data as $item) 
		{
	    	$nama = $db->escape($item['Nama']);
	    	$alamat = $db->escape($item['Alamat']);

	    	$query = "INSERT INTO dbo.test_input
	  				(
	  					nama,
	  					alamat
	  				) 
	  				VALUES 
	  				(
	  					'".$nama."',
	  					'".$alamat."'
					)";
					  
	  		$rcd = $db->Execute($query);
	    }
	    return false;
	}
}

/* End of file m_tpa_01_insert_coa.php */
/* Location: ./application/models/m_tpa_01_insert_coa.php */