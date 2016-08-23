<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller {
	public function index(){
		$alumnos = $this->db->query("select a.alum_id, a.alum_nombres, a.alum_apellidos, a.alum_edad, a.alum_usuario, a.alum_clave, t.tip_desc from alumnos as a inner join tipo_personal as t on 
      (a.alum_tipo=t.tip_id) where a.alum_estado=1")->result();
		$this->load->view('Alumnos/index',compact("alumnos"));
	}

	public function grabar(){
		$data = array(
           'alum_nombres' => $_POST["nombres"],
           'alum_apellidos' => $_POST["apellidos"],
           'alum_edad' => $_POST["edad"],
           'alum_usuario' => $_POST["usuario"],
           'alum_clave' => $_POST["clave"],
           'alum_tipo' => 3
        );
        if($_POST["id"]==""){
            $situacion=$this->db->insert('alumnos', $data);
            if($situacion==1){
	            echo 'I';
	        }else{
	            echo '0';
	        }
        }else{
            $this->db->where('alum_id',$_POST["id"]);
            $situacion=$this->db->update('alumnos', $data);
            if($situacion==1){
	            echo 'M';
	        }else{
	            echo '0';
	        }
        }
	}

	function modificar(){
        $query = $this->db->get_where('alumnos', array('alum_id' => $_POST["id"]))->result();
        echo json_encode($query);
    }

    function eliminar(){
        $data = array(
           'alum_estado' => 0
        );
        $this->db->where('alum_id', $_POST["id"]);
        $situacion=$this->db->update('alumnos', $data);
        if($situacion==1){
            echo 'E';
        }else{
            echo '0';
        }
    }

    function misnotas(){
      $nota = $this->db->query("select avg(nota) as nota,a.asis_lista as lista from notas as n inner join asistencia as a on(n.not_asis=a.asis_id) where a.asis_alum=".$_SESSION["idpersonal"]." group by a.asis_lista")->result_array();

      $data = array(
         'lis_promedio' => $nota[0]["nota"]
      );
      $this->db->where('lis_id', $nota[0]["lista"]);
      $situacion=$this->db->update('lista_curso', $data);

      $alumnos = $this->db->query("select *from alumnos as al inner join matriculas as m on(al.alum_id=m.mat_alum) inner join lista_curso as lc on(m.mat_id=lc.lis_mat) inner join asignacion_doc as ad on(ad.asi_id=lc.lis_asi) inner join cursos as cu on(cu.cur_id=ad.asi_curso) where al.alum_id=".$_SESSION["idpersonal"])->result();
      $this->load->view('Alumnos/vernotas',compact("alumnos"));
    }
}
