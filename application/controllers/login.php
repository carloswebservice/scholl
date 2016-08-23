<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
		$this->load->view('Login/index');
	}

	public function logearse(){
		$login=$this->db->query("select *from personal where per_usuario='".$_POST["usuario"]."' and per_clave='".$_POST["clave"]."'")->result_array();
		if (count($login)==0) {
			$login=$this->db->query("select *from docente where doc_usuario='".$_POST["usuario"]."' and doc_clave='".$_POST["clave"]."'")->result_array();
			if (count($login)==0) {
				$login=$this->db->query("select *from alumnos where alum_usuario='".$_POST["usuario"]."' and alum_clave='".$_POST["clave"]."'")->result_array();
				if (count($login)==0) {
					header('Location:'.base_url());
				}else{
					$_SESSION["personal"]=$login[0]["alum_nombres"].' '.$login[0]["alum_apellidos"];
					$_SESSION["tipopersonal"]=$login[0]["alum_tipo"];
					$_SESSION["idpersonal"]=$login[0]["alum_id"];
					header('Location:'.base_url().'principal');
				}
			}else{
				$_SESSION["personal"]=$login[0]["doc_nombres"].' '.$login[0]["doc_apellidos"];
				$_SESSION["tipopersonal"]=$login[0]["doc_tipo"];
				$_SESSION["idpersonal"]=$login[0]["doc_id"];
				header('Location:'.base_url().'principal');
			}
		}else{
			$_SESSION["personal"]=$login[0]["per_nombres"].' '.$login[0]["per_apellidos"];
			$_SESSION["tipopersonal"]=$login[0]["per_tipo"];
			$_SESSION["idpersonal"]=$login[0]["per_id"];
			header('Location:'.base_url().'principal');
		}
	}
}