<?php
//session_start();
//echo $_SESSION["url"];
//echo "hola";
//var_dump($_SESSION);
//if($_SESSION["s_usuario"] === null){
  //  header("Location: ../index.php");
//}

?>
<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema de Efectos</title>
        <link rel="shortcut icon" href="imagenes/icono.ico">

        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="../fuentes/iconic/css/material-design-iconic-font.min.css">
    </head>
    
    <body>
      <div class="container-login">
        <div class="wrap-login">
            <div style="text-align: center;position: relative; top: -50px;">
                <img src="../imagenes/logoBlanco.ico"  style="background: #E8F0FE; border-radius: 50%; max-height: 130px;">
                <!-- <img src="imagenes/EST.png" width="50%"> -->

            </div>
            <form class="login-form validate-form" id="formLogin" action="" method="post">
                <?php
                if(isset($_GET['id'])){
                    echo "<input id='id' name='id' type='hidden' value='".$_GET['id']."'>";
                }else{
                    echo "<input id='id' name='id' type='hidden'>";
                }
                ?>



                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
                    <span class="focus-efecto"></span>
                </div>

                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>

                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>


                    </div>
                </div>
            </form>
        </div>
    </div>     
        
        
     <script src="../jquery/jquery-3.3.1.min.js"></script>
     <script src="../bootstrap/js/bootstrap.min.js"></script>

     <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
     <script src="js/codigo.js"></script>
    </body>
</html>