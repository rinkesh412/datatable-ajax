<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()
	{
		$this->load->view('report');
	}
	public function getRecords(){
		$this->load->model('M_Report');
		$data = $this->M_Report->load_data($_POST);
		$json_data = array(
                "draw"            => intval( $data['draw'] ),
                "recordsTotal"    => intval( $data['recordsTotal'] ),
                "recordsFiltered" => intval( $data['recordsFiltered'] ),
                "data"            => $data['data'],
                "totalDuration"   => $data['totalDuration'],
                "percall"         => $data['percall']   
            );
		echo json_encode($json_data); 
		exit;
	}
}
