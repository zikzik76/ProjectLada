<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_session extends CI_Model {
	public function get_session($array){
		// session_start();
		// print_r($_SESSION['val']);
		// print_r($array);
		$array['val'] = $array;

		return $array;
	}
}

/* End of file m_tpa_01_session.php */
/* Location: ./application/models/m_tpa_01_session.php */