<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tpa_01_encrypt extends CI_Model {

	public function get_data($a){
		$get_api = file_get_contents('http://10.15.10.21/DTIAPI/api/dti/encrypt?plain='.$a);
        $replace_str = str_replace('"', '', $get_api);
        // $data['encrypt'] = $replace_str;

        return $replace_str;
	}

}

/* End of file m_tpa_01_encrypt.php */
/* Location: ./application/models/m_tpa_01_encrypt.php */