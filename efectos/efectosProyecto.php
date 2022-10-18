<?php require_once "vistas/parte_superior.php" ?>
<?php
if ($_SESSION["proyecto"] != 1) {
    include("sinpermiso.php");
    require_once "vistas/parte_inferior.php";
    echo "<script type='text/javascript' src='js/main.js'></script>";
    exit;
}
?>
<!--INICIO del cont principal-->
<div class="container">
    <h1>Efectos de Fundación POR PROYECTO</h1>
    <?php
  //  include_once 'bdF/conexion.php';
    include_once '../bd/conexion.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT * FROM departamentos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    /* $dptos= array();
     foreach ($data as $row => $link) {
         $dptos[$row] = $link['descripcion'];

     }*/
    $consulta = "SELECT * FROM fundacion LEFT JOIN detalleFundacion ON fundacion.id=detalleFundacion.idDetalle WHERE fundacion.activo=0 and fundacion.proyecto=1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    //echo 'Propietario script actual: ' . get_current_user();

    // echo gethostbyaddr($_SERVER['REMOTE_ADDR']);


    $domain = getenv('USERDOMAIN');
    //  echo "usu  dominio: ".$domain;
    $user = shell_exec("echo %username%");
    //  echo "<br>user : $user";

    ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if ($_SESSION["s_rol"] == 1) {
                            echo "<button id='btnNuevo' name='btnNuevo' type='button' class='btn btn-success' data-toggle='modal'>Nuevo</button>";
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2" style="text-align: center;">

                        <div class="">
                            <label>Imprimir Etiquetas
                            </label>
                        </div>
                        <div class="">
                            <img id='btnQR' data-toggle='modal' class="detalle" style=" height: 50px; cursor: pointer;" src="img/qr.png"
                                 href="">
                        </div>
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
                    <table id="tablaFundacion" class="display compact table-striped table-bordered table-condensed"
                           style="width:100%; line-height: 1;">
                        <thead class="text-center" style="height: 50px;">
                        <tr>
                            <th>Id</th>
                            <th>NOMBRE DE EQUIPO</th>
                            <th>DESCRIPCIÓN</th>
                            <th class="oculto">DEPARTAMENTO</th>
                            <th>UBICACIÓN</th>
                            <th class="oculto">idDetalle</th>
                            <th class="oculto">marcaProcesador</th>
                            <th class="oculto">procesador</th>
                            <th class="oculto">ram</th>
                            <th class="oculto">tipoDisco</th>
                            <th class="oculto">capacidadDisco</th>
                            <th class="oculto">medidaCapacidad</th>
                            <th class="oculto">sistemaOperativo</th>
                            <th class="oculto">observaciones</th>
                            <th class="oculto">observacion</th>

                            <?php
                            if ($_SESSION["s_rol"] == 1) {
                                echo "<th>Acciones</th>";
                            } ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['elemento'] ?></td>
                                <td><?php echo $dat['descripcion'] ?></td>
                                <td class="oculto"><?php echo $dat['dpto'] ?></td>
                                <td><?php echo $dat['ubicacion'] ?></td>
                                <td class="oculto"><?php echo $dat['idDetalle'] ?></td>
                                <td class="oculto"><?php echo $dat['marcaProcesador'] ?></td>
                                <td class="oculto"><?php echo $dat['procesador'] ?></td>
                                <td class="oculto"><?php echo $dat['ram'] ?></td>
                                <td class="oculto"><?php echo $dat['tipoDisco'] ?></td>
                                <td class="oculto"><?php echo $dat['capacidadDisco'] ?></td>
                                <td class="oculto"><?php echo $dat['medidaCapacidad'] ?></td>
                                <td class="oculto"><?php echo $dat['sistemaOperativo'] ?></td>
                                <td class="oculto"><?php echo $dat['observaciones'] ?></td>
                                <td class="oculto"><?php echo $dat['observacion'] ?></td>

                                <?php
                                if ($_SESSION["s_rol"] == 1) {
                                    echo "<td></td>";
                                } ?>

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
                <form id="formPersonas">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="elemento" class="col-form-label">Nombre de Equipo:</label>
                            <input type="text" class="form-control" id="elemento" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" required>
                        </div>
                        <!--<div class="form-group">
                            <label for="dpto" class="col-form-label">Departamento:</label>
                            <select class="form-control" id="dpto" name="dpto">
                                <?php
                        /*$i=1;
                        foreach ($dptos as $valor) {
                            echo "<option value='$i'>$valor</option>";
                            $i++;
                        }*/
                        ?>
                            </select>                        </div>-->
                        <div class="form-group">
                            <label for="ubicacion" class="col-form-label">Ubicación:</label>
                            <input type="text" class="form-control" id="ubicacion">
                        </div>
                        <div class="form-group">
                            <label for="observacion" class="col-form-label">Observaciones:</label>
                            <input type="text" class="form-control" id="observacion">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="proyecto" value="1">
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
                <form id="formQR" action="generarqrF.php" method="post" target="_blank">
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
<?php require_once "vistas/parte_inferior.php" ?> <!-- código propio JS -->

<script type="text/javascript" src="js/mainFundacion.js"></script>