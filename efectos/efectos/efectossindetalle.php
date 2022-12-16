<?php require_once "vistas/parte_superior.php" ?>
<?php
if ($_SESSION["cargos"] != 1) {
    include("sinpermiso.php");
    require_once "vistas/parte_inferior.php";
    echo "<script type='text/javascript' src='js/main.js'></script>";
    exit;
} ?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Efectos</h1>
    <?php
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT * FROM departamentos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $dptos = array();
    foreach ($data as $row => $link) {
        $dptos[$row] = $link['descripcion'];
    }
    //$consulta = "SELECT * FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE efectos.activo=0";
    $consulta = "SELECT id,NNE,INE,NI,nroProntuario,dpto,ubicacion,marca,modelo,observaciones, activo, (select descripcion from departamentos where id=dpto) as dptoNombre
FROM efectossindetalle WHERE activo=0;";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $domain = getenv('USERDOMAIN');
    $user = shell_exec("echo %username%");

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2 oculto" style="text-align: center;">

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
                <div class="table-responsive" >
                    <table  id="tablaPersonas" class="display compact table-striped table-bordered table-condensed"
                           style="width:100%; line-height: 1;">
                        <thead class="text-center" style="height: 50px;">
                        <tr>
                            <th>Id</th>
                            <th>NNE</th>
                            <th>INE</th>
                            <th>NI</th>
                            <th class="oculto">Departamento</th>
                            <th class="oculto">observaciones</th>
                            <th class="">Ubicación</th>
                            <th class="">Departamento</th>
                            <th class="">Marca</th>
                            <th class="">Modelo</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['NNE'] ?></td>
                                <td><?php echo $dat['INE'] ?></td>
                                <td><?php echo $dat['NI'] ?></td>
                                <td class="oculto"><?php echo $dat['dpto'] ?></td>
                                <td class="oculto"><?php echo $dat['observaciones'] ?></td>
                                <td class=""><?php echo $dat['ubicacion'] ?></td>
                                <td class=""><?php echo $dat['dptoNombre'] ?></td>
                                <td class=""><?php echo $dat['marca'] ?></td>
                                <td class=""><?php echo $dat['modelo'] ?></td>

                                <?php
                                if ($_SESSION["s_rol"] == 1) {
                                    echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-dark btnQR' style=''>QR</button><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div></td>";
                                }else{
                                    echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-dark btnQR' style=''>QR</button></div></div></td>";
                                    echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-dark btnQR' style=''>QR</button></div></div></td>";

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
                    <input type="hidden" name="cual" value="sindetalle">

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
                            <label for="ubicacion" class="col-form-label">Ubicación:</label>
                            <input type="text" class="form-control" name="ubicacion" id="ubicacion">
                        </div>
                        <div class="form-group">
                            <label for="marca" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" name="marca" id="marca">
                        </div>
                        <div class="form-group">
                            <label for="modelo" class="col-form-label">Modelo:</label>
                            <input type="text" class="form-control" name="modelo" id="modelo">
                        </div>
                        <div class="form-group">
                            <label for="observacion" class="col-form-label">Observaciones:</label>
                            <textarea class="form-control" name="observacion" id="observacion"></textarea>
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
<script type="text/javascript" src="js/mainsindetalle.js"></script>