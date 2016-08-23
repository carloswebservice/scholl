<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistencia extends CI_Controller {
	public function index(){
		$cursos = $this->db->query("select *from cursos as c inner join asignacion_doc as ad on(c.cur_id=ad.asi_curso) inner join docente as d on(d.doc_id=ad.asi_doc) where ad.asi_estado=1 and d.doc_id=".$_SESSION["idpersonal"])->result();
        $aulas = $this->db->query("select *from aula where aula_estado=1")->result();
        $calificacion = $this->db->query("select *from calificacion where cal_estado=1")->result();
		$this->load->view('Asistencia/index',compact("cursos","calificacion","aulas"));
	}

	public function iniciarclase(){
		$data = array(
            'cla_fecha' => date("Y-m-d"),
            'cla_hora_ini' => date("H:i a")
        );
        $this->db->insert('clase', $data);
        $clase = $this->db->insert_id();

		$listaalumnos = $this->db->query("select a.*,lc.* from matriculas as m inner join alumnos as a on(m.mat_alum=a.alum_id) inner join lista_curso as lc on(lc.lis_mat=m.mat_id) inner join asignacion_doc as ad on(ad.asi_id=lc.lis_asi) where ad.asi_curso=".$_POST["curso"])->result_array();

        $html =""; $cont=0;
        foreach ($listaalumnos as $value) { $cont=$cont+1;
        	// Insertamos Su Asistencia Temporal //
            $data = array(
	            'asis_clase' => $clase,
	            'asis_alum' => $value["alum_id"],
	            'asis_lista' => $value["lis_id"],
	            'asis_estado' => 0
	        );
	        $this->db->insert('asistencia', $data);
	        $asisten=$this->db->insert_id();

            $html .= '<tr>';
            $html .= "<td> <center>".$cont."</center></td>";
            $html .= "<td> <center>".$value["alum_nombres"]." ".$value["alum_apellidos"]."</center></td>";
            $html .= "<td> <center><small class='label bg-green'> Sin Control </small>  </center></td>";
            $html .= "<td> <center> <button type='button' class='btn btn-primary btn-xs' onclick='vernotas(".$value["lis_id"].",".$asisten.")'>Ver Notas</button> </center></td>";
            $html .= '</tr>';
        }
        echo $html;
	}
	public function finclase(){
		$clase = $this->db->query("select max(cla_id) as clase from clase")->result_array();
		$data = array(
            'cla_aula' => $_POST["aula"],
            'cla_hora_fin' => $_POST["fin"]
        );
        $this->db->where("cla_id",$clase[0]["clase"]);
        $this->db->update('clase', $data);
	}
	public function controlasistencia(){
		$clase = $this->db->query("select max(cla_id) as clase from clase")->result_array();
		$listaalumnos = $this->db->query("select a.*,asis.* from asistencia as asis inner join alumnos as a on(asis.asis_alum=a.alum_id) inner join clase as c on(c.cla_id=asis.asis_clase) where c.cla_id=".$clase[0]["clase"])->result_array();

        $html =""; $cont=0;
        foreach ($listaalumnos as $value) { $cont=$cont+1;
        	if ($value["asis_estado"]==0) {
        		$check="";
        	}else{
        		$check="checked";
        	}
            $html .= '<tr>';
            $html .= "<td> <center>".$cont."</center></td>";
            $html .= "<td> <center>".$value["alum_nombres"]." ".$value["alum_apellidos"]."</center></td>";
            $html .= "<td> <center> <input type='checkbox' name='alumnos[]' value='".$value["alum_id"]."' $check > </center></td>";
            $html .= '</tr>';
        }
        echo $html;
	}

	public function guardarasistencia(){
		$clase = $this->db->query("select max(cla_id) as clase from clase")->result_array();
		$listaalumnos = $this->db->query("select a.*,asis.* from asistencia as asis inner join alumnos as a on(asis.asis_alum=a.alum_id) inner join clase as c on(c.cla_id=asis.asis_clase) where c.cla_id=".$clase[0]["clase"])->result_array();

        foreach ($listaalumnos as $val) {
        	$return = "N";
        	if (isset($_POST["alumnos"])) {
        		foreach ($_POST["alumnos"] as $key => $value) {
	        		if ($val["alum_id"]==$value) {
		    			$return = "S";
		    		}
		        }
        	}
        	
	        if ($return=="N") {
    			$data = array(
	                'asis_estado' => 0
	            );
    		}else{
    			$data = array(
	                'asis_estado' => 1
	            );
    		}
	        $this->db->where("asis_clase",$clase[0]["clase"]);
		    $this->db->where("asis_alum",$val["alum_id"]);
		    $this->db->update('asistencia', $data);
        }
        // Actualizamos La Lista //
        $listaalumnos = $this->db->query("select a.*,asis.* from asistencia as asis inner join alumnos as a on(asis.asis_alum=a.alum_id) inner join clase as c on(c.cla_id=asis.asis_clase) where c.cla_id=".$clase[0]["clase"])->result_array();
        $html =""; $cont=0;
        foreach ($listaalumnos as $value) { $cont=$cont+1;
            $html .= '<tr>';
            $html .= "<td> <center>".$cont."</center></td>";
            $html .= "<td> <center>".$value["alum_nombres"]." ".$value["alum_apellidos"]."</center></td>";
            if ($value["asis_estado"]==1) {
            	$html .= "<td> <center><small class='label bg-green'> Asistió </small>  </center></td>";
            }else{
            	$html .= "<td> <center><small class='label bg-red'> Faltó </small>  </center></td>";
            }
            $html .= "<td> <center> <button type='button' class='btn btn-primary btn-xs' onclick='vernotas(".$value["asis_lista"].",".$value["asis_id"].")'>Ver Notas</button> </center></td>";
            $html .= '</tr>';
        }
        echo $html;
	}


	public function vernotas(){
		$listaalumnos = $this->db->query("select *from asistencia as asis inner join notas as n on(n.not_asis=asis.asis_id) inner join calificacion as c on(c.cal_id=n.not_cal) where asis.asis_lista=".$_POST["cursomatriculado"])->result_array();
        $html =""; $cont=0;
        foreach ($listaalumnos as $value) {$cont=$cont+1;
            $html .= '<tr>';
            $html .= "<td> <center>".$cont."</center></td>";
            $html .= "<td> <center>".$value["cal_desc"]."</center></td>";
            $html .= "<td> <center>".$value["nota"]."</center></td>";
            $html .= '</tr>';
        }
        echo $html;
	}

	public function guardarnotas(){
		$data = array(
            'not_asis' => $_POST["asistencia"],
            'not_cal' => $_POST["calificacion"],
            'nota' => $_POST["nota"]
        );
        $this->db->insert('notas', $data);

		$listaalumnos = $this->db->query("select *from asistencia as asis inner join notas as n on(n.not_asis=asis.asis_id) inner join calificacion as c on(c.cal_id=n.not_cal) where asis.asis_lista=".$_POST["cursomatriculado"])->result_array();
        $html =""; $cont=0;
        foreach ($listaalumnos as $value) {$cont=$cont+1;
            $html .= '<tr>';
            $html .= "<td> <center>".$cont."</center></td>";
            $html .= "<td> <center>".$value["cal_desc"]."</center></td>";
            $html .= "<td> <center>".$value["nota"]."</center></td>";
            $html .= '</tr>';
        }
        echo $html;
	}
}
