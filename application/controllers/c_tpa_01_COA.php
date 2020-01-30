
<?php
// print_r(phpinfo());
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_coa extends CI_Controller {

	public function index()
	{
        // echo phpinfo();
		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form','download'));

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
                    $priv['stat_bd'] = $val['Business_Date'];
                    $priv['stat_cielp'] = $val['Ceilling_price'];
                    $priv['stat_cielf'] = $val['Floor_Price'];
                }
            }
        $this->load->view('templates/header',$priv);
        $this->load->view('pages/v_tpa_01_coa');
        $this->load->view('templates/footer');
	}

    public function insert_data_coa()
    {
        $getBundle = $this->input->post('bundle');
        $getBundleExplode = array_filter(explode('|', $getBundle));

        $getmineral = $this->input->post('bundle_mineral');
        $getmineralExplode = array_filter(explode('|', $getmineral));

        $getMarking = $this->input->post('bundle_marking');
        $getMarkingExplode = array_filter(explode('|', $getMarking));
        // print_r($getmineralExplode);
        // exit();

        $bst_no = $this->input->post('bst_no');
        $depositor_ = $this->input->post('depositor');
        $coa_no = $this->input->post('coa_bst_no');
        $lop_number = $this->input->post('lop_number');
        $trade_AccountNumber = $this->input->post('trade_AccountNumber');
        $contract_Code = $this->input->post('contract_Code');
        $warehouse_loc = $this->input->post('warehouse_loc');
        $batch_Number = $this->input->post('batch_Number');
        $quantity = $this->input->post('quantity'); 
        $brand__ = $this->input->post('brand_'); 
        $pic = $this->input->post('pic');
        $commodity = $this->input->post('commodity');
        $DoAnalis = $this->input->post('DoAnalis');

        $this->load->model('m_tpa_01_insert_coa');
        $result = $this->m_tpa_01_insert_coa->insert_coa_detail($bst_no,$coa_no,$lop_number,$trade_AccountNumber,$contract_Code,$warehouse_loc,$batch_Number,$quantity,$depositor_,$brand__,$pic,$commodity,$DoAnalis);
        foreach ($result as $value) {
            $val_id = $value['LastCoaId'];
        }
        $counter = 0;

        $result_array = array();
        $result_array2 = array();
        $result_array3 = array();

        foreach ($getBundleExplode as $val) {
            $result_array[$counter] = $val;
            $result_explode[$counter] = explode(",", $result_array[$counter]);

            $result_bundle = $this->m_tpa_01_insert_coa->insert_coa_bundle($val_id,$result_explode[$counter][1],$result_explode[$counter][2]);
            $counter++;
        }

        foreach ($getmineralExplode as $val2) {
            $result_array2[$counter] = $val2;
            $result_explode2[$counter] = explode(",", $result_array2[$counter]);

            $result_mineral = $this->m_tpa_01_insert_coa->insert_coa_mineral($val_id,$result_explode2[$counter][1],$result_explode2[$counter][2]);
            $counter++;
        }
        
        //insert marking
        foreach ($getMarkingExplode as $val3) {
            $result_array3[$counter] = $val3;
            $result_explode3[$counter] = explode(",", $result_array3[$counter]);

            $result_marking = $this->m_tpa_01_insert_coa->insert_coa_marking($val_id,$result_explode3[$counter][1],$result_explode3[$counter][2]);
            $counter++;
        }


        // exit();
        // die(json_encode('Upload Data SUkses'));
        $this->index();

    }

    function insert_excel()
	{
		$this->load->library('phpexcel/PHPExcel');
		$this->load->library('phpexcel/IOFactory');
		
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$nama = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$alamat = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$data[] = array(
						'Nama'		=>	$nama,
						'Alamat'	=>	$alamat,
					);
				}
			}
			$this->m_tpa_01_insert_coa->insert_excel($data);
			echo 'Data Imported successfully';
		}	
	}

}

/* End of file c_tpa_01_COA.php */
/* Location: ./application/controllers/c_tpa_01_COA.php */