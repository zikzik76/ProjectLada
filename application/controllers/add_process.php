<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_process extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here


	}

	public function index()
	{

		$this->load->model('model_login_log');
		$this->load->model('model_process');
		
		$push_data = $this->model_login_log->push_data();
		$result['value'] = $this->model_process->get_all_data();

		$this->load->view('templates/header');
		$this->load->view('processform',$result);
	}

	public function new_proses(){
		// var_dump($this->input->post('send_data'));

		$this->load->model('model_process');
		$response['get_divisi'] = $this->model_process->get_divisi_cbb();

		die(json_encode($response));
		

	}

	public function input_data_proses(){

	$id_divisi = $this->input->post('id_divisi');
    $proses =	$this->input->post('proses');

    $this->load->model('Model_process');
    $response = $this->Model_process->input_data_process($id_divisi,$proses);

    die(json_encode($response));
	}

}

/* End of file add_proses.php */
/* Location: ./application/controllers/add_proses.php */