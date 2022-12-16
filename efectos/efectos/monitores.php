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
    <h1>Monitores</h1>
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
    $consulta = "SELECT * FROM origen";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $origen = array();
    foreach ($data as $row => $link) {
        $origen[$row] = $link['descripcion'];
    }

    //$consulta = "SELECT * FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE efectos.activo=0";
    $consulta = "SELECT monitores.*, (select descripcion from origen where monitores.origen =origen.id) as origenNombre FROM monitores WHERE activo=0;";
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
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Tamaño</th>
                            <th class="oculto">origen</th>
                            <th class="">Origen</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['marca'] ?></td>
                                <td><?php echo $dat['modelo'] ?></td>
                                <td><?php echo $dat['tamanio'] ?></td>
                                <td class="oculto"><?php echo $dat['origen'] ?></td>
                                <td class=""><?php echo $dat['origenNombre'] ?></td>
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
                <form id="formQR" action="generarqrm.php" method="post" target="_blank">
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
                            <label for="marca" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo" class="col-form-label">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" required>
                        </div>
                        <div class="form-group">
                            <label for="tamanio" class="col-form-label">Tamaño:</label>
                            <input type="number" class="form-control" id="tamanio">
                        </div>
                        <div class="form-group">
                            <label for="origen" class="col-form-label">Origen:</label>
                            <select class="form-control" id="origen" name="origen">
                                <?php
                                $i = 1;
                                foreach ($origen as $valor) {
                                    echo "<option value='$i'>$valor</option>";
                                    $i++;
                                }
                                ?>
                            </select>
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
<script type="text/javascript" src="js/mainmonitores.js"></script>