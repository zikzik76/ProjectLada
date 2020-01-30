<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Registration Of member And Activation Member
    Version             : 1.0 Production
=================================================================== 
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_register_form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper(array('form', 'url','captcha'));

        // $this->session->userdata('item');
    }

    public function index(){

        $config = array(
            'img_path'      => 'application/asset/captcha_images/',
            'img_url'       => base_url().'application/asset/captcha_images/',
            'font_path'     => base_url().'system/fonts/texb.ttf',
            'img_width'     => '200',
            'img_height'    => 100,
            'word_length'   => 10,
            'font_size'     => 36
        );
        $captcha = create_captcha($config);
        $captcha_result = $captcha['word'];
        $this->session->unset_userdata('captchaCode');
        $data['val'] = $this->session->set_userdata(array('captchaCode' => $captcha['word']));
        $data['captchaImg'] = $captcha['image'];
        $this->load->view('pages/v_tpa_01_register_form',$data);
        $this->load->view('templates/footer');
    }

    public function account_created(){
        // $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('email');
        $inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->input->post('capt');

        if($inputCaptcha === $sessCaptcha){
            $user = $this->input->post('usr_cm');
            $password = $this->input->post('pwd_cm');
            $encrypt_pass = $this->encrypt->encode($password);
            $c_password = $this->input->post('cpwd_cm');
            $encrypt_cpass = $this->encrypt->encode($c_password);
            $email = $this->input->post('email_cm');
            $tlp = $this->input->post('tlp_cm');
            $session_code = $this->input->post('capt');
            $captcha = $this->input->post('captcha');

            $this->load->model('m_tpa_01_usename_check');
            $result = $this->m_tpa_01_usename_check->get_data($user);

            if($result->rowCount() === 0){
                $this->load->model('m_tpa_01_insert_query');
                $result_insert = $this->m_tpa_01_insert_query->insert_data($user,$encrypt_pass,$encrypt_cpass,$email,$tlp,$session_code,$captcha);
                $this->load->model('m_tpa_01_cek_user_pass');
                $result_checking = $this->m_tpa_01_cek_user_pass->get_checkin($user,$encrypt_pass);
                $data = '';
                foreach ($result_checking as $value) {
                  $this->load->model('m_tpa_01_encrypt');
                  $result_encrypt = $this->m_tpa_01_encrypt->get_data($value['id']);
                }
                $value_encrypt = $result_encrypt;
                $this->load->model('m_tpa_01_cek_send_email_activation');
                $send_email = $this->m_tpa_01_cek_send_email_activation->send_data($value_encrypt,$email,$user,$password);
                // echo '<script>alert("TIS account Success created, check Your email continuesly")</script>';
               // echo json_encode(array("message" => $this->error = $this->l('Your accoust was registered. Thank You!'),"code" => 1));
                // $json['redirect'] = 'https://'.$_SERVER['HTTP_HOST'];
                      // redirect('https://'.$_SERVER['HTTP_HOST'],'refresh');
                $text = 'Success';
                json_encode($text);
                die();
                // die(json_encode($str));
            } 
            $str = 'username dan password anda sudah terdaftar';
            die(json_encode($str));
        }
        
        $str = 'Captcha code does not match, please try again.';
        die(json_encode($str));
    }


     public function refresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'application/asset/captcha_images/',
            'img_url'       => base_url().'application/asset/captcha_images/',
            'font_path'     => base_url().'system/fonts/texb.ttf',
            'img_width'     => '200',
            'img_height'    => 100,
            'word_length'   => 10,
            'font_size'     => 36
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }

    public function send_registrasion(){

        $user = $this->input->post('n_username');
        $password = $this->input->post('pwd_cm');
        $c_password = $this->input->post('cpwd_cm');
        $email = $this->input->post('email_cm');
        $tlp = $this->input->post('tlp_cm');
        $session_code = $this->input->post('capt');
        $captcha = $this->input->post('captcha');

        $this->load->library('form_validation');
        $this->load->library('upload', $config);
        
        include (APPPATH.'libraries/adodb/adodb-exceptions.inc.php');
        include (APPPATH.'libraries/adodb/adodb.inc.php');

        $db_host = 'KBIDEV-TIMAH-DBMS';
        $db_user = 'sadev_lada';
        $db_pass = 'Kbi@Kbi2021';
        $db_data = 'SKD';

        $db = NewADOConnection('odbc_mssql');
        $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
        $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
        $db->SetFetchMode(ADODB_FETCH_ASSOC);

        $query = 'SELECT * FROM RegistrationLoginMember where username = "'.$user.'" AND password = "'.$password.'"';

        $rcd = $db->Execute($query);

        // echo '<pre>';
        // print_r($rcd);
        // echo '</pre>';

    }

    public function aktifasi_account(){
        // $id = $foo;
        $this->load->helper('url');
        $uri = $_SERVER['REQUEST_URI'];
        $this->load->library('session');
        $this->load->library('encrypt');
        // $config['enable_query_strings'] = FALSE;
        // print_r($uri);
        $str_len = strlen($uri);
        $str_find = substr($uri, strpos($uri,'?',0), $str_len);
        $str_replace = str_replace('?foo=','', $str_find);

        // echo "<pre>";
        // print_r($str_replace);
        // echo "</pre>";
        // echo "<br>";
        // $decrypt_url = $this->encrypt->decode($str_replace);
         $ipaddress = '10.15.10.21';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

         $get_api = file_get_contents('http://10.15.10.21/DTIAPI/api/dti/decrypt?seed='.$str_replace);
         // print_r($get_api); exit();
        $decrypt_url = str_replace('"', '', $get_api);

        include (APPPATH.'libraries/adodb/adodb.inc.php');

        $db_host = 'KBIDEV-TIMAH-DBMS';
        $db_user = 'sadev_lada';
        $db_pass = 'Kbi@Kbi2021';
        $db_data = 'TIN_KBI';

        $db = NewADOConnection('odbc_mssql');
        $dsn = "Driver={SQL Server};Server={" . $db_host . "};Database={" . $db_data . "};";
        $db->Connect($dsn, $db_user, $db_pass) or die($db->ErrorMsg());
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $query = "update SKD.RegistrationLoginMember SET verification_flag = 'AKTIF' WHERE id = ".$decrypt_url;
  
            
        $rcd = $db->Execute($query);


      redirect('https://'.$_SERVER['HTTP_HOST'],'refresh');
    }


}

/* End of file c_tpa_01_register_form.php */
/* Location: ./application/controllers/c_tpa_01_register_form.php */