<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_form extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('session');
		// $this->load->model('model_login');
	}

	public function index()
	{

		$this->load->model('model_jobs');
		$this->load->model('model_login_log');

		$push_data = $this->model_login_log->push_data();
		$data['value'] = $this->model_jobs->get_alljobs();
	
		$this->load->view('templates/header');
		$this->load->view('index5',$data);
		$this->load->view('templates/footer');
	}

	public function insert_new_employee()
	{
		$this->load->view('insert_employee');
		// $this->load->view('templates/footer');
	}

	public function getdata(){
		


		// $this->load->view('update_employee');
		// update_emp($x);
		
		// $this->session->set_userdata(  );
		// die(json_encode($x));
	}

	public function update_emp(){
		$data['x']= $this->input->post('nik');
		// $get_data = array(
		// 	'NIK_' => 'nik'
		// );
		var_dump($data);
		
		$this->load->view('update_employee',$data);
		// var_dump($x);
		// $this->load->view('update_employee');
	}
	// public function add_new(){
	// 	$get_data_add_new = $this->input->get('data_alert');

	// 	$this->load->model('model_cbb_proses');
	// 	$result['data_proses'] = $this->model_cbb_proses->get_all_data();
	// 	$result['data_risiko'] = $this->model_cbb_proses->cbb_risiko();
	// 	$result['data_event'] = $this->model_cbb_proses->cbb_event();

	// 	die(json_encode($result));
	// }

	// public function edit_rows(){
	// 	// $a = $this->input->get_post('id_uraian');
	// 	$get_row = $this->input->get('id_uraian');
	// 	// $get_row_risiko = $this->input->get('id_risiko');
	// 	$this->load->model('model_jobs');
	// 	$get_data = $this->model_jobs->get_edit_row($get_row);
	// 	$result = array();

	// 	// $result = $get_data[0]['id_uraian'];
	// 	foreach ($get_data as $value) {
	// 		$result['uraian'] = $value['id_uraian'];
	// 		$result['proses_divisi'] = $value['proses_divisi'];
	// 		// $result['r_id'] = $value['id_risiko'];
	// 		$result['id_uraian'] = $value['id_uraian'];
	// 	}
	// 	// var_dump($result);
	// 	// foreach ($get_data as $row) {
	// 	// 	$result['data_proses'] = $get_data['proses_divisi']; 
	// 	// }
	// 	// $test = isset($_POST['id_uraian']) ? $_POST['id_uraian'] : NULL;
	// 	$response = $result;

	// 	die(json_encode($response));
	// }

	// public function save_new_add(){
	// 	// $a = $this->input->get('RM_RTU_');
	// 	// var_dump($a);
	// 	// echo $a;
	// 	$data_uraian = array(
	// 			"get_proses_cbb_" => $this->input->get("get_proses_cbb_"),
	// 			"get_risiko_cbb_" => $this->input->get("get_risiko_cbb_"),
	// 			"RM_RTU_" => $this->input->get("RM_RTU_"),
	// 			"RM_Category_" => $this->input->get("RM_Category_"),
	// 			"RM_aktivitas_" => $this->input->get("RM_aktivitas_"),
	// 			"RM_escalation_" => $this->input->get("RM_escalation_"),
	// 			"RM_Leading_" => $this->input->get("RM_Leading_"),
	// 			"RM_respon_" => $this->input->get("RM_respon_"),
	// 			"RM_pengendalian_" => $this->input->get("RM_pengendalian_"),
	// 			"RM_uraian_" => $this->input->get("RM_uraian_"),
	// 			"RM_divisi_" => $this->input->get("RM_divisi_"),
	// 			"RM_user_input_" => $this->input->get("RM_user_input_")
	// 		);

	// 	$this->load->model('model_input_uraian');
	// 	$this->model_input_uraian->insert_all_data($data_uraian);

	// 	$send_alert = 'data input success';
	// 	die(json_encode($send_alert));
	// }

	// public function delete_old(){

	// 	$get_row = $this->input->POST('send_row');
	// 	// echo($get_row);x
	// 	$this->load->model('model_delete');
	// 	$this->model_delete->delete_all_data($get_row);

	// 	 $send_message = 'data deleted';
	// 	// $send_message = $get_row;
	// 	die(json_encode($send_message));

	// }

	// public function save_new_edit(){
	// 	$get_data_risiko = $this->input->post('data_alert');
	// 	$inherent_like = $this->input->post('inherent_like');
	// 	$inherent_dampak = $this->input->post('inherent_dampak');
	// 	$inherent_skor = $this->input->post('inherent_skor');
	// 	$residual_like = $this->input->post('residual_like');
	// 	$residual_dampak = $this->input->post('residual_dampak');
	// 	$residual_skor = $this->input->post('residual_skor');
	// 	$id_uraian = $this->input->post('id_uraian');

	// 	// var_dump($inherent_skor);

	// 	$this->load->model('model_jobs');
	// 	$this->model_jobs->set_update_risiko(
	// 					$inherent_like,
	// 					$inherent_dampak,
	// 					$inherent_skor,
	// 					$residual_like,
	// 					$residual_dampak,
	// 					$residual_skor,
	// 					$id_uraian);

	// 	$update_success_alert = 'update success';
	// 	die(json_encode($update_success_alert));
	// }
}

/* End of file main_form.php */
/* Location: ./application/controllers/main_form.php */