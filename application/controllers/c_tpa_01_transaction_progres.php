<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 15 Jun 2011
    Description         : View Progress Of Transaction (EODTradeProgress)
    Version             : 1.0 Production
=================================================================== 
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_transaction_progress extends CI_Controller {

	public function index()
	{
		session_start();
		$this->load->helper('form');
        $this->load->helper('html');
        
        $this->load->helper('security');
        $this->load->library('session');
		$this->load->helper(array('form', 'url'));
		

		$this->load->view('templates/header',$priv);
		$this->load->view('pages/v_ppa_01_transaction_progress');
		$this->load->view('templates/footer');

	}

}

/* End of file c_tpa_01_progress.php */
/* Location: ./application/controllers/c_tpa_01_progress.php */