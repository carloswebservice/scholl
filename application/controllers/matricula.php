<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula extends CI_Controller {
	public function index(){
        $matriculados = $this->db->query("select *from matriculas as m inner join alumnos as a on(m.mat_alum=a.alum_id) where m.mat_estado=1")->result();
		$alumnos = $this->db->query("select *from alumnos where alum_estado=1")->result();
        $semestres = $this->db->query("select *from semestre where sem_estado=1")->result();
		$this->load->view('Matricula/index',compact("matriculados","alumnos","semestres"));
	}

	public function grabar(){
		$data = array(
            'mat_alum' => $_POST["alumno"],
            'mat_fecha' => date("Y-m-d"),
            'mat_sem' => $_POST["semestre"]
        );
        $situacion=$this->db->insert('matriculas', $data);
        $matricula = $this->db->insert_id();

        foreach ($_POST["cursos"] as $key => $value) {
            $data = array(
                'lis_asi' => $value,
                'lis_mat' => $matricula
            );
            $this->db->insert('lista_curso', $data);
        }

        if($situacion==1){
            echo 'I';
        }else{
            echo '0';
        }
	}

	public function listado(){
        $listacursos = $this->db->query("select ad.asi_id as codigo, c.cur_creditos as creditos,c.cur_desc as curso from asignacion_doc as ad inner join semestre as s on(ad.asi_sem=s.sem_id) inner join cursos as c on(ad.asi_curso=c.cur_id) where ad.asi_estado=1 and c.cur_ciclo='".$_POST["ciclo"]."' and s.sem_id=".$_POST["semestre"])->result_array();

        $html ="";
        foreach ($listacursos as $value) {
            $html .= '<tr>';
            $html .= "<td> <center>".$value["creditos"]." </center></td>";
            $html .= "<td> <center>".$value["curso"]." </center></td>";
            $html .= "<td> <center> <input type='checkbox' name='cursos[]' value='".$value["codigo"]."'> </center></td>";
            $html .= '</tr>';
        }
        echo $html;
    }
}
