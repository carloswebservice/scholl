<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Software | Admin</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/skins/_all-skins.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include("public/base.inc"); ?>
            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista De Los Curso Que Dicto</h3>
                                </div>
                                <div class="box-body"> <br>
                                    <div class="row">
                                        <?php 
                                          foreach ($cursos as $value) { ?>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                              <div class="info-box">
                                                <span class="info-box-icon bg-primary"><i class="fa fa-flag-o"></i></span>
                                                <div class="info-box-content">
                                                  <span class="info-box-text"><?php echo $value->cur_desc ?></span>
                                                  <span class="info-box-number">Creditos: <?php echo $value->cur_creditos ?></span>
                                                  <span class="info-box-number">Ciclo: <?php echo $value->cur_ciclo ?> &nbsp; <button class="btn btn-primary btn-xs" onclick="iniciarclase('<?php echo $value->cur_id ?>')"> Iniciar La Clase</button> </span>
                                                </div>
                                              </div>
                                            </div>
                                          <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <div class="modal fade" tabindex="-1" role="dialog" id="nuevo">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Se Está Realizando La Clase</h3>
                        </div>
                        <form class="form-horizontal" id="form_clases">
                          <div class="box-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                              <div class="col-md-4">
                                <select class="form-control" id="aula" name="aula">
                                  <option value="aula">Seleccione Aula De Clases</option>
                                  <?php 
                                    foreach ($aulas as $value) { ?>
                                      <option value="<?php echo $value->aula_id ?>"><?php echo $value->aula_desc ?></option>
                                    <?php }
                                  ?>
                                </select>
                              </div>
                              <label class="col-md-2 control-label">Hora Inicio</label>
                              <div class="col-md-2">
                                <input type="text" class="form-control" disabled="true" value="<?php echo date('H:i a') ?>">
                              </div>
                              <label class="col-md-2 control-label">Hora Final</label>
                              <div class="col-md-2">
                                <input type="text" class="form-control" id="fin" name="fin">
                              </div>
                            </div>
                            <center><h4>Lista De Alumnos Matriculados</h4></center>
                            <table class="table table-condensed">
                              <thead>
                                <tr>
                                  <th><center>Nro</center></th>
                                  <th><center>Nombres y Apellidos</center></th>
                                  <th><center>Hoy Dia</center></th>
                                  <th><center>Accion</center></th>
                                </tr>
                              </thead>
                              <tbody id="actualizaalumnos"> </tbody>
                            </table>
                          </div>
                          <div class="box-footer">
                            <button type="button" onclick="controlasistencia()" class="btn btn-danger pull-left">Controlar Asistencia</button>
                            <button type="button" onclick="terminarclase()" class="btn btn-info pull-right">Dar Por Terminada La Clase</button>
                          </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="controlasis">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Se Está Llamando Lista</h3>
                        </div>
                        <form class="form-horizontal" id="form_asistencia">
                          <div class="box-body">
                            <table class="table table-condensed">
                              <thead>
                                <tr>
                                  <th><center>Nro</center></th>
                                  <th><center>Nombres y Apellidos</center></th>
                                  <th><center>Asistencia</center></th>
                                </tr>
                              </thead>
                              <tbody id="actualizalista"> </tbody>
                            </table>
                          </div>
                          <div class="box-footer">
                            <button type="button" onclick="terminarcontrolasis()" class="btn btn-info pull-right">Terminar Control Asistencia</button>
                          </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="vernotas">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Lista De Notas</h3>
                        </div>
                        <form class="form-horizontal" id="form_notas">
                          <div class="box-body">
                            <div class="form-group">
                              <input type="hidden" id="asistencia" name="asistencia">
                              <input type="hidden" id="cursomatriculado" name="cursomatriculado">
                              <div class="col-md-4">
                                <select class="form-control" id="calificacion" name="calificacion">
                                  <option value="calificacion">Seleccione Examen</option>
                                  <?php 
                                    foreach ($calificacion as $value) { ?>
                                      <option value="<?php echo $value->cal_id ?>"><?php echo $value->cal_desc ?></option>
                                    <?php }
                                  ?>
                                </select>
                              </div>
                              <label class="col-md-2 control-label">Nota</label>
                              <div class="col-md-2">
                                <input type="text" class="form-control" name="nota" id="nota">
                              </div>
                              <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="guardarnota()">Guardar</button>
                              </div>
                            </div>
                            <table class="table table-condensed">
                              <thead>
                                <tr>
                                  <th><center>Nro</center></th>
                                  <th><center>Descripcion</center></th>
                                  <th><center>Nota</center></th>
                                </tr>
                              </thead>
                              <tbody id="actualizanotas"> </tbody>
                            </table>
                          </div>
                          <div class="box-footer">
                            <button type="button" class="btn btn-info pull-right" data-dismiss="modal">Cerrar</button>
                          </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" id="mensaje">
                <div class="modal-dialog modal-xs">
                  <div class="modal-content">
                    <div class="modal-header">
                      <center>
                        <h3 class="modal-title" id="alert_mensaje"></h3> <br>
                        <button type="button" class="btn btn-danger" onclick="actualizar()"> 
                          <i class="icon fa fa-times"></i> Ok. Cerrar
                        </button> <br>
                      </center>
                    </div>
                  </div>
                </div>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Control</b> Asistencia
                </div>
                <strong>Copyright &copy; 2016-2021<a href="#"> Ingenieria de Software I</a></strong>
            </footer>
        </div>
        <script src="<?php echo base_url();?>public/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url();?>public/plugins/fastclick/fastclick.js"></script>
        <script src="<?php echo base_url();?>public/dist/js/app.min.js"></script>
        <script src="<?php echo base_url();?>public/dist/js/demo.js"></script>
        <script>
          var url = "<?php echo base_url()?>";
          $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });
          });
          function guardar(){
            if ($("#alumno").val()=="alumno") {
              $("#alumno").focus();return 0;
            }
            if ($("#ciclo").val()=="ciclo") {
              $("#ciclo").focus();return 0;
            }
            if ($("#semestre").val()=="semestre") {
              $("#semestre").focus();return 0;
            }
            $.ajax({
                data:  $("#form_matricula").serialize(),
                url:   url+'matricula/grabar',
                type:  'post',
                success: function(data) {
                  if (data=='I') {
                    $("#alert_mensaje").html("<i class='icon fa fa-ban'></i> Registrado Correctamente");
                  }else{
                    $("#alert_mensaje").html("<i class='icon fa fa-times'></i> No Se Ha Realizado La Operacion !!! Error");
                  }
                  $("#nuevo").modal("hide");
                  $("#mensaje").modal("show");
                }
            });
          }
          var cursoactual = 0;
          function iniciarclase(curso){
            cursoactual=curso;
            $.ajax({
                  type: "POST",
                  data: "curso="+curso,
                  url: url+'asistencia/iniciarclase',
                  success: function(data){
                    $("#actualizaalumnos").empty();
                    $("#actualizaalumnos").append(data);
                    $('#nuevo').modal({show:true,backdrop:'static'});
                  }
            })
          }
          function controlasistencia(){
            $.ajax({
                  type: "POST",
                  data: "curso="+cursoactual,
                  url: url+'asistencia/controlasistencia',
                  success: function(data){
                    $("#actualizalista").empty();
                    $("#actualizalista").append(data);
                    $('#controlasis').modal({show:true,backdrop:'static'});
                  }
            })
          }
          function terminarclase(){
            if ($("#aula").val()=="aula") {
              $("#aula").focus(); return 0;
            }
            if ($("#fin").val()=="") {
              $("#fin").focus(); return 0;
            }
            $.ajax({
                  type: "POST",
                  data: $("#form_clases").serialize(),
                  url: url+'asistencia/finclase',
                  success: function(data){
                    $('#nuevo').modal("hide");
                  }
            })
          }
          function terminarcontrolasis(){
            $.ajax({
                  type: "POST",
                  data: $("#form_asistencia").serialize(),
                  url: url+'asistencia/guardarasistencia',
                  success: function(data){
                    $("#actualizaalumnos").empty();
                    $("#actualizaalumnos").append(data);
                    $('#controlasis').modal("hide");
                  }
            })
          }
          function vernotas(id,asis){
            $("#asistencia").val(asis);
            $("#cursomatriculado").val(id);
            $.ajax({
                  type: "POST",
                  data: "cursomatriculado="+id,
                  url: url+'asistencia/vernotas',
                  success: function(data){
                    $("#actualizanotas").empty();
                    $("#actualizanotas").append(data);
                    $("#vernotas").modal("show");
                  }
            })
          }
          function guardarnota(){
            if ($("#calificacion").val()=="calificacion") {
              $("#calificacion").focus(); return 0;
            }
            if ($("#nota").val()=="") {
              $("#nota").focus(); return 0;
            }
            $.ajax({
                  type: "POST",
                  data: $("#form_notas").serialize(),
                  url: url+'asistencia/guardarnotas',
                  success: function(data){
                    $("#actualizanotas").empty();
                    $("#actualizanotas").append(data);
                  }
            })
          }
          function actualizar(){
            $("#mensaje").modal("hide");
            location.href=window.location;
          }
        </script>
    </body>
</html>
