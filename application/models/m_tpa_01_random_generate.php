<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : A Random For a string on Code of member	
    Version             : 1.0 Production
=================================================================== 
-->

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_tpa_01_random_generate extends CI_Model {

	public function generate_string($input, $strength = 16) {

	    $input_length = strlen($input);
	    $random_string = '';
	    for($i = 0; $i < $strength; $i++) {
	        $random_character = $input[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
    	}
 
    return $random_string;
	}
}

/* End of file  */
/* Location: ./application/models/ */