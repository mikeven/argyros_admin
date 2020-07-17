<?php
    /*
     * Argyros Admin - Inicio de sesión
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/data-user.php" );
    checkSession( 'index' );
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>:: Argyros :: Administrador de Contenido</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/fn-user.js"></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="loginform" role="form">
              <h1>Iniciar sesión</h1>
              <input name="login" type="hidden" value="1"/>
              <!-- DEVELOPMENT -->
              
              <div>
                <input type="text" class="form-control" placeholder="Dirección de correo" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" name="password"/>
              </div>
              <div>
                <a class="btn btn-default submit" href="#!" onClick="log_in()">Ingresar</a>
                <a class="reset_pass hidden" href="#!">¿Olvidó su contraseña?</a>
              </div>

              <div class="clearfix"></div>
           
              <div class="separator">
                <p class="change_link hidden">¿Usuario nuevo?
                  <a href="#signup" class="to_register"> Crear cuenta</a>
                </p>

                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><img dt> Argyros Admin</h1>
                  <p>©2018 Administrador de contenido web</p>
                </div>
                <div id="response"></div>
              </div>

            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
