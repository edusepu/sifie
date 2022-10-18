<?php require_once "vistas/parte_superior.php" ?>
<?php
/*if ($_SESSION["cargos"] != 1) {
    include("sinpermiso.php");
    require_once "vistas/parte_inferior.php";
    echo "<script type='text/javascript' src='js/main.js'></script>";
    exit;
}*/
include("bd/crearPlanillas.php");


date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('Y-m-d', time());
$fechaP = date('Y-m-d', time());
var_dump($_POST);
if(isset($_POST['fechaP'])){
    echo "hay post";
    $fechaP = $_POST['fechaP'];
    $fecha = $_POST['fechaP'];
}else{
    echo "no hay";
}

$fechaformateada=date('d-m-Y', strtotime($fechaP));
echo "<h2>SERVICIO DE GUARDIA DE FECHA $fechaformateada</h2>";
?>


<!--INICIO del cont principal-->
<div class="container">
    <h1></h1>
    <?php
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();



    /*$consulta = "SELECT * FROM departamentos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $dptos = array();
    foreach ($data as $row => $link) {
        $dptos[$row] = $link['descripcion'];

    }*/
    //$consulta = "SELECT * FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE efectos.activo=0";
    $consulta = "SELECT id, descripcion, (select estado from registroplanillas where idPlanilla=id and fecha='$fecha') as estado from planillas;";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    //echo 'Propietario script actual: ' . get_current_user();

    //  echo gethostbyaddr($_SERVER['REMOTE_ADDR']);

    $consulta = "SELECT * from estadoplanilla;";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $estados = $resultado->fetchAll(PDO::FETCH_ASSOC);
    //$estados=array($estadosA);
    //foreach ($estadosA as $est) {
//var_dump($estados);
//echo $estados[0][0];
    //}

    $domain = getenv('USERDOMAIN');
    //  echo "usu  dominio: ".$domain;
    $user = shell_exec("echo %username%");
    // echo "<br>user : $user";

    ?>


    <div class="container">
        <div class="row">

        </div>
    </div>
    <br>
    <div class="container">
        <form id="formFecha" class="" action="index.php" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">



                            <input type="date" id="fechaP" name="fechaP" value="<?php echo $fechaP;?>">
                        <?php
                            echo $fechaP."////";
                            echo strtotime($fechaP);
                            $date = date('d-m-Y H:i:s', strtotime($fechaP));
                            echo $date;
                        ?>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2" style="text-align: center;">

                        <div class="">
                            <label>
                            </label>
                        </div>
                        <div class="">


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="display compact table-striped table-bordered table-condensed"
                           style="width:100%; line-height: 1;">
                        <thead class="text-center" style="height: 50px;">
                        <tr>
                            <th>Id</th>
                            <th>Planilla</th>
                            <th>ESTADO</th>
                            <th> </th>

<!--                            <th class="">acciones</th>-->


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['descripcion'] ?></td>

                                <td><?php
                                    foreach ($estados as $estado) {
                                        if ($estado['id']==$dat['estado']) {
                                            echo $estado['descripcion'];

                                        }
                                    }
                                    ?></td>
                                <td><?php

                                    echo "<a class='btn btn-primary' href='".$dat['id'].".php?id=".strtotime($fechaP)."' role='button'>Confeccionar</a>";

                                   // echo $dat['estado'] ?></td>

                                <?php
                               // if ($_SESSION["s_rol"] == 1) {
                             //       echo "<td></td>";
                                //}
                        ?>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </form>

    </div>


    <!--modal para imprimir Qrs-->
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
                <form id="formQR" action="generarqr.php" method="post" target="_blank">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="desde" class="col-form-label">Desde el ID:</label>
                            <input type="number" class="" id="desde" name="desde" placeholder="Desde" required>
                        </div>
                        <div class="form-group">
                            <label for="hasta" class="col-form-label">Hasta el ID:</label>
                            <input type="number" class="" id="hasta" name="hasta" placeholder="Hasta" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnCrearPdf" class="btn btn-dark">Imprimir</button>
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
                        <div class="form-group">
                            <label for="NNE" class="col-form-label">NNE:</label>
                            <input type="text" class="form-control" id="NNE" name="NNE" required>
                        </div>
                        <div class="form-group">
                            <label for="INE" class="col-form-label">INE:</label>
                            <input type="text" class="form-control" id="INE" required>
                        </div>
                        <div class="form-group">
                            <label for="NI" class="col-form-label">NI:</label>
                            <input type="text" class="form-control" id="NI">
                        </div>
                        <div class="form-group">
                            <label for="dpto" class="col-form-label">Departamento:</label>
                            <select class="form-control" id="dpto" name="dpto">
                                <?php
                                $i = 1;
                                foreach ($dptos as $valor) {
                                    echo "<option value='$i'>$valor</option>";
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ubi" class="col-form-label">Ubicación:</label>
                            <input type="text" class="form-control" name="ubi" id="ubi">
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
<script>
    var form = document.getElementById("formFecha");

    document.getElementById("fechaP").addEventListener("change", function () {
        form.submit();
    });
</script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>
<script type="text/javascript" src="js/main.js"></script>

