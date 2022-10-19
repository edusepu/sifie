<?php require_once "vistas/parte_superior.php" ?>
<?php
if($_SESSION["s_usuario"] === null){
    include("sinpermiso.php");
    require_once "vistas/parte_inferior.php";
    echo "<script type='text/javascript' src='js/main.js'></script>";
    exit;
}else{
    $rol=$_SESSION['s_rol'];
} ?>


<!--INICIO del cont principal  -->
<div class="container-fluid">
    <div class="">
        <?php
        $fechaP = date('d-m-Y', $_GET['id']);
        $fecha = date('Y-m-d', $_GET['id']);
        echo "<a class='btn btn-success' href='index.php' role='button'>Volver</a>";
        $date = date('d-m-Y H:i:s', strtotime($fechaP));


        include_once 'bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $consulta = "SELECT * FROM estadoplanilla WHERE id=(SELECT estado FROM registroplanillas where fecha='$fecha' and idPlanilla=1)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row => $link) {
            $estado = $link['id'];
            $estadoDesc = $link['descripcion'];
        }
        ?>
    </div>
    <div class="jumbotron">
        <div class="container">
            <?php echo "<H1 class='display-5' style=''>SERVICIO DE GUARDIA DE LA FECHA $fechaP</H1>";?>
            <hr class="my-4">
            <h3 style=''>REGISTRO DE MOVIMIENTOS DE VEHICULOS OFICIALES</h3>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
                <h4>ESTADO ACTUAL:</h4>
            </div>
            <div class="col-md-6">
                <h4 class="text-success"> <?php echo $estadoDesc; ?></h4>
            </div>
        </div>
        <div class="row">
        </div>

    </div>

    <?php

    $consulta = "SELECT * FROM vehiculos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $vehiculos = array();
    foreach ($data as $row => $link) {
        $vehiculos[$row] = $link['tipo'] . " - " . $link['ni'];

    }
    $consulta = "SELECT id, lugar, horaSalida, horaEntrada, destino, (select tipo from vehiculos where id=vehiculo) as vehiculo, conductor, kmSalida,kmEntrada,observacion FROM movimientosvo where fecha='$fecha'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

    ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if ($estado == $rol) {
                            echo "<button id='btnNuevo' name='btnNuevo' type='button' class='btn btn-primary' data-toggle='modal'>Nuevo</button>";
                        }
                        ?>
                    </div>
                    <div class="col-md-4"></div>

                    <div class="col-md-2">
                        <?php
                        if ($estado == $rol) {
                            echo "<button id='btnCerrar' name='btnCerrar' type='button' class='btn btn-success' data-toggle='modal'>Elevar Planilla</button>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="display compact table-striped table-bordered table-condensed"
                           style="width:100%; line-height: 1;">
                        <thead class="text-center" style="height: 50px;">
                        <tr>
                            <th class="oculto">Id</th>
                            <th>Lugar</th>
                            <th>Salida</th>
                            <th>Entrada</th>
                            <th>Destino</th>
                            <th>Vehículo</th>
                            <th>Conductor</th>
                            <th>KM de Salida</th>
                            <th>KM de Entrada</th>
                            <th>Observaciones</th>


                            <?php
                            //if ($estado == $rol) {
                                echo "<th>Acciones</th>";
                            //} ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $e=0;
                        foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td class="oculto"><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['lugar'] ?></td>
                                <td><?php echo $dat['horaSalida'] ?></td>
                                <td><?php echo $dat['horaEntrada'] ?></td>
                                <td class=""><?php echo $dat['destino'] ?></td>
                                <td class=""><?php echo $dat['vehiculo'] ?></td>
                                <td class=""><?php echo $dat['conductor'] ?></td>
                                <td class=""><?php echo $dat['kmSalida'] ?></td>
                                <td class=""><?php echo $dat['kmEntrada'] ?></td>
                                <td class=""><?php echo $dat['observacion'] ?></td>
                                <?php
                                if ($estado == $rol) {
                                    echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>EDITAR</button><button class='btn btn-danger btnBorrar'>ELIMINAR</button></div></div></td>";
                                }else{
                                    echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-secondary btnEditarD' disabled>EDITAR</button><button class='btn btn-secondary btnBorrarD' disabled>ELIMINAR</button></div></div></td>";
                                }?>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!--modal para ELEVAR PLANILLA-->

    <div class="modal fade" id="modalCerrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formElevar" action="bd/elevar.php" method="post" target="_self">
                    <div class="modal-body">
                        <div class="row oculto">
                            idplanilla:
                            <input id="idPlanilla" name="idPlanilla" type="text" value="1">
                        </div>

                        <div class="row oculto">
                            estado: <input id="estado" name="estado" type="text" value=<?php echo $estado; ?>>
                        </div>
                        <div class="row oculto">fecha:
                            <?php
                            echo "<input type='date' id='fechaElevar' name='fechaElevar' value='" . $fecha . "'
                                max='" . $fecha . "'>";
                            ?>
                        </div>
                            <?php
                            switch ($estado) {
                                case 1:
                                    $opcion=1;
                                    echo "<div class='oculto'> opcion: <input id='opcion' name='opcion' type='text' value=".$opcion."></div>";
                                    echo "<h4>Finalizar carga de la planilla y Elevar al Jefe de Guardia</h4>";
                                    echo "<div class='p-5 border bg-light'><label>Auxiliar: </label>";
                                    echo "<select id='gradoAux' name='gradoAux'><option value='CB'>CB</option><option value='CI'>CI</option><option value='SG'>SG</option></select>";
                                    echo "<input id='aux' name='aux' placeholder='Nombre y Apellido' type='text'></div>";

                                    break;
                                case 2:
                                    $opcion=2;
                                    echo "<div class='oculto'> opcion: <input id='opcion' name='opcion' type='text' value=".$opcion."></div>";
                                    echo "<h4>Elevar al Oficial de Servicio</h4>";
                                    echo "<div class='p-5 border bg-light'><label>Jefe de Guardia:  </label>";
                                    echo "<select id='gradoJ' name='gradoJ'><option value='SG'>SG</option><option value='SI'>SI</option><option value='SA'>SA</option><option value='SP'>SP</option></select>";
                                    echo "<input id='jGu' name='jGu' placeholder='Nombre y Apellido' type='text'></div>";

                                    break;
                                case 3:
                                    echo "<h4>Finalizar Carga de Planilla y Elevar</h4>";

                                    echo "<div class='p-5 border bg-light'><label for='opcion' class='col-form-label'>ELEVAR A:</label>";
                                    echo "<select class='' id='opcion' name='opcion'>";
                                    echo "<option value=3>JEFE DPTO APOYO</option>";
                                    echo "<option value=4>VICEDECANO</option>";
                                    echo "<option value=5>DECANO</option>";
                                    echo "</select>";
                                    echo "</div><div class='p-5 border bg-light'>";

                                    echo "<label>Oficial de Servicio:  </label>";
                                    echo "<select id='gradoOf' name='gradoOf'><option value='TT'>TT</option><option value='TP'>TP</option><option value='CT'>CT</option></select>";
                                    echo "<input id='ofSer' name='ofSer' placeholder='Nombre y Apellido' type='text'></div>";

                                    break;
//                                case 4:
//                                    echo "<label for='opcion' class='col-form-label'>ELEVAR A:</label>";
//                                    echo "<select class='form-control' id='opcion' name='opcion'>";
//                                    echo "<option value=4>VICEDECANO</option>";
//                                    echo "<option value=5>DECANO</option>";
//
//
//                                    echo "</select>";
//                                case 5:
//                                case 6:
//                                    $opcion=4;
//                                    echo "opcion: <input id='opcion' name='opcion' type='text' value=".$opcion.">";
//                                    echo "<h3>Aprobado</h3>";
//                                    break;
                            }


                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnElevar" class="btn btn-success">Elevar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPersonas" class="needs-validation">
                    <div class="modal-body">
                        <div class="form-group oculto">
                            <?php //$fecha = date('Y-m-d', time());echo $fecha;
?>
                            <label for="fecha1" class="col-form-label">Fecha:</label>
                            <input type="text" class="form-control" id="fecha1" name="fecha1" value="<?php echo $fechaP;?>">

                        </div>
                        <div class="form-group">
                            <label for="lugar" class="col-form-label">Lugar de Presentación:</label>
                            <input type="text" class="form-control" id="lugar" name="lugar" required>
                        </div>
                        <div class="form-group">
                            <label for="salida" class="col-form-label">Hora de Salida:</label>
                            <input type="time" class="form-control" id="salida" required>
                        </div>
                        <div class="form-group">
                            <label for="entrada" class="col-form-label">Hora de Entrada:</label>
                            <input type="time" class="form-control" id="entrada" required>
                        </div>
                        <div class="form-group">
                            <label for="destino" class="col-form-label">Destino:</label>
                            <input type="text" class="form-control" id="destino">
                        </div>

                        <div class="form-group">
                            <label for="vehiculo" class="col-form-label">Vehículo:</label>
                            <select class="form-control" id="vehiculo" name="vehiculo">
                                <?php
                                $i = 1;
                                foreach ($vehiculos as $valor) {
                                    echo "<option value='$i'>$valor</option>";
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="conductor" class="col-form-label">Conductor:</label>
                            <input type="text" class="form-control" id="conductor">
                        </div>
                        <div class="form-group">
                            <label for="kmsalida" class="col-form-label">KM de Salida:</label>
                            <input type="number" class="form-control" id="kmsalida">
                        </div>
                        <div class="form-group">
                            <label for="kmentrada" class="col-form-label">KM de Entrada:</label>
                            <input type="number" class="form-control" id="kmentrada">
                        </div>
                        <div class="form-group">
                            <label for="obs" class="col-form-label">Observación:</label>
                            <input type="text" class="form-control" name="obs" id="obs">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal para Detalle-->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2"></h5>
                    <a id="detalle" href="" target="_blank"
                       class="detalle sidebar-brand d-flex align-items-center justify-content-center">
                        <!--  <div class="sidebar-brand-icon rotate-n-15">-->
                        <div>
                            <img class="detalle" style=" height: 50px;" src="img/ver-detalles.png">
                        </div>
                        <!--<div class="sidebar-brand-text mx-3">Logo_FIE_hor</div>-->
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formDetalle" class="form-basic">
                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Nombre de Equipo</span></label>
                            <input type="text" name="nombreEquipo" id="nombreEquipo">
                        </div>

                    </div>
                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Microprocesador</span>
                            </label>
                            <select class="select" id="tipoMicro">
                                <option value="1">AMD</option>
                                <option value="2">Intel</option>
                            </select>
                            <input type="text" id="micro" name="micro" required>
                        </div>

                    </div>

                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Memoria RAM</span></label>
                            <input style="width:90px" type="number" name="ram" id="ram" required> GB
                        </div>

                    </div>

                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Disco Rígido</span>
                            </label>
                            <select class="select" id="tipoDisco">
                                <option value="1">HDD</option>
                                <option value="2">SSD</option>
                            </select>
                            <input style="width:90px" type="number" id="disco" name="disco" required>
                            <select class="select" id="capacidadDisco">
                                <option value="1">GB</option>
                                <option value="2">TB</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Sistema Operativo</span></label>
                            <input type="text" name="so" id="so">
                        </div>

                    </div>

                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <label>
                            <span style="color: #858796;">Observaciones</span>
                            <textarea name="obs" id="obs"></textarea>
                        </label>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardarDetalle" class="btn btn-dark">Guardar</button>
                    </div>


                </form>
            </div>
        </div>
    </div>


    <!--Modal para QR-->
    <div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formQR">
                    <div class="modal-body">
                        <div class='result'>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>
<script type="text/javascript" src="js/1.js"></script>

