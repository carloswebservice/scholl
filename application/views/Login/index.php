<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Software | Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/plugins/iCheck/square/blue.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">
                <div class="login-logo">
                    <a href="../../index2.html"><b>Control</b> Asistencia</a>
                </div>
                <form action="<?php echo base_url();?>login/logearse" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="clave" placeholder="Clave" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-12"> <br>
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button> <br>
                        </div>
                    </div>
                </form>
                <!--<div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Login Con Facebook
                    Facebook</a>
                </div> -->
            </div>
        </div>
        <script src="<?php echo base_url();?>public/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>public/plugins/iCheck/icheck.min.js"></script>
        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
            });
          });
        </script>
    </body>
</html>
