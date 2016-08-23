<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aula extends CI_Controller {
	public function index(){
		$aula = $this->db->query("select * from aula where aula_estado=1")->result();
		$this->load->view('Aula/index',compact("aula"));
	}

	public function grabar(){
		$data = array(
           'aula_desc' => $_POST["aula"]
        );
        if($_POST["id"]==""){
            $situacion=$this->db->insert('aula', $data);
            if($situacion==1){
	            echo 'I';
	        }else{
	            echo '0';
	        }
        }else{
            $this->db->where('aula_id',$_POST["id"]);
            $situacion=$this->db->update('aula', $data);
            if($situacion==1){
	            echo 'M';
	        }else{
	            echo '0';
	        }
        }
	}

	function modificar(){
        $query = $this->db->get_where('aula', array('aula_id' => $_POST["id"]))->result();
        echo json_encode($query);
    }

    function eliminar(){
        $data = array(
           'aula_estado' => 0
        );
        $this->db->where('aula_id', $_POST["id"]);
        $situacion=$this->db->update('aula', $data);
        if($situacion==1){
            echo 'E';
        }else{
            echo '0';
        }
    }
}
