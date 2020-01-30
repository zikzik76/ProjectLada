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
			$domisili = $this->input->post('negara_asal');
			$status_usaha = $this->input->post('optradio_status_usaha');
			$jenis_anggota = $this->input->post('optradio_jenis');
	        $n_calon = strtoupper($this->input->post('n_calon'));
	        $s_calon = $this->input->post('st_calon');
	        $no_acc = $this->input->post('no_account_bank');
	        $acc_name = $this->input->post('account_name');
	        $bank_name = $this->input->post('bank_name');
	        $replace_white = str_replace(array('tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')','PT','PT,','PT.','pt'), '', $n_calon);
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
			$username = $_SESSION['val']['notlp'];
	        
	        // $str_len_1 = strlen($explode_calon[0]);
	        // $str_len = strlen($explode_calon[1]);
	        
	        // if ($str_len_1 === 0){

	        // }
	        // print_r(;

	       	
	        $concat = array();
	        $substr = '';

	        for ($i=0; $i <= $count_array_e - 1 ; $i++) { 
	        	$str_len_ = strlen($explode_calon[$i]);
	        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	        	$concat['val'] = $substr;
	        	print_r($substr);
	        	echo '<br>';

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

	        // if($result_code !=== ''){
	        // 	$concat_substr_ = substr($concat['val'], 0,2);
	        // 	$concat_substr_1 = $concat_substr_.''.
	        // } else {

	        // }
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
	        print_r($anggota);
	        echo "<br>";
	        print_r('count arrray n = '.$count_array_e);
	        echo '<br>';
	        print_r($explode_calon);
	        echo '<br>';
	        print_r('Number Of array = '.$count_array);
	        echo '<br>';
	        print_r( $lenght_concat_substr);
	        echo "<br>";
	        print_r('sub str line 65 = '.$concat_substr);
	        echo "<br>";
	        echo '<br>';
	        print_r('count array = '.$count_length_str2nd);
	        echo '<br>';
	        print_r($count_length_str2nd);
	        echo '<br>';
	        print_r($concat_code_cm);
	        echo '<br>';

	  //       if(!file_exists(APPPATH.'files/'.$concat_code_cm)){
			// 	echo 'FILE DIBIKININ';
			// } else {
			// 	// folder dengan inisial tersebut sudah ada di dalam sistem
			// 	echo "FILE UDAH ADA ".$concat_code_cm;
			// 	// exit();
			// }
	        // exit();

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
			$config['max_size'] = '15';
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

			$siup = '';
			if ( !$this->upload->do_upload('siup')){
			echo 'File yang anda Upload berkas SIUP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_siup = array('upload_data' => $this->upload->data());
				$upload_data_siup = $this->upload->data();
				$path_full_siup = $upload_data_siup['full_path'];	
				$str_replace_siup = str_replace('C:/xampp/htdocs/', '', $path_full_siup);		
				$siup = $str_replace_siup;				
			}

			$nib = '';
			if ( !$this->upload->do_upload('nib')){
			echo 'File yang anda Upload berkas NIB tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_nib = array('upload_data' => $this->upload->data());
				$upload_data_nib = $this->upload->data();
				$path_full_nib = $upload_data_nib['full_path'];	
				$str_replace_nib = str_replace('C:/xampp/htdocs/', '', $path_full_nib);		
				$nib = $str_replace_nib;				
			}

			$idp = '';
			if ( !$this->upload->do_upload('idp')){
			echo 'File yang anda Upload berkas IDP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_idp = array('upload_data' => $this->upload->data());
				$upload_data_idp = $this->upload->data();
				$path_full_idp = $upload_data_idp['full_path'];	
				$str_replace_idp = str_replace('C:/xampp/htdocs/', '', $path_full_idp);		
				$idp = $str_replace_idp;				
			}

			$lk = '';
			if ( !$this->upload->do_upload('lk')){
			echo 'File yang anda Upload berkas Laporan Keuangan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_lk = array('upload_data' => $this->upload->data());
				$upload_data_lk = $this->upload->data();
				$path_full_lk = $upload_data_lk['full_path'];	
				$str_replace_lk = str_replace('C:/xampp/htdocs/', '', $path_full_lk);		
				$lk = $str_replace_lk;				
			}

			$rfbn = '';
			if ( !$this->upload->do_upload('rfbn')){
			echo 'File yang anda Upload berkas Referensi Bank Negeri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_rfbn = array('upload_data' => $this->upload->data());
				$upload_data_rfbn = $this->upload->data();
				$path_full_rfbn = $upload_data_rfbn['full_path'];	
				$str_replace_rfbn = str_replace('C:/xampp/htdocs/', '', $path_full_rfbn);		
				$rfbn = '';				
			}

			$compro = '';
			if ( !$this->upload->do_upload('compro')){
			echo 'File yang anda Upload berkas Company Profile tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_compro = array('upload_data' => $this->upload->data());
				$upload_data_compro = $this->upload->data();
				$path_full_compro = $upload_data_compro['full_path'];	
				$str_replace_compro = str_replace('C:/xampp/htdocs/', '', $path_full_compro);		
				$compro = '';				
			}
			
			echo "<br>";
			print_r($rfbn);
			echo "<br>";
			print_r($compro);

			// exit();

			$this->load->model('m_tpa_01_query_insert_buyer');
			$this->m_tpa_01_query_insert_buyer->ClearingMemberTable($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name,$nib,$idp,$lk,$rfbn,$compro,$domisili,$status_usaha,$siup);
	        redirect(base_url('index.php'),'refresh');
	        exit();

		} else {
			//print_r('PENJUAL');
		// 	$jenis_anggota = $this->input->post('optradio_jenis');
	 //        $n_calon = $this->input->post('n_calon_seller');
	 //        $s_calon = $this->input->post('st_calon_seller');
	 //        $no_acc = $this->input->post('no_account_bank_seller');
	 //        $acc_name = $this->input->post('account_name_seller');
	 //        $bank_name = $this->input->post('bank_name_seller');
	 //        $replace_white = str_replace(array('tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')'), '', $n_calon);
	 //        $explode_calon = explode(' ', $replace_white);
		// 	$count_array = count($explode_calon);
		// 	$email = $_SESSION['val']['email'];
		// 	$notlp = $_SESSION['val']['notlp'];

	 //        $str_len = strlen($explode_calon[1]);
	 //        substr($explode_calon[1], 0,($str_len - 1)*-1);
	 //        $concat = array();
	 //        $substr = '';
	 //        for ($i=1; $i < $count_array ; $i++) { 
	 //        	$str_len_ = strlen($explode_calon[$i]);
	 //        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	 //        	$concat['val'] = $substr;
	 //        }


	 //        $concat_substr = $concat['val'];
	 //        // print_r($a);
	 //        $len_cm = strlen($anggota);
	 //        $member_initial = substr($anggota, 0,($len_cm - 1)*-1);
	 //        $current_month = date('m');
	 //        $current_year = date('y');

	 //        $count_length_str2nd_sell = strlen($concat_substr);
	 //        if ($count_length_str2nd_sell === 2){
	 //        	$str_len_2nd_sell = strlen($explode_calon[2]);
	 //        	$sub_str_2nd_sell = substr($explode_calon[2], 1,1);
	 //        	$concat_code_cm = $member_initial.''.$concat_substr.''.$sub_str_2nd_sell.''.$current_month.''.$current_year;
	 //        	// print_r($concat_code_cm);
	 //        	// echo '<br>';
	 //        } else {
	 //        	$concat_code_cm = $member_initial.''.$concat_substr.''.$current_month.''.$current_year;
	 //        }

	 //         print_r($anggota);
	 //        echo "<br>";
	 //        print_r('count arrray n = '.$count_array_e);
	 //        echo '<br>';
	 //        print_r($explode_calon);
	 //        echo '<br>';
	 //        print_r('Number Of array = '.$count_array);
	 //        echo '<br>';
	 //        print_r( $lenght_concat_substr);
	 //        echo "<br>";
	 //        print_r('sub str line 65 = '.$concat_substr);
	 //        echo "<br>";
	 //        echo '<br>';
	 //        print_r('count array = '.$count_length_str2nd);
	 //        echo '<br>';
	 //        print_r($count_length_str2nd);
	 //        echo '<br>';
	 //        print_r($concat_code_cm);
	 //        echo '<br>';
	 //         exit();

	 //        // $concat_code_cm = $member_initial.''.$concat_substr.''.$current_month.''.$current_year;
		// 	if(!file_exists(APPPATH.'files/'.$concat_code_cm)){
		// 		mkdir(APPPATH.'files/'.$concat_code_cm, 0777, true);
		// 	} else {
		// 		echo "<script>alert('error- nanti dinamain, pokoknya nama foldernya ada yang sama')</script>";
		// 		exit();
		// 	}

	 //        $config['upload_path'] = APPPATH.'files/'.$concat_code_cm;
		// 	$config['allowed_types'] = 'PDF|pdf';
		// 	$config['encrypt_name'] = TRUE;
		// 	$config['raw_name'] = 'file_anggota';
		// 	$config['file_name'] = $n_calon;
		
		// // 	$this->load->library('form_validation');
		// // 	$this->load->library('upload', $config);

		// 	$akte_pendiri = ''; //akte pendirian perusahaan
		// 	if ( !$this->upload->do_upload('akta_pen_seller')){
		// 	echo 'File yang anda Upload Akte Pendiri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data = array('upload_data' => $this->upload->data());
		// 		$upload_data = $this->upload->data();
		// 		$path_full = $upload_data['full_path'];	
		// 		$str_replace = str_replace('C:/xampp/htdocs/', '', $path_full);		
		// 		$akte_pendiri = $str_replace;				
		// 	}

		// 	$akte_perubahan = ''; //akte perubahan
		// 	if ( !$this->upload->do_upload('akta_per_seller')){
		// 	echo 'File yang anda Upload Akte Perubahan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data_per = array('upload_data' => $this->upload->data());
		// 		$upload_data_per = $this->upload->data();
		// 		$path_full_per = $upload_data_per['full_path'];	
		// 		$str_replace_per = str_replace('C:/xampp/htdocs/', '', $path_full_per);		
		// 		$akte_perubahan = $str_replace_per;				
		// 	}

		// 	$domisili_perusahaan = '';
		// 	if ( !$this->upload->do_upload('dom_seller')){
		// 	echo 'File yang anda Upload berkas domisili tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data_dom = array('upload_data' => $this->upload->data());
		// 		$upload_data_dom = $this->upload->data();
		// 		$path_full_dom = $upload_data_dom['full_path'];	
		// 		$str_replace_dom = str_replace('C:/xampp/htdocs/', '', $path_full_dom);		
		// 		$domisili_perusahaan = $str_replace_dom;				
		// 	}

		// 	$npwp_perusahaan = '';
		// 	if ( !$this->upload->do_upload('npwp_seller')){
		// 	echo 'File yang anda Upload berkas NPWP tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data_npwp = array('upload_data' => $this->upload->data());
		// 		$upload_data_npwp = $this->upload->data();
		// 		$path_full_npwp = $upload_data_npwp['full_path'];	
		// 		$str_replace_npwp = str_replace('C:/xampp/htdocs/', '', $path_full_npwp);		
		// 		$npwp_perusahaan = $str_replace_npwp;				
		// 	}


		// 	$id_kep_seller = '';
		// 	if ( !$this->upload->do_upload('id_kep_seller')){
		// 	echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data_id_seller = array('upload_data' => $this->upload->data());
		// 		$upload_data_id_seller = $this->upload->data();
		// 		$path_full_id_seller = $upload_data_id_seller['full_path'];	
		// 		$str_replace_id_seller = str_replace('C:/xampp/htdocs/', '', $path_full_id_seller);		
		// 		$id_kep_seller = $str_replace_id_seller;				
		// 	}

		// 	$doc_ekspor_timah = '';
		// 	if ( !$this->upload->do_upload('ekspor_timah')){
		// 	echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data_doc_ekspor_timah = array('upload_data' => $this->upload->data());
		// 		$upload_data_doc_ekspor_timah = $this->upload->data();
		// 		$path_full_doc_ekspor_timah = $upload_data_doc_ekspor_timah['full_path'];	
		// 		$str_replace_doc_ekspor_timah = str_replace('C:/xampp/htdocs/', '', $path_full_doc_ekspor_timah);		
		// 		$doc_ekspor_timah = $str_replace_doc_ekspor_timah;				
		// 	}

		// 	$perizinan_instansi = '';
		// 	if ( !$this->upload->do_upload('peizinan_seller')){
		// 	echo 'File yang anda Upload berkas Perizinan tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
		// 	}else{
		// 		$data_izin = array('upload_data' => $this->upload->data());
		// 		$upload_data_izin = $this->upload->data();
		// 		$path_full_izin = $upload_data_izin['full_path'];	
		// 		$str_replace_izin = str_replace('C:/xampp/htdocs/', '', $path_full_izin);		
		// 		$perizinan_instansi = $str_replace_izin;				
		// 	}



	 //    $this->load->model('m_tpa_01_query_insert_seller');
		// $this->m_tpa_01_query_insert_seller->ClearingMemberTable($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$id_kep_seller,$doc_ekspor_timah,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name);
			$domisili = $this->input->post('negara_asal');
			$status_usaha = $this->input->post('optradio_status_usaha');
			$jenis_anggota = $this->input->post('optradio_jenis');
	        $n_calon = strtoupper($this->input->post('n_calon_seller'));
	        $s_calon = $this->input->post('st_calon_seller');
	        $no_acc = $this->input->post('no_account_bank_seller');
	        $acc_name = $this->input->post('account_name_seller');
	        $bank_name = $this->input->post('bank_name_seller');
	        $replace_white = str_replace(array('tbk','.','persero','Persero','.tbk','(Persero)','(PERSERO)','(',')','PT','PT,','PT.','pt'), '', $n_calon);
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
			$username = $_SESSION['val']['notlp'];
	        
	        // $str_len_1 = strlen($explode_calon[0]);
	        // $str_len = strlen($explode_calon[1]);
	        
	        // if ($str_len_1 === 0){

	        // }
	        // print_r(;

	       	
	        $concat = array();
	        $substr = '';

	        for ($i=0; $i <= $count_array_e - 1 ; $i++) { 
	        	$str_len_ = strlen($explode_calon[$i]);
	        	$substr .= substr($explode_calon[$i], 0,($str_len_ - 1)*-1);
	        	$concat['val'] = $substr;
	        	print_r($substr);
	        	echo '<br>';

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

	        // if($result_code !=== ''){
	        // 	$concat_substr_ = substr($concat['val'], 0,2);
	        // 	$concat_substr_1 = $concat_substr_.''.
	        // } else {

	        // }
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
	        print_r($anggota);
	        echo "<br>";
	        print_r('count arrray n = '.$count_array_e);
	        echo '<br>';
	        print_r($explode_calon);
	        echo '<br>';
	        print_r('Number Of array = '.$count_array);
	        echo '<br>';
	        print_r( $lenght_concat_substr);
	        echo "<br>";
	        print_r('sub str line 65 = '.$concat_substr);
	        echo "<br>";
	        echo '<br>';
	        print_r('count array = '.$count_length_str2nd);
	        echo '<br>';
	        print_r($count_length_str2nd);
	        echo '<br>';
	        print_r($concat_code_cm);
	        echo '<br>';

	  //       if(!file_exists(APPPATH.'files/'.$concat_code_cm)){
			// 	echo 'FILE DIBIKININ';
			// } else {
			// 	// folder dengan inisial tersebut sudah ada di dalam sistem
			// 	echo "FILE UDAH ADA ".$concat_code_cm;
			// 	// exit();
			// }

			if(!file_exists(APPPATH.'files/'.$concat_code_cm)){
				mkdir(APPPATH.'files/'.$concat_code_cm, 0777, true);
			} else {
				// folder dengan inisial tersebut sudah ada di dalam sistem
				echo "<script>alert('error-R01 ')</script>";
				exit();
			}
	        // exit();

	         	// $config['upload_path']          = APPPATH.'files/'.$concat_code_cm;
           //      $config['allowed_types']        = 'pdf|PDF';
           //      // $config['max_size']             = 15;
           //      // $config['max_width']            = 1024;
           //      // $config['max_height']           = 768;

           //      $this->load->library('upload', $config);

           //      if ( ! $this->upload->do_upload('ak_pen_seller'))
           //      {
           //              $error = array('error' => $this->upload->display_errors());

           //              // $this->load->view('upload_form', $error);
           //             print_r($error);
           //      }
           //      else
           //      {
           //              $data = array('upload_data' => $this->upload->data());

           //             print_r($data);
           //      }
	        $config['upload_path'] = APPPATH.'files/'.$concat_code_cm;
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
			if ( !$this->upload->do_upload('dom_per_seller')){
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

			$rfbn = '';
			if ( !$this->upload->do_upload('rfbn_seller')){
			echo 'File yang anda Upload berkas Referensi Bank Negeri tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_rfbn = array('upload_data' => $this->upload->data());
				$upload_data_rfbn = $this->upload->data();
				$path_full_rfbn = $upload_data_rfbn['full_path'];	
				$str_replace_rfbn = str_replace('C:/xampp/htdocs/', '', $path_full_rfbn);		
				$rfbn = $str_replace_rfbn;				
			}

			$compro = '';
			if ( !$this->upload->do_upload('compro_seller')){
			echo 'File yang anda Upload berkas Company Profile tidak sesuai dengan fromat atau file anda terlalu besar untuk di upload, mohon cek kembali file upload anda';
			}else{
				$data_compro = array('upload_data' => $this->upload->data());
				$upload_data_compro = $this->upload->data();
				$path_full_compro = $upload_data_compro['full_path'];	
				$str_replace_compro = str_replace('C:/xampp/htdocs/', '', $path_full_compro);		
				$compro = $str_replace_compro;				
			}
			
			// exit();
		    $this->load->model('m_tpa_01_query_insert_seller');
			$this->m_tpa_01_query_insert_seller->ClearingMemberTable($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$id_kep_seller,$doc_ekspor_timah,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name,$nib,$idp,$lk,$rfbn,$compro,$domisili,$status_usaha);

			// $this->load->model('m_tpa_01_query_insert_seller');
			// $this->m_tpa_01_query_insert_buyer->ClearingMemberTable($concat_code_cm,$n_calon,$email,$notlp,$jenis_anggota,$akte_pendiri,$akte_perubahan,$domisili_perusahaan,$npwp_perusahaan,$perizinan_instansi,$s_calon,$no_acc,$acc_name,$bank_name,$nib,$idp,$lk,$rfbn,$compro,$domisili,$status_usaha,$siup);
	        redirect(base_url('index.php'),'refresh');
	        exit();


	       // redirect(base_url('index.php/c_tpa_01_status_clearing_member'),'refresh');
        // exit();
		}
	}
}

/* End of file  .php */
/* Location: ./application/controllers/ .php */