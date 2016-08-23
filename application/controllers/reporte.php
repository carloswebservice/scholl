<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
	public function index(){
		$this->load->view('Principal/index');
	}

	public function asistencia_asignatura(){
		$cursos["curso"] = $this->db->query("select c.*from cursos as c inner join asignacion_doc as ad on(c.cur_id=ad.asi_curso) inner join docente as d on(d.doc_id=ad.asi_doc) where ad.asi_estado=1 and d.doc_id=".$_SESSION["idpersonal"])->result_array();
		foreach ($cursos["curso"] as $key => $value) {
			$query= $this->db->query("select distinct(a.alum_id),a.*from alumnos as a inner join asistencia as asi on(a.alum_id=asi.asis_alum) inner join clase as c on(c.cla_id=asi.asis_clase) inner join lista_curso as lc on(lc.lis_id=asi.asis_lista) inner join asignacion_doc as ad on(ad.asi_id=lc.lis_asi) where ad.asi_curso=".$value["cur_id"])->result_array();
			$cursos["curso"][$key]["alumnos"]=$query;
		}

		foreach ($cursos["curso"] as $key => $value) {
			foreach ($value["alumnos"] as $k => $val) {
				$query= $this->db->query("select asi.*,c.*from alumnos as a inner join asistencia as asi on(a.alum_id=asi.asis_alum) inner join clase as c on(c.cla_id=asi.asis_clase) inner join lista_curso as lc on(lc.lis_id=asi.asis_lista) inner join asignacion_doc as ad on(ad.asi_id=lc.lis_asi) where a.alum_id=".$val["alum_id"]." and ad.asi_curso=".$value["cur_id"])->result_array();
				$cursos["curso"][$key]["alumnos"][$k]["asistencia"]=$query;
			}
		}
		//echo "<pre>";
		//print_r($cursos); exit();
		$this->load->view('Reporte/asistencia_asignatura',compact("cursos"));
	}
}
