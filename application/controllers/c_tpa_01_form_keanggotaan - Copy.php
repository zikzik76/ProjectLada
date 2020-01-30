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
        $appstat = $this->m_tpa_01_query_appstat->approval_status($_SESSION['val']['username']);

        if($appstat === NULL OR $appstat === '') 
        {

        	echo 'Error 401 - CT120';
        } else {
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
			$this->load->view('pages/v_tpa_01_form_keanggotaan');	
			$this->load->view('templates/footer');	
        }
	}

	public function regist_anggota_profile(){
		// print_r('masuk sini');
		// exit();
		session_start();
		$anggota = $this->input->post('optradio_anggota');
		if($anggota === 'Buyer')
		{
			//Get Inputan pada Form
			$domisili = $this->input->post('negara_asal');
			$status_usaha = $this->input->post('optradio_status_usaha');
			$jenis_anggota = $this->input->post('optradio_jenis');
	        $n_calon = strtoupper($this->input->post('n_calon'));
	        $s_calon = $this->input->post('st_calon');
	        $no_acc = $this->input->post('no_account_bank');
	        $acc_name = $this->input->post('account_name');
	        $bank_name = $this->input->post('bank_name');
	        $address = $this->input->post('address');
	        $replace_white = str_replace(array('tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')','PT','PT,','PT.','pt','Tbk'), '', $n_calon);
	        $explode_calon = explode(' ', $replace_white);
			$count_array = count($explode_calon);
			$count_array_e ;

			if ($count_array > 3 ){
				$count_array_e = $count_array - ($count_array - 4);
			} else {
				$count_array_e = $count_array;
			}
			

			$email = $_SESSION['val']['email'];
			$notlp = $_SESSION['val']['notlp'];
			$username = $_SESSION['val']['username'];
	        
	       	
	        $concat = array();
	        $substr = '';

	        for ($i=0; $i <= $count_array_e - 1; $i++) { 
	        	$str_len_ = strlen($explode_calon[$i]);
	        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	        	$concat['val'] = $substr;
	        }

	        $concat_substr = $concat['val'];
	        $lenght_concat_substr = strlen($concat_substr);
	        
	        if($lenght_concat_substr > 3){
	        	$concat_substr_ = substr($concat['val'], 0,3);
	        } else {
	        	$concat_substr_ =  $concat_substr;
	        }

	        $len_cm = strlen($anggota);
	        $member_initial = substr($anggota, 0,($len_cm - 1)*-1) ;
	        $current_month = date('m');
	        $current_year = date('y');


	        $count_length_str2nd = strlen($concat_substr_);
	        if ($count_array_e === 3 AND $count_length_str2nd === 2){
	        	$str_len_2nd = strlen($explode_calon[2]);
	        	$sub_str_2nd = substr($explode_calon[2], 1,1);
	        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$sub_str_2nd.''.$current_month.''.$current_year;
	        	// print_r($concat_code_cm);
	        	// echo '<br>';
	        } else if($count_array_e === 2 AND $count_length_str2nd === 1){
	        	$str_len_2nd = strlen($explode_calon[1]);
	        	$sub_str_2nd = substr($explode_calon[1], 1,2);
	        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$sub_str_2nd.''.$current_month.''.$current_year;

	        } else if($count_array_e <= 2 ){
	        		$str_len_2nd = strlen($explode_calon[0]);
		        	$sub_str_2nd = substr($explode_calon[0], 1,2);
		        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$sub_str_2nd.''.$current_month.''.$current_year;
	        	
	        } else {
	        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$current_month.''.$current_year;
	        }

	        $this->load->model('m_tpa_01_cek_code');
	        $search_code = substr($concat_code_cm, 0,4);
	        $result_code = $this->m_tpa_01_cek_code->cek_code($search_code);
	        $str_len_code = strlen($search_code);


	        if($result_code === NULL){
	        	$concat_code_cm_1 = $concat_code_cm; 
	        } else {

	        	$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	        	$this->load->model('m_tpa_01_random_generate');

	        	$char = $this->m_tpa_01_random_generate->generate_string($permitted_chars ,1);

	        	if ($str_len_code < 3 ){
	        		$concat_code_cm_1 = $search_code.''.$char.''.$current_month.''.$current_year;
	        	} else {
	        		$concat_code_cm_1 = substr($search_code, 0,3).''.$char.''.$current_month.''.$current_year;
	        	}

	        } 

			if(!file_exists(APPPATH.'files/'.$concat_code_cm_1)){
				mkdir(APPPATH.'files/'.$concat_code_cm_1, 0777, true);
			} else {
				// folder dengan inisial tersebut sudah ada di dalam sistem
				// echo "<script>alert('the initial is used , error-R01 ')</script>";
				// exit(); 
				// redirect(base_url('index.php/c_tpa_01_form_keanggotaan'),'refresh');
			}

	        $config['upload_path'] = APPPATH.'files/'.$concat_code_cm_1;
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

			// $siup = '';			
			$nib = '';
			$idp = '';
			$lk = '';
			$rfbn = '';
			$compro = '';
			$lk ='';

			if($status_usaha === 'luar'){
				if ( !$this->upload->do_upload('lk')){
				echo 'File yang anda Upload berkas Laporan Keuangan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
				}else{
					$data_lk = array('upload_data' => $this->upload->data());
					$upload_data_lk = $this->upload->data();
					$path_full_lk = $upload_data_lk['full_path'];	
					$str_replace_lk = str_replace('C:/xampp/htdocs/', '', $path_full_lk);		
					$lk = $str_replace_lk;				
				}

				if ( !$this->upload->do_upload('rfbn')){
				echo 'File yang anda Upload berkas Referensi Bank Negeri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
				}else{
					$data_rfbn = array('upload_data' => $this->upload->data());
					$upload_data_rfbn = $this->upload->data();
					$path_full_rfbn = $upload_data_rfbn['full_path'];	
					$str_replace_rfbn = str_replace('C:/xampp/htdocs/', '', $path_full_rfbn);		
					$rfbn = $str_replace_rfbn;				
				}

				if ( !$this->upload->do_upload('compro')){
				echo 'File yang anda Upload berkas Company Profile tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
				}else{
					$data_compro = array('upload_data' => $this->upload->data());
					$upload_data_compro = $this->upload->data();
					$path_full_compro = $upload_data_compro['full_path'];	
					$str_replace_compro = str_replace('C:/xampp/htdocs/', '', $path_full_compro);		
					$compro = $str_replace_compro;				
				}


				// $siup = '';
				$nib = '';
				$idp = '';
			} else {

				if ( !$this->upload->do_upload('lk')){
				echo 'File yang anda Upload berkas Laporan Keuangan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
				}else{
					$data_lk = array('upload_data' => $this->upload->data());
					$upload_data_lk = $this->upload->data();
					$path_full_lk = $upload_data_lk['full_path'];	
					$str_replace_lk = str_replace('C:/xampp/htdocs/', '', $path_full_lk);		
					$lk = $str_replace_lk;				
				}

				if ( !$this->upload->do_upload('nib')){
				echo 'File yang anda Upload berkas NIB tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
				}else{
					$data_nib = array('upload_data' => $this->upload->data());
					$upload_data_nib = $this->upload->data();
					$path_full_nib = $upload_data_nib['full_path'];	
					$str_replace_nib = str_replace('C:/xampp/htdocs/', '', $path_full_nib);		
					$nib = $str_replace_nib;				
				}

				if ( !$this->upload->do_upload('idp')){
				echo 'File yang anda Upload berkas IDP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
				}else{
					$data_idp = array('upload_data' => $this->upload->data());
					$upload_data_idp = $this->upload->data();
					$path_full_idp = $upload_data_idp['full_path'];	
					$str_replace_idp = str_replace('C:/xampp/htdocs/', '', $path_full_idp);		
					$idp = $str_replace_idp;				
				}

				$rfbn = '';
				$compro = '';
			}


			$this->load->model('m_tpa_01_query_insert_buyer');
			$result = $this->m_tpa_01_query_insert_buyer->ClearingMemberTable($concat_code_cm_1,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name,$nib,$idp,$lk,$rfbn,$compro,$domisili,$status_usaha,$address);


			echo "<script>alert('Upload Data Success,Please Wait for Approval')</script>";
	        redirect(base_url('index.php'),'refresh');
		} else {

			$domisili = '';
			// $status_usaha = $this->input->post('optradio_status_usaha');
			$status_usaha = 'dalam';
			$jenis_anggota = $this->input->post('optradio_jenis');
	        $n_calon = strtoupper($this->input->post('n_calon_seller'));
	        $s_calon = $this->input->post('st_calon_seller');
	        $no_acc = $this->input->post('no_account_bank_seller');
	        $acc_name = $this->input->post('account_name_seller');
	        $address = $this->input->post('address_Seller');
	        $bank_name = $this->input->post('bank_name_seller');
	        $replace_white = str_replace(array('TBK','Tbk','TBk','TbK','tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')','PT','PT,','PT.','pt','pT'), '', $n_calon);
	        $explode_calon = explode(' ', $replace_white);
			$count_array = count($explode_calon);
			$count_array_e ;
			if ($count_array > 3 ){
				$count_array_e = $count_array - ($count_array - 4) ;
			} else {
				$count_array_e = $count_array;
			}
			


			$email = $_SESSION['val']['email'];
			$notlp = $_SESSION['val']['notlp'];
			$username = $_SESSION['val']['username'];
	        
	       	
	        $concat = array();
	        $substr = '';

	        for ($i=0; $i <= $count_array_e - 1 ; $i++) { 
	        	$str_len_ = strlen($explode_calon[$i]);
	        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	        	$concat['val'] = $substr;

	        }

	        $concat_substr = $concat['val'];
	        $lenght_concat_substr = strlen($concat_substr);
	        
	        if($lenght_concat_substr > 3){
	        	$concat_substr_ = substr($concat['val'], 0,3);
	        } else {
	        	$concat_substr_ =  $concat_substr;
	        }

	        $this->load->model('m_tpa_01_cek_code');
	        $result_code = $this->m_tpa_01_cek_code->cek_code($concat_substr_);

	        $len_cm = strlen($anggota);
	        $member_initial = substr($anggota, 0,($len_cm - 1)*-1) ;
	        $current_month = date('m');
	        $current_year = date('y');



	        $count_length_str2nd = strlen($concat_substr_);
	        if ($count_array_e === 3 AND $count_length_str2nd === 2){
	        	$str_len_2nd = strlen($explode_calon[2]);
	        	$sub_str_2nd = substr($explode_calon[2], 1,1);
	        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$sub_str_2nd.''.$current_month.''.$current_year;

	        } else if($count_array_e === 2 AND $count_length_str2nd === 1){
	        	$str_len_2nd = strlen($explode_calon[1]);
	        	$sub_str_2nd = substr($explode_calon[1], 1,2);
	        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$sub_str_2nd.''.$current_month.''.$current_year;

	        } else if($count_array_e <= 2 ){
	        		$str_len_2nd = strlen($explode_calon[0]);
		        	$sub_str_2nd = substr($explode_calon[0], 1,2);
		        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$sub_str_2nd.''.$current_month.''.$current_year;
	        	
	        } else {
	        	$concat_code_cm = $member_initial.''.$concat_substr_.''.$current_month.''.$current_year;
	        }

	         $this->load->model('m_tpa_01_cek_code');
	        $search_code = substr($concat_code_cm, 0,4);
	        $result_code = $this->m_tpa_01_cek_code->cek_code($search_code);
	        $str_len_code = strlen($search_code);

	        if($result_code === NULL){
	        	$concat_code_cm_2 = $concat_code_cm; 
	        } else {
	        	$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	        	$this->load->model('m_tpa_01_random_generate');

	        	$char = $this->m_tpa_01_random_generate->generate_string($permitted_chars ,1);

	        	if ($str_len_code < 3 ){
	        		$concat_code_cm_2 = $search_code.''.$char.''.$current_month.''.$current_year;
	        	} else {
	        		$concat_code_cm_2 = substr($search_code, 0,3).''.$char.''.$current_month.''.$current_year;
	        	}
	        } 

			if(!file_exists(APPPATH.'files/'.$concat_code_cm_2)){
				mkdir(APPPATH.'files/'.$concat_code_cm_2, 0777, true);
			} else {
				redirect(base_url('index.php/c_tpa_01_form_keanggotaan'),'refresh');
			}

	        $config['upload_path'] = APPPATH.'files/'.$concat_code_cm_2;
			$config['allowed_types'] = 'PDF|pdf';
			$config['encrypt_name'] = TRUE;
			// $config['max_size'] = '15';
			$config['raw_name'] = 'file_anggota';
			$config['file_name'] = $n_calon;

			$this->load->library('form_validation');
			$this->load->library('upload', $config);

			$akte_pendiri = ''; //akte pendirian perusahaan
			if ( !$this->upload->do_upload('ak_pen_seller')){
			echo 'File yang anda Upload Akte Pendiri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
	
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data();
				$path_full = $upload_data['full_path'];	
				$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
				$akte_pendiri = $str_replace;				
			}
			// exit();

			$akte_perubahan = ''; //akte perubahan
			if ( !$this->upload->do_upload('ak_per_seller')){
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

			$doc_ekspor_timah = '';
			if ( !$this->upload->do_upload('ekspor_timah')){
			echo 'File yang anda Upload berkas Perizinan Ekspor Timah tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_doc_ekspor_timah = array('upload_data' => $this->upload->data());
				$upload_data_doc_ekspor_timah = $this->upload->data();
				$path_full_doc_ekspor_timah = $upload_data_doc_ekspor_timah['full_path'];	
				$str_replace_doc_ekspor_timah = str_replace('C:/xampp/htdocs/', '', $path_full_doc_ekspor_timah);		
				$doc_ekspor_timah = $str_replace_doc_ekspor_timah;				
			}

			$id_kep_seller = '';
			if ( !$this->upload->do_upload('id_kep_seller')){
			echo 'File yang anda Upload  tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_id_seller = array('upload_data' => $this->upload->data());
				$upload_data_id_seller = $this->upload->data();
				$path_full_id_seller = $upload_data_id_seller['full_path'];	
				$str_replace_id_seller = str_replace('C:/xampp/htdocs/', '', $path_full_id_seller);		
				$id_kep_seller = $str_replace_id_seller;				
			}

			$doc_ekspor_timah = '';
			if ( !$this->upload->do_upload('ekspor_timah')){
			echo 'File yang anda Upload berkas Identitas Kepabean tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_doc_ekspor_timah = array('upload_data' => $this->upload->data());
				$upload_data_doc_ekspor_timah = $this->upload->data();
				$path_full_doc_ekspor_timah = $upload_data_doc_ekspor_timah['full_path'];	
				$str_replace_doc_ekspor_timah = str_replace('C:/xampp/htdocs/', '', $path_full_doc_ekspor_timah);		
				$doc_ekspor_timah = $str_replace_doc_ekspor_timah;				
			}

			$perizinan_instansi = '';
			if ( !$this->upload->do_upload('peizinan_seller')){
			echo 'File yang anda Upload berkas Perizinan Instansi tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_izin = array('upload_data' => $this->upload->data());
				$upload_data_izin = $this->upload->data();
				$path_full_izin = $upload_data_izin['full_path'];	
				$str_replace_izin = str_replace('C:/xampp/htdocs/', '', $path_full_izin);		
				$perizinan_instansi = $str_replace_izin;				
			}

			// $siup = '';
			// if ( !$this->upload->do_upload('siup_seller')){
			// echo 'File yang anda Upload berkas SIUP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			// }else{
			// 	$data_siup = array('upload_data' => $this->upload->data());
			// 	$upload_data_siup = $this->upload->data();
			// 	$path_full_siup = $upload_data_siup['full_path'];	
			// 	$str_replace_siup = str_replace('C:/xampp/htdocs/', '', $path_full_siup);		
			// 	$siup = $str_replace_siup;				
			// }

			$nib = '';
			if ( !$this->upload->do_upload('nib_seller')){
			echo 'File yang anda Upload berkas Nomor Induk Berusaha tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_nib = array('upload_data' => $this->upload->data());
				$upload_data_nib = $this->upload->data();
				$path_full_nib = $upload_data_nib['full_path'];	
				$str_replace_nib = str_replace('C:/xampp/htdocs/', '', $path_full_nib);		
				$nib = $str_replace_nib;				
			}

			$idp = '';
			if ( !$this->upload->do_upload('idp_seller')){
			echo 'File yang anda Upload berkas Identitas Diri Pengurus tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_idp = array('upload_data' => $this->upload->data());
				$upload_data_idp = $this->upload->data();
				$path_full_idp = $upload_data_idp['full_path'];	
				$str_replace_idp = str_replace('C:/xampp/htdocs/', '', $path_full_idp);		
				$idp = $str_replace_idp;				
			}

			$lk = '';
			if ( !$this->upload->do_upload('lk_seller')){
			echo 'File yang anda Upload berkas Laporan Keuangan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_lk = array('upload_data' => $this->upload->data());
				$upload_data_lk = $this->upload->data();
				$path_full_lk = $upload_data_lk['full_path'];	
				$str_replace_lk = str_replace('C:/xampp/htdocs/', '', $path_full_lk);		
				$lk = $str_replace_lk;				
			}

			$rfbn_seller = '';
			$compro_seller = '';

		    $this->load->model('m_tpa_01_query_insert_seller');
			$this->m_tpa_01_query_insert_seller->ClearingMemberTable($concat_code_cm_2,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$id_kep_seller,$doc_ekspor_timah,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name,$nib,$idp,$lk,$rfbn_seller,$compro_seller,$domisili,$status_usaha,$address);


			// redirect(base_url('index.php'),'refresh');
			echo "<script>alert('Upload Data Success,Please Wait for Approval')</script>";
	       redirect(base_url('index.php'),'refresh');
			  // redirect(base_url('index.php/c_tpa_01_form_keanggotaan'),'refresh');
			  exit();
		}
	}
}

/* End of file  .php */
/* Location: ./application/controllers/ .php */