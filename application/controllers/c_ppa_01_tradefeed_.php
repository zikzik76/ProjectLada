<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_ppa_01_tradefeed extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_tradefeed_form');
		$this->load->view('templates/footer');

	}

	public function upload_data(){


		$config['upload_path'] = APPPATH.'files';
		$config['allowed_types'] = 'xlx|xlsx';

		$this->load->library('form_validation');
		$this->load->library('upload', $config);
		
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

			for ($row=4; $row <= $lastRow ; $row++) {

			    // $query = "INSERT INTO dbo.USER_ID(id,testid) Values (".$worksheet->getCell('A'.$row)->getValue().",'".$worksheet->getCell('B'.$row)->getValue()."')";
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
										GETDATE(),
										GETDATE(),
										'".$worksheet->getCell('A'.$row)->getValue()."',
										'".$worksheet->getCell('B'.$row)->getValue()."',
										'".$worksheet->getCell('C'.$row)->getValue()."',
										".$worksheet->getCell('D'.$row)->getValue().",
										".$worksheet->getCell('E'.$row)->getValue().",
										GETDATE(),
										'".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
										'Y',
										'".$worksheet->getCell('F'.$row)->getValue()."',
										'".$worksheet->getCell('G'.$row)->getValue()."',
										'".$worksheet->getCell('H'.$row)->getValue()."',
										'".$worksheet->getCell('I'.$row)->getValue()."',
										'".$worksheet->getCell('J'.$row)->getValue()."'
									)";
				
			    $rcd = $db->Execute($query);

			}
		 echo "<script>alert(UPLOAD SUCCESS)</script>";
		$this->load->helper(array('form', 'url'));
		$this->load->view('templates/header');
		$this->load->view('pages/v_ppa_01_tradefeed_form');
		$this->load->view('templates/footer');
		
		}

	}
}

/* End of file clearing_member.php */
/* Location: ./application/controllers/clearing_member.php */