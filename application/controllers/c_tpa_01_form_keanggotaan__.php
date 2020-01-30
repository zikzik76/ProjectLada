<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Registration Buyer Or Seller
    Version             : 1.0 Production
=================================================================== 
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_form_keanggotaan  extends CI_Controller {

	public function index()
	{
		session_start();
		
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->helper(array('url','form'));
        $this->load->model('m_tpa_01_query_appstat');
        $appstat['app_stat'] = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);
		$this->load->view('templates/header',$appstat);	
		$this->load->view('pages/v_tpa_01_form_keanggotaan');	
		$this->load->view('templates/footer');	
	}

	public function regist_anggota_profile(){
		
		session_start();
		$anggota = $this->input->post('optradio_anggota');
		if($anggota === 'Buyer'){
			$jenis_anggota = $this->input->post('optradio_jenis');
	        $n_calon = $this->input->post('n_calon');
	        $s_calon = $this->input->post('st_calon');
	        $no_acc = $this->input->post('no_account_bank');
	        $acc_name = $this->input->post('account_name');
	        $bank_name = $this->input->post('bank_name');
	        $replace_white = str_replace(array('tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')'), '', $n_calon);
	        $explode_calon = explode(' ', $replace_white);
			$count_array = count($explode_calon);
			$email = $_SESSION['val']['email'];
			$notlp = $_SESSION['val']['notlp'];
			$username = $_SESSION['val']['notlp'];
	        
	        $str_len = strlen($explode_calon[1]);
	        
	        // print_r($n_calon);
	       	
	        $concat = array();
	        $substr = '';
	        for ($i=1; $i < $count_array ; $i++) { 
	        	$str_len_ = strlen($explode_calon[$i]);
	        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	        	$concat['val'] = $substr;

	        }

	        $concat_substr = $concat['val'];
	        $len_cm = strlen($anggota);
	        $member_initial = substr($anggota, 0,($len_cm - 1)*-1) ;
	        $current_month = date('m');
	        $current_year = date('y');


	        $count_length_str2nd = strlen($concat_substr);
	        if ($count_length_str2nd === 2){
	        	$str_len_2nd = strlen($explode_calon[2]);
	        	$sub_str_2nd = substr($explode_calon[2], 1,1);
	        	$concat_code_cm = $member_initial.''.$concat_substr.''.$sub_str_2nd.''.$current_month.''.$current_year;
	        	// print_r($concat_code_cm);
	        	// echo '<br>';
	        } else {
	        	$concat_code_cm = $member_initial.''.$concat_substr.''.$current_month.''.$current_year;
	        }


			if(!file_exists(APPPATH.'files/'.$concat_code_cm)){
				mkdir(APPPATH.'files/'.$concat_code_cm, 0777, true);
			} else {
				// folder dengan inisial tersebut sudah ada di dalam sistem
				echo "<script>alert('error-R01 ')</script>";
				exit();
			}

	        $config['upload_path'] = APPPATH.'files/'.$concat_code_cm;
			$config['allowed_types'] = 'PDF|pdf';
			$config['encrypt_name'] = TRUE;
			$config['raw_name'] = 'file_anggota';
			$config['file_name'] = $n_calon;
			$this->load->library('form_validation');
			$this->load->library('upload', $config);

			$akte_pendiri = ''; //akte pendirian perusahaan
			if ( !$this->upload->do_upload('ak_pen')){
			echo 'File yang anda Upload Akte Pendiri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				// $this->ftp->mkdir('/ftp/files/'.$concat_code_cm, DIR_WRITE_MODE);
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data();
				$path_full = $upload_data['full_path'];	
				$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
				$akte_pendiri = $str_replace;				
			}
			// exit();

			$akte_perubahan = ''; //akte perubahan
			if ( !$this->upload->do_upload('ak_per')){
			echo 'File yang anda Upload Akte Perubahan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_per = array('upload_data' => $this->upload->data());
				$upload_data_per = $this->upload->data();
				$path_full_per = $upload_data_per['full_path'];	
				$str_replace_per = str_replace('C:/xampp/htdocs/', '', $path_full_per);		
				$akte_perubahan = $str_replace_per;				
			}

			$domisili_perusahaan = '';
			if ( !$this->upload->do_upload('domi_per')){
			echo 'File yang anda Upload berkas domisili tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_dom = array('upload_data' => $this->upload->data());
				$upload_data_dom = $this->upload->data();
				$path_full_dom = $upload_data_dom['full_path'];	
				$str_replace_dom = str_replace('C:/xampp/htdocs/', '', $path_full_dom);		
				$domisili_perusahaan = $str_replace_dom;				
			}

			$npwp_perusahaan = '';
			if ( !$this->upload->do_upload('npwp')){
			echo 'File yang anda Upload berkas NPWP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_npwp = array('upload_data' => $this->upload->data());
				$upload_data_npwp = $this->upload->data();
				$path_full_npwp = $upload_data_npwp['full_path'];	
				$str_replace_npwp = str_replace('C:/xampp/htdocs/', '', $path_full_npwp);		
				$npwp_perusahaan = $str_replace_npwp;				
			}


			$perizinan_instansi = '';
			if ( !$this->upload->do_upload('izin_instansi')){
			echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_izin = array('upload_data' => $this->upload->data());
				$upload_data_izin = $this->upload->data();
				$path_full_izin = $upload_data_izin['full_path'];	
				$str_replace_izin = str_replace('C:/xampp/htdocs/', '', $path_full_izin);		
				$perizinan_instansi = $str_replace_izin;				
			}

		

			$this->load->model('m_tpa_01_query_insert_buyer');
			$this->m_tpa_01_query_insert_buyer->ClearingMemberTable($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name);
	        redirect(base_url('index.php'),'refresh');
	        session_destroy();
	        exit();

		} else {
			// print_r('PENJUAL');
			$jenis_anggota = $this->input->post('optradio_jenis');
	        $n_calon = $this->input->post('n_calon_seller');
	        $s_calon = $this->input->post('st_calon_seller');
	        $no_acc = $this->input->post('no_account_bank_seller');
	        $acc_name = $this->input->post('account_name_seller');
	        $bank_name = $this->input->post('bank_name_seller');
	        $replace_white = str_replace(array('tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')'), '', $n_calon);
	        $explode_calon = explode(' ', $replace_white);
			$count_array = count($explode_calon);
			$email = $_SESSION['val']['email'];
			$notlp = $_SESSION['val']['notlp'];

	        $str_len = strlen($explode_calon[1]);
	        substr($explode_calon[1], 0,($str_len - 1)*-1);
	        $concat = array();
	        $substr = '';
	        for ($i=1; $i < $count_array ; $i++) { 
	        	$str_len_ = strlen($explode_calon[$i]);
	        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	        	$concat['val'] = $substr;
	        }


	        $concat_substr = $concat['val'];
	        // print_r($a);
	        $len_cm = strlen($anggota);
	        $member_initial = substr($anggota, 0,($len_cm - 1)*-1);
	        $current_month = date('m');
	        $current_year = date('y');

	        $count_length_str2nd_sell = strlen($concat_substr);
	        if ($count_length_str2nd_sell === 2){
	        	$str_len_2nd_sell = strlen($explode_calon[2]);
	        	$sub_str_2nd_sell = substr($explode_calon[2], 1,1);
	        	$concat_code_cm = $member_initial.''.$concat_substr.''.$sub_str_2nd_sell.''.$current_month.''.$current_year;
	        	// print_r($concat_code_cm);
	        	// echo '<br>';
	        } else {
	        	$concat_code_cm = $member_initial.''.$concat_substr.''.$current_month.''.$current_year;
	        }

	        // $concat_code_cm = $member_initial.''.$concat_substr.''.$current_month.''.$current_year;
			if(!file_exists(APPPATH.'files/'.$concat_code_cm)){
				mkdir(APPPATH.'files/'.$concat_code_cm, 0777, true);
			} else {
				echo "<script>alert('error- nanti dinamain, pokoknya nama foldernya ada yang sama')</script>";
				exit();
			}

	        $config['upload_path'] = APPPATH.'files/'.$concat_code_cm;
			$config['allowed_types'] = 'PDF|pdf';
			$config['encrypt_name'] = TRUE;
			$config['raw_name'] = 'file_anggota';
			$config['file_name'] = $n_calon;
		
			$this->load->library('form_validation');
			$this->load->library('upload', $config);

			$akte_pendiri = ''; //akte pendirian perusahaan
			if ( !$this->upload->do_upload('akta_pen_seller')){
			echo 'File yang anda Upload Akte Pendiri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data();
				$path_full = $upload_data['full_path'];	
				$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
				$akte_pendiri = $str_replace;				
			}

			$akte_perubahan = ''; //akte perubahan
			if ( !$this->upload->do_upload('akta_per_seller')){
			echo 'File yang anda Upload Akte Perubahan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_per = array('upload_data' => $this->upload->data());
				$upload_data_per = $this->upload->data();
				$path_full_per = $upload_data_per['full_path'];	
				$str_replace_per = str_replace('C:/xampp/htdocs/', '', $path_full_per);		
				$akte_perubahan = $str_replace_per;				
			}

			$domisili_perusahaan = '';
			if ( !$this->upload->do_upload('dom_seller')){
			echo 'File yang anda Upload berkas domisili tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_dom = array('upload_data' => $this->upload->data());
				$upload_data_dom = $this->upload->data();
				$path_full_dom = $upload_data_dom['full_path'];	
				$str_replace_dom = str_replace('C:/xampp/htdocs/', '', $path_full_dom);		
				$domisili_perusahaan = $str_replace_dom;				
			}

			$npwp_perusahaan = '';
			if ( !$this->upload->do_upload('npwp_seller')){
			echo 'File yang anda Upload berkas NPWP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_npwp = array('upload_data' => $this->upload->data());
				$upload_data_npwp = $this->upload->data();
				$path_full_npwp = $upload_data_npwp['full_path'];	
				$str_replace_npwp = str_replace('C:/xampp/htdocs/', '', $path_full_npwp);		
				$npwp_perusahaan = $str_replace_npwp;				
			}


			$id_kep_seller = '';
			if ( !$this->upload->do_upload('id_kep_seller')){
			echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_id_seller = array('upload_data' => $this->upload->data());
				$upload_data_id_seller = $this->upload->data();
				$path_full_id_seller = $upload_data_id_seller['full_path'];	
				$str_replace_id_seller = str_replace('C:/xampp/htdocs/', '', $path_full_id_seller);		
				$id_kep_seller = $str_replace_id_seller;				
			}

			$doc_ekspor_timah = '';
			if ( !$this->upload->do_upload('ekspor_timah')){
			echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_doc_ekspor_timah = array('upload_data' => $this->upload->data());
				$upload_data_doc_ekspor_timah = $this->upload->data();
				$path_full_doc_ekspor_timah = $upload_data_doc_ekspor_timah['full_path'];	
				$str_replace_doc_ekspor_timah = str_replace('C:/xampp/htdocs/', '', $path_full_doc_ekspor_timah);		
				$doc_ekspor_timah = $str_replace_doc_ekspor_timah;				
			}

			$perizinan_instansi = '';
			if ( !$this->upload->do_upload('peizinan_seller')){
			echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_izin = array('upload_data' => $this->upload->data());
				$upload_data_izin = $this->upload->data();
				$path_full_izin = $upload_data_izin['full_path'];	
				$str_replace_izin = str_replace('C:/xampp/htdocs/', '', $path_full_izin);		
				$perizinan_instansi = $str_replace_izin;				
			}


	    $this->load->model('m_tpa_01_query_insert_seller');
		$this->m_tpa_01_query_insert_seller->ClearingMemberTable($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$id_kep_seller,$doc_ekspor_timah,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name);

	        redirect(base_url('index.php'),'refresh');
	        // session_destroy();
        exit();
		}
	}
}

/* End of file  .php */
/* Location: ./application/controllers/ .php */