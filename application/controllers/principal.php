<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
	public function index(){
		$this->load->view('Principal/index');
	}

	public function logearse(){
		$data=$this->db->query("select *from tipo_personal")->result();
		print_r($data);
	}
}
