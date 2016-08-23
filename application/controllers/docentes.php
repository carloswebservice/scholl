<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes extends CI_Controller {
	public function index(){
		$docentes = $this->db->query("select d.doc_id, d.doc_nombres, d.doc_apellidos, d.doc_usuario, t.tip_desc from docente as d inner join tipo_personal as t on (d.doc_tipo=t.tip_id) where doc_estado=1")->result();
		$this->load->view('Docentes/index',compact("docentes"));
	}

	public function grabar(){
		$data = array(
           'doc_nombres' => $_POST["nombres"],
           'doc_apellidos' => $_POST["apellidos"],
           'doc_usuario' => $_POST["usuario"],
           'doc_clave' => $_POST["clave"],
           'doc_tipo' => 4  
        );
        if($_POST["id"]==""){
            $situacion=$this->db->insert('docente', $data);
            if($situacion==1){
	            echo 'I';
	        }else{
	            echo '0';
	        }
        }else{
            $this->db->where('doc_id',$_POST["id"]);
            $situacion=$this->db->update('docente', $data);
            if($situacion==1){
	            echo 'M';
	        }else{
	            echo '0';
	        }
        }
	}

	function modificar(){
        $query = $this->db->get_where('docente', array('doc_id' => $_POST["id"]))->result();
        echo json_encode($query);
    }

    function eliminar(){
        $data = array(
           'doc_estado' => 0
        );
        $this->db->where('doc_id', $_POST["id"]);
        $situacion=$this->db->update('docente', $data);
        if($situacion==1){
            echo 'E';
        }else{
            echo '0';
        }
    }
}
