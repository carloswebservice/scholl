<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semestre extends CI_Controller {
	public function index(){
		$semestres = $this->db->query("select *from semestre where sem_estado=1")->result();
		$this->load->view('Semestre/index',compact("semestres"));
	}

	public function grabar(){
		$data = array(
           'sem_desc' => $_POST["semestre"]
        );
        if($_POST["id"]==""){
            $situacion=$this->db->insert('semestre', $data);
            if($situacion==1){
	            echo 'I';
	        }else{
	            echo '0';
	        }
        }else{
            $this->db->where('sem_id',$_POST["id"]);
            $situacion=$this->db->update('semestre', $data);
            if($situacion==1){
	            echo 'M';
	        }else{
	            echo '0';
	        }
        }
	}

	function modificar(){
        $query = $this->db->get_where('semestre', array('sem_id' => $_POST["id"]))->result();
        echo json_encode($query);
    }

    function eliminar(){
        $data = array(
           'sem_estado' => 0
        );
        $this->db->where('sem_id', $_POST["id"]);
        $situacion=$this->db->update('semestre', $data);
        if($situacion==1){
            echo 'E';
        }else{
            echo '0';
        }
    }
}
