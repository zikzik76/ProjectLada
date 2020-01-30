<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_tradefeed extends CI_Controller {

	public function index()
	{
		// ini_set('error_reporting', E_ALL & ~E_NOTICE);
		session_start();
		$this->load->helper(array('form', 'url'));

		$this->load->model('m_tpa_01_query_appstat');
        $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);

        if($appstat === NULL) 
        {
        	echo 'Error 401 - CT120';
        } else {
        	foreach ($appstat as $val) {
	        	$priv['user_cm']  = $val['username'];
	        	$priv['flag_user'] = $val['flaguser'];
	        	$priv['type'] = $val['CMType'];
	        	$priv['stat_dom'] = $val['StatusDomisiliFlag'];
	        	$priv['stat_app'] = $val['ApprovalStatus'];
	     	}
	    }


		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_ppa_01_tradefeed_form');
		$this->load->view('templates/footer');

	}

	public function upload_data(){
	// ini_set('error_reporting', E_ALL & ~E_NOTICE);
		// $bd = $this->input->post('date_tf');
		// $bd = date('Y-m-d', strtotime($bd));
		// echo $bd;
		// exit();
		$config['upload_path'] = APPPATH.'files';
		$config['allowed_types'] = 'xlx|xlsx';

		$this->load->library('form_validation');
		$this->load->library('upload', $config);
		
		include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
			include (APPPATH.'libraries/adodb/adodb.inc.php');

			    $db_host = '10.10.100.178';
			    $db_user = 'sadev_lada';
			    $db_pass = 'Kbi2015';
			    $db_data = 'EMASONLINE_DEV';

			    $db = NewADOConnection('odbc_mssql');
			    $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
			    $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
			    $db->SetFetchMode(ADODB_FETCH_ASSOC);

		if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());
			echo 'masih error bro !!';
		}
		else{
			$data = array('upload_data' => $this->upload->data());

			$upload_data = $this->upload->data();

			$this->load->library('phpexcel/PHPExcel');
			$this->load->library('phpexcel/IOFactory');
			// $this->load->model('insert_model');

			$file = $upload_data['full_path'];
			$excelReader = IOFactory::createReaderForFile($file);
			$excelobj = $excelReader->load($file);
			$worksheet = $excelobj->getSheet(0);
			$lastRow = $worksheet->getHighestRow(); 

				// $query_1 = "TRUNCATE TABLE Tradefeed ;";
			 //    $rcd_1 = $db->Execute($query_1);

			for ($row=4; $row <= $lastRow ; $row++) {

			    // $query = "INSERT INTO dbo.USER_ID(id,testid) Values (".$worksheet->getCell('A'.$row)->getValue().",'".$worksheet->getCell('B'.$row)->getValue()."')";
			    $tradetime = $worksheet->getCell('K'.$row)->getValue();
			    $strtradetime = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($tradetime));



			    $query = "INSERT INTO Tradefeed (
									businessdate,
									transactiontime,
									investorcode,
									investtype,
									goldtype,
									price,
									volume,
									uploaddate,
									uploadby,
									state,
									movetoother,
									isdelivered,
									isbuy,
									issell,
									isambilfisik
								)
								VALUES
									(
										'".$strtradetime."',
										'".$strtradetime."',
										'".$worksheet->getCell('A'.$row)->getValue()."',
										'".$worksheet->getCell('B'.$row)->getValue()."',
										'".$worksheet->getCell('C'.$row)->getValue()."',
										".$worksheet->getCell('D'.$row)->getValue().",
										".$worksheet->getCell('E'.$row)->getValue().",
										'".$strtradetime."',
										'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
										'Y',
										'".$worksheet->getCell('F'.$row)->getValue()."',
										'".$worksheet->getCell('G'.$row)->getValue()."',
										'".$worksheet->getCell('H'.$row)->getValue()."',
										'".$worksheet->getCell('I'.$row)->getValue()."',
										'".$worksheet->getCell('J'.$row)->getValue()."'
									)";
				
			    $rcd = $db->Execute($query);

				 // $query2 = "SELECT * FROM Tradefeed WHERE businessdate = '".$strtradetime."'";
				 // $rcd_2['value'] = $db->Execute($query2);
					// $this->load->view('templates/header');
					// $this->load->view('pages/v_ppa_01_tradefeed_form',$rcd_2);
					// $this->load->view('templates/footer');

			
		 // echo "<script>alert(UPLOAD SUCCESS)</script>";
		 // $currentdate = date('Y-m-d');
		 // $query2 = "SELECT * FROM Tradefeed";
		 // $rcd_2['value'] = $db->Execute($query2);
			// $this->load->view('templates/header');
			// $this->load->view('pages/v_ppa_01_tradefeed_form',$rcd_2);
			// $this->load->view('templates/footer');
		 // echo $currentdate;
		// }

		 // if ($rcd_2 != NULL) {
			//  $this->load->helper(array('form', 'url'));

		 // } else {

		 // 	redirect(base_url('index.php/c_ppa_01_clearing_member'),'refresh');
		 // }
		
		// $currentdate2 = date('Y-m-d');
		 // echo $currentdate;
		 // $query3 = "SELECT * FROM Tradefeed WHERE businessdate = '".$currentdate2."'";
		 // $rcd_3['value'] = $db->Execute($query2);

		 // 	$this->load->helper(array('form', 'url'));
			// $this->load->view('templates/header');
			// $this->load->view('pages/v_ppa_01_tradefeed_form',$rcd_2);
			// $this->load->view('templates/footer');
		}
		echo '<div class="alert alert-success">
			  <strong>Success!</strong>.
			</div>';
		redirect(base_url('index.php/c_ppa_01_tradefeed'),'refresh');
	}
}
}
/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */