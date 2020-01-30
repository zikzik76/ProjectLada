<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_cek_send_email_activation extends CI_Model {

	public function send_data($s,$email,$user,$password){
        $value['val'] = $s;
        $value['user'] = $user;
        $value['password'] = $password;
		$this->email->initialize(array(
   		'protocol' => 'smtp',
        'smtp_host' => '10.10.10.2',
        'smtp_port' => 25,
        'crlf' => '\r\n',
        'newline' => '\r\n',
        'mailtype' => 'html',
        'wordwrap' => TRUE
         ));

        $data=array();
        $mesg = $this->load->view('pages/v_tpa_01_notif_verification',$value, TRUE);
        $this->email->from('Info@PTKBI.com', 'Info Aktifasi Account TIMAH ');
        $this->email->to($email);
        $this->email->subject('Verification Email Registration TIMAH PTKBI');
        $this->email->message($mesg);
        $this->email->send();

        return true;
	}
	

}

/* End of file m_tpa_01_cek_send_email_activation.php */
/* Location: ./application/models/m_tpa_01_cek_send_email_activation.php */