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
                                    <h3 class="box-title">Lista De Matriculas</h3>
                                </div>
                                <div class="box-body">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#nuevo" style="z-index:2;margin-bottom: 7px !important; position: absolute;"> Nueva Matricula</button>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>Codigo</th>
                                              <th>Semestre</th>
                                              <th>Fecha Matricula</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                              foreach ($matriculados as $value) { ?>
                                                <tr>
                                                  <td><?php echo $value->mat_alum ?></td>
                                                  <td><?php echo $value->alum_nombres.' '.$value->alum_apellidos ?></td>
                                                  <td><?php echo $value->mat_fecha ?></td>
                                                </tr>
                                              <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <div class="modal fade" tabindex="-1" role="dialog" id="nuevo">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Realizar Matricula</h3>
                        </div>
                        <form class="form-horizontal" id="form_matricula">
                          <div class="box-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                              <div class="col-md-7">
                                <select class="form-control" id="alumno" name="alumno">
                                  <option value="alumno">Seleccione Alumno</option>
                                  <?php 
                                    foreach ($alumnos as $value) { ?>
                                      <option value="<?php echo $value->alum_id ?>"><?php echo $value->alum_nombres ?></option>
                                    <?php }
                                  ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <select class="form-control" id="ciclo" name="ciclo">
                                  <option value="ciclo">Ciclo</option>
                                  <option value="I">I</option><option value="II">II</option>
                                  <option value="III">III</option><option value="IV">IV</option>
                                  <option value="V">V</option><option value="VI">VI</option>
                                  <option value="VII">VII</option><option value="VIII">VIII</option>
                                  <option value="IX">IX</option><option value="X">X</option>
                                </select>
                              </div>
                              <div class="col-md-3">
                                <select class="form-control" id="semestre" name="semestre">
                                  <option value="0">Semestre</option>
                                  <?php 
                                    foreach ($semestres as $value) { ?>
                                      <option value="<?php echo $value->sem_id ?>"><?php echo $value->sem_desc ?></option>
                                    <?php }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <center><h4>Lista De Cursos</h4></center>
                            <table class="table table-condensed">
                              <thead>
                                <tr>
                                  <th><center>Num Creditos</center></th>
                                  <th><center>Curso</center></th>
                                  <th><center>Matricularme</center></th>
                                </tr>
                              </thead>
                              <tbody id="actualizacursos"> </tbody>
                            </table>
                          </div>
                          <div class="box-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" onclick="guardar()" class="btn btn-info pull-right">Grabar</button>
                          </div>
                          <!-- /.box-footer -->
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
          $("#semestre").change(function(){
            $.ajax({
                  type: "POST",
                  data: "semestre="+$(this).val()+" & ciclo="+$("#ciclo").val(),
                  url: url+'matricula/listado',
                  success: function(data){
                    $("#actualizacursos").empty();
                    $("#actualizacursos").append(data);
                  }
              })
          });
          $("#ciclo").change(function(){
            $.ajax({
                  type: "POST",
                  data: "ciclo="+$(this).val()+" & semestre="+$("#semestre").val(),
                  url: url+'matricula/listado',
                  success: function(data){
                    $("#actualizacursos").empty();
                    $("#actualizacursos").append(data);
                  }
              })
          });
          function actualizar(){
            $("#mensaje").modal("hide");
            location.href=window.location;
          }
        </script>
    </body>
</html>
