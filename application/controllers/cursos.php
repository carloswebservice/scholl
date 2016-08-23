<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
	public function index(){
		$cursos = $this->db->query("select * from cursos where cur_estado=1")->result();
		$this->load->view('Cursos/index',compact("cursos"));
	}

	public function grabar(){
		$data = array(
           'cur_desc' => $_POST["curso"],
           'cur_ciclo' => $_POST["ciclo"],
           'cur_creditos' => $_POST["creditos"]
        );
        if($_POST["id"]==""){
            $situacion=$this->db->insert('cursos', $data);
            if($situacion==1){
	            echo 'I';
	        }else{
	            echo '0';
	        }
        }else{
            $this->db->where('cur_id',$_POST["id"]);
            $situacion=$this->db->update('cursos', $data);
            if($situacion==1){
	            echo 'M';
	        }else{
	            echo '0';
	        }
        }
	}

	function modificar(){
        $query = $this->db->get_where('cursos', array('cur_id' => $_POST["id"]))->result();
        echo json_encode($query);
    }

    function eliminar(){
        $data = array(
           'cur_estado' => 0
        );
        $this->db->where('cur_id', $_POST["id"]);
        $situacion=$this->db->update('cursos', $data);
        if($situacion==1){
            echo 'E';
        }else{
            echo '0';
        }
    }
}
