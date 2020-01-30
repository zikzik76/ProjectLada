<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_rules extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form','download'));
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/footer');
	}

}

/* End of file c_tpa_01_rules.php */
/* Location: ./application/controllers/c_tpa_01_rules.php */