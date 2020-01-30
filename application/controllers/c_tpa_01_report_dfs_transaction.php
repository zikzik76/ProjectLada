<!-- 
===================================================================
    Author              : Reza Fachrizal Adnan
    Company             : PT Kliring Berjangka Indonesia (Persero)
    Created date        : 22 April 2019
    Last Update date    : 04 Juli 2019
    Description         : Example Of Reporting
    Version             : 1.0 Production
=================================================================== 
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_tpa_01_report_dfs_transaction extends CI_Controller {

	public function index()
	{
		$data = [];
		//load the view and saved it into $html variable
		$html=$this->load->view('welcome_message', $data, true);

        //this the the PDF filename that user will get to download
		$pdfFilePath = "test_pdf.pdf";

        //load mPDF library
		$this->load->library('m_pdf');

       //generate the PDF from the given html
		$this->m_pdf->pdf->WriteHTML($html);

        //download it.
		$this->m_pdf->pdf->Output($pdfFilePath, "D");	
		echo "<script>success generate PDF</script>";	
	}

}

/* End of file c_tpa_01_t.php */
/* Location: ./application/controllers/c_tpa_01_t.php */