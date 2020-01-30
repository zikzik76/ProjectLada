<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Shipping Instruction Update 	
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_siupdate extends CI_Model {

	public function si_update($n,$bst,$tradeID){
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
	    // echo "<br>";
	    // print_r($n.' - '.$bst.' - '.$tradeID);
	    // exit();
	    $n = $db->escape($n);
	    $bst = $db->escape($bst);
	    $tradeID = $db->escape($tradeID);

	    $query = "UPDATE SKD.RawTradefeed SET 
	    			ShippingInstructionUrl = '".$n."', 
	    			ShippingInstructionFlag = 'P', 
	    			ShippingInstructionUpdate = GETDATE(), 
	    			ShippingInstructionFTP = NULL 
	    			WHERE SellerRef = '".$bst."' AND TradeFeedID = '".$tradeID."'";

	    $result = $db->execute($query);

	    $query_ = "UPDATE SKD.TradeFeed SET 
	    			ShippingInstructionUrl = '".$n."', 
	    			ShippingInstructionFlag = 'P', 
	    			ShippingInstructionUpdate = GETDATE(), 
	    			ShippingInstructionFTP = NULL 
	    			WHERE SellerRef = '".$bst."' AND TradeFeedID = '".$tradeID."'";

	    $result_ = $db->execute($query_);


	    return $result_;
	}

}