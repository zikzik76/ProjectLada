<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class c_keanggotaan_baru  extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');
	}

	public function index()
	{
		session_start();

        $this->load->model('m_tpa_01_query_appstat');
        $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);

        
        if($appstat === NULL OR $appstat === '') 
        {

        	echo 'Error 401 - CT120';
        } else {
        	// $priv = array();
        	foreach ($appstat as $val) 
        	{

	        	$priv['user_cm']  = $val['username'];
	        	$priv['flag_user'] = $val['flaguser'];
	        	$priv['type'] = $val['CMType'];
	        	$priv['stat_dom'] = $val['StatusDomisiliFlag'];
	        	$priv['stat_app'] = $val['ApprovalStatus'];
	        	$priv['stat_bd'] = $val['Business_Date'];
	        	$priv['stat_cielp'] = $val['Ceilling_price'];
	        	$priv['stat_cielf'] = $val['Floor_Price'];

	        }

            $this->load->view('templates/header',$priv);	
            $this->load->view('pages/v_keanggotaan_baru');
            switch ($variable) {
                case 'value':
                    # code...
                    break;
                
                default:
                    # code...
                       
                    break;
            }
            	
			$this->load->view('templates/footer');	
        }
    }
    public function getDataList()
    {
        $this->load->view('pagepelaku/v_seller'); 
    }
    public function getDomesticForm()
    {
        $this->load->view('pagepelaku/v_buyer_domestic');
    }
    public function getForignForm()
    {
        $this->load->view('pagepelaku/v_buyer_forign');
    }
}