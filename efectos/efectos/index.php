<?php
require_once "vistas/parte_superior.php";
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron no-seleccionable" style="text-align: center; padding: 1rem 2rem;">
                    <h1 style="font-family: fantasy;color:cornflowerblue; padding-bottom: 50px">
                        SISTEMA DE CONTROL DE EFECTOS
                    </h1>

                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-4 <?php if ($_SESSION["cargos"] != 1) {
                                echo "isDisabled";
                            } ?>">

                            <a href="efectos.php">
                                <div class="divIndex">

                                    <h2>
                                        Efectos Regulados
                                    </h2>

                                    <div class="interior-item" style="background: url(../../imagenes/1.jpeg);background-size: cover;">
                                        <!-- <img src="../imagenes/logoBlanco.ico"
                                              style="border-radius: 50%; max-height: 60px;">
                                          <img src="imagenes/EST.png" width="50%"> -->

                                    </div>
                                    <!--<p class="textoBlanco">
                                        Efectos de Informática con Cargo
                                    </p>-->


                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 <?php if ($_SESSION["fundacion"] != 1) {
                            echo "isDisabled";
                        } ?>">

                            <a href="efectosFundacion.php">
                                <div class="divIndex">
                                    <div>
                                    <h2>
                                        Efectos Fundación
                                    </h2>
                                    </div>
                                    <div class="interior-item" style="background: url(../../imagenes/2.jpeg);background-size: cover;">
                                        <!--<img src="../imagenes/logoBlanco.ico"
                                             style="border-radius: 50%; max-height: 60px;">
                                         <img src="imagenes/EST.png" width="50%"> -->



                                    </div>
                                    <!--<p class="textoBlanco">
                                        Efectos de Informática comprados por Fundación
                                    </p>-->
                                </div>
                            </a>
                        </div>
                            <div class="col-md-4 <?php if ($_SESSION["proyecto"] != 1) {
                                echo "isDisabled";
                            } ?>">

                            <a href="efectosProyecto.php">
                                <div class="divIndex">
                                    <div>
                                    <h2>
                                        Efectos de Proyectos
                                    </h2>
                                    </div>
                                    <div class="interior-item" style="background: url(../../imagenes/3.jpeg);background-size: cover;">
                                        <!--<img src="../imagenes/logoBlanco.ico"
                                             style="border-radius: 50%; max-height: 60px;">
                                         <img src="imagenes/EST.png" width="50%"> -->



                                    </div>
                                    <!--<p class="textoBlanco">
                                        Efectos de Informática comprados para Proyectos
                                    </p>-->
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <img alt="Sistema de Control de Efectos" src="../imagenes/Logo-EST-vector.png" class="rounded" style="max-width: 350px;">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>
        </div>
    </div>
    </div>
<?php
require_once "vistas/parte_inferior.php";
?>