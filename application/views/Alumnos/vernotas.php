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
                                    <h3 class="box-title">Lista De Mis Cursos - Mis Notas</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>Codigo</th>
                                              <th>Curso</th>
                                              <th>Ciclo</th>
                                              <th>Promedio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $suma=0;$cant=0;
                                              foreach ($alumnos as $value) { ?>
                                                <tr>
                                                  <td><?php echo $value->cur_id ?></td>
                                                  <td><?php echo $value->cur_desc ?></td>
                                                  <td><?php echo $value->cur_ciclo ?></td>
                                                  <?php 
                                                    if($value->lis_promedio==""){ ?>
                                                      <td> <small class="label bg-red">Sin Nota</small></td>
                                                    <?php }else{ 
                                                      $suma = $suma+$value->lis_promedio; $cant=$cant+1; ?>
                                                      <td><?php echo $value->lis_promedio ?></td>
                                                    <?php }
                                                  ?>
                                                </tr>
                                              <?php }
                                            ?>
                                        </tbody>
                                    </table> <br>
                                    <?php 
                                      if($cant==0){
                                        $cant=1;
                                      }
                                    ?>
                                    <center> <h4> <b> Promedio General : </b> <?php $promedio=$suma/$cant; echo $promedio ?></h4> </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
            if ($("#nombres").val()=="") {
              $("#nombres").focus();return 0;
            }
            if ($("#apellidos").val()=="") {
              $("#apellidos").focus();return 0;
            }
            if ($("#edad").val()=="") {
              $("#edad").focus();return 0;
            }
            if ($("#usuario").val()=="") {
              $("#usuario").focus();return 0;
            }
            if ($("#clave").val()=="") {
              $("#clave").focus();return 0;
            }
            $.ajax({
                data:  $("#form_alumno").serialize(),
                url:   url+'Alumnos/grabar',
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
                url:   url+'Alumnos/modificar',
                type:  'post',
                success: function(data) {
                  var datos = eval(data);
                  $("#id").val(datos[0]["alum_id"]);
                  $("#nombres").val(datos[0]["alum_nombres"]);
                  $("#apellidos").val(datos[0]["alum_apellidos"]);
                  $("#edad").val(datos[0]["alum_edad"]);
                  $("#usuario").val(datos[0]["alum_usuario"]);
                  $("#clave").val(datos[0]["alum_clave"]);
                  $("#nuevo").modal("show");
                }
            });
          }
          function eliminar(id){
            if (confirm("Seguro Eliminar !")) {
              $.ajax({
                  data:  'id='+id,
                  url:   url+'Alumnos/eliminar',
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
