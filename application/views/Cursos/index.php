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
                                    <h3 class="box-title">Lista De Alumnos</h3>
                                </div>
                                <div class="box-body">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#nuevo" style="z-index:2;margin-bottom: 7px !important; position: absolute;"> Nuevo Registro</button>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>Codigo</th>
                                              <th>Curso</th>
                                              <th>Ciclo</th>
                                              <th>Creditos</th>
                                              <th>Estado</th>
                                              <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                              foreach ($cursos as $value) { ?>
                                                <tr>
                                                  <td><?php echo $value->cur_id ?></td>
                                                  <td><?php echo $value->cur_desc ?></td>
                                                  <td><?php echo $value->cur_ciclo ?></td>
                                                  <td><?php echo $value->cur_creditos ?></td>
                                                  <td> <small class="label bg-green"> Activo</small></td>
                                                  <td>
                                                    <button type="button" class="btn btn-warning btn-xs" onclick="modificar('<?php echo $value->cur_id ?>')">Modificar</button>
                                                    <button type="button" class="btn btn-danger btn-xs" onclick="eliminar('<?php echo $value->cur_id ?>')">Eliminar</button>
                                                  </td>
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
                          <h3 class="box-title">Registro Cursos</h3>
                        </div>
                        <form class="form-horizontal" id="form_cursos">
                          <div class="box-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Curso</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="curso" name="curso">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Ciclo</label>
                              <div class="col-sm-9">
                                <select name="ciclo" class="form-control">
                                <option value="0">Selecionar</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="VI">VI</option>
                                <option value="VII">VII</option>
                                <option value="VII">VIII</option>
                                <option value="IX">IX</option>
                                <option value="X">X</option>
                              </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Creditos</label>
                              <div class="col-sm-9">
                                <select name="creditos" class="form-control">
                                <option value="0">Selecionar</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
            if ($("#curso").val()=="") {
              $("#curso").focus();return 0;
            }
            if ($("#ciclo").val()=="") {
              $("#ciclo").focus();return 0;
            }
            if ($("#creditos").val()=="") {
              $("#creditos").focus();return 0;
            }
            $.ajax({
                data:  $("#form_cursos").serialize(),
                url:   url+'Cursos/grabar',
                type:  'post',
                success: function(data) {
                  if (data=='I') {
                    $("#alert_mensaje").html("<i class='icon fa fa-ban'></i> Registrado Correctamente");
                  }else{
                    if (data=='M') {
                      $("#alert_mensaje").html("<i class='icon fa fa-ban'></i> Modificado Correctamente");
                    }else{
                      $("#alert_mensaje").html("<i class='icon fa fa-times'></i> No Se Ha Realizado La Operacion !!! Error");
                    }
                  }
                  $("#nuevo").modal("hide");
                  $("#mensaje").modal("show");
                }
            });
          }
          function modificar(id){
            $.ajax({
                data:  'id='+id,
                url:   url+'Cursos/modificar',
                type:  'post',
                success: function(data) {
                  var datos = eval(data);
                  $("#id").val(datos[0]["cur_id"]);
                  $("#curso").val(datos[0]["cur_desc"]);
                  $("#ciclo").val(datos[0]["cur_ciclo"]);
                  $("#creditos").val(datos[0]["cur_credito"]);
                  $("#nuevo").modal("show");
                }
            });
          }
          function eliminar(id){
            if (confirm("Seguro Eliminar !")) {
              $.ajax({
                  data:  'id='+id,
                  url:   url+'Cursos/eliminar',
                  type:  'post',
                  success: function(data) {
                    if(data=='E'){
                      $("#alert_mensaje").html("<i class='icon fa fa-ban'></i> Eliminado Correctamente");
                    }else{
                      $("#alert_mensaje").html("<i class='icon fa fa-times'></i> No Se Ha Realizado La Operacion !!! Error");
                    }
                    $("#mensaje").modal("show");
                  }
              })
            }
          }
          function actualizar(){
            $("#mensaje").modal("hide");
            location.href=window.location;
          }
        </script>
    </body>
</html>
