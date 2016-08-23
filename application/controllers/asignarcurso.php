<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignarcurso extends CI_Controller {
	public function index(){
        $asignados = $this->db->query("select ad.asi_id as codigo, s.sem_desc as semestre, c.cur_desc as curso,d.doc_nombres as docnom,d.doc_apellidos as docape from asignacion_doc as ad inner join semestre as s on(ad.asi_sem=s.sem_id) inner join cursos as c on(ad.asi_curso=c.cur_id) inner join docente as d on(ad.asi_doc=d.doc_id) where ad.asi_estado=1")->result();
		$semestres = $this->db->query("select *from semestre where sem_estado=1")->result();
        $asignaturas = $this->db->query("select *from cursos where cur_estado=1")->result();
        $docentes = $this->db->query("select *from docente where doc_estado=1")->result();
		$this->load->view('Asignarcurso/index',compact("asignados","semestres","asignaturas","docentes"));
	}

	public function grabar(){
		$data = array(
            'asi_curso' => $_POST["asignatura"],
            'asi_sem' => $_POST["semestre"],
            'asi_doc' => $_POST["docente"]
        );
        if($_POST["id"]==""){
            $situacion=$this->db->insert('asignacion_doc', $data);
            if($situacion==1){
	            echo 'I';
	        }else{
	            echo '0';
	        }
        }else{
            $this->db->where('asi_id',$_POST["id"]);
            $situacion=$this->db->update('asignacion_doc', $data);
            if($situacion==1){
	            echo 'M';
	        }else{
	            echo '0';
	        }
        }
	}

	function modificar(){
        $query = $this->db->get_where('asignacion_doc', array('asi_id' => $_POST["id"]))->result();
        echo json_encode($query);
    }

    function eliminar(){
        $data = array(
           'asi_estado' => 0
        );
        $this->db->where('asi_id', $_POST["id"]);
        $situacion=$this->db->update('asignacion_doc', $data);
        if($situacion==1){
            echo 'E';
        }else{
            echo '0';
        }
    }
}
