<?php require_once "vistas/parte_superior.php" ?>
<?php
if($_SESSION["s_rol"] != 1){
include("sinpermiso.php");
    require_once "vistas/parte_inferior.php";
    echo "<script type='text/javascript' src='js/main.js'></script>";
    exit;
}
?>
<!--INICIO del cont principal-->
<div class="container">
    <h1>Usuarios</h1>

    <?php
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT * FROM roles";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $roles = array();
    foreach ($data as $row => $link) {
        $roles[$row] = $link['descripcion'];

    }

    $consulta = "SELECT * FROM departamentos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $dptos= array();
    foreach ($data as $row => $link) {
        $dptos[$row] = $link['descripcion'];

    }
    $consulta = "SELECT * FROM usuarios WHERE activo=1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
      $domain = getenv('USERDOMAIN');
    $user= shell_exec("echo %username%");
    ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    //if($_SESSION["s_rol"] == 1){
                        echo "<button id='btnNuevo' name='btnNuevo' type='button' class='btn btn-success' data-toggle='modal'>Nuevo</button>";
                    //}
                ?>

            </div>

        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="display compact table-striped table-bordered table-condensed" style="width:100%; line-height: 1;">
                        <thead class="text-center" style="height: 50px;">
                            <tr>
                                <th>Id</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th class="oculto">Tipo Desc</th>
                                <th>Departamento</th>
                                <th class="oculto">Departamento Desc</th>
                                <th>Cargos</th>
                                <th>Efectos Fundación</th>
                                <th>Efectos por Proyecto</th>
                                <?php
                                if($_SESSION["s_rol"] == 1){
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
                                    <td><?php echo $dat['usuario'] ?></td>
                                    <td class="oculto"><?php echo $dat['tipo'] ?></td>
                                    <td><?php echo $roles[$dat['tipo']-1] ?></td>
                                    <td class="oculto"><?php echo $dat['departamento'] ?></td>
                                    <td><?php echo $dptos[$dat['departamento']-1] ?></td>
                                    <td style='text-align:center;'><div class="oculto"><?php echo $dat['cargos'].'</div>';if($dat['cargos']==1){echo "<img style='height: 30px;' src='img/check.png'>";
                                        }else{echo "<img style='height: 30px;' src='img/cross.png'>";}?></td>
                                    <td style='text-align:center;'><div class="oculto"><?php echo $dat['fundacion'].'</div>';if($dat['fundacion']==1){echo "<img style='height: 30px;' src='img/check.png'>";
                                        }else{echo "<img style='height: 30px;' src='img/cross.png'>";}?></td>
                                    <td style='text-align:center;'><div class="oculto"><?php echo $dat['proyecto'].'</div>';if($dat['proyecto']==1){echo "<img style='height: 30px;' src='img/check.png'>";
                                        }else{echo "<img style='height: 30px;' src='img/cross.png'>";}?></td>
                                    <?php
                                    if($_SESSION["s_rol"] == 1){
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
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPersonas">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Usuario" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="form-group">
                            <label for="tipo" class="col-form-label">Tipo:</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value=1>Administrador</option>
                                <option value=2>Jefe</option>
                                <option value=3>Solo Lectura</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dpto" class="col-form-label">Departamento:</label>
                            <select class="form-control" id="departamento" name="departamento">
                            <?php
                                $i=1;
                                foreach ($dptos as $valor) {
                                      echo "<option value='$i'>$valor</option>";
                                      $i++;
                                  }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="permisos" class="col-form-label">Permisos:</label>
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        Cargos
                                        <input type="checkbox" class="checkmark customcheck" id="cargos" name="cargos" checked="">
                                    </div>
                                    <div class="col-4">
                                        Fundación
                                        <input type="checkbox" class="checkmark customcheck"  name="fundacion" id="fundacion">
                                    </div>
                                    <div class="col-4">
                                        Proyecto
                                            <input type="checkbox" class="checkmark customcheck"  name="proyecto" id="proyecto">
                                    </div>

                                </div>
                            </div>
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
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2"></h5>
                    <a id="detalle" href="" target="_blank" class="detalle sidebar-brand d-flex align-items-center justify-content-center">
       <!--  <div class="sidebar-brand-icon rotate-n-15">-->
       <div>
        <img class="detalle" style=" height: 50px;" src="img/ver-detalles.png">
        </div>
        <!--<div class="sidebar-brand-text mx-3">Logo_FIE_hor</div>-->
      </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formDetalle" class="form-basic">
                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Microprocesador</span>
                            </label>
                            <select class="select" id="tipoMicro">
                                <option value="1">AMD</option>
                                <option value="2">Intel</option>
                            </select>
                            <input type="text" id="micro" name="micro">
                        </div>

                    </div>

                    <div class="form-row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-12 d-inline">
                            <label>
                                <span>Memoria RAM</span></label>
                            <input style="width:90px" type="number" name="ram" id="ram"> GB
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
                            <input style="width:90px" type="number" id="disco" name="disco">
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
    <div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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
<script type="text/javascript" src="js/mainAdmin.js"></script>

