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
//var_dump($_POST);
if(isset($_POST['fechaP'])){
   // echo "hay post";
    $fechaP = $_POST['fechaP'];
    $fecha = $_POST['fechaP'];
}else{
   // echo "no hay";
}

$fechaformateada=date('d-m-Y', strtotime($fechaP));

?>


<!--INICIO del cont principal-->
<div class="container-fluid" style="padding-bottom:1rem;background: #F8F9FC;width: 90%">

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
    $hoy = date('Y-m-d', time());
    //echo $hoy;
    ?>
    <div class="jumbotron" style="padding: 1rem 1rem; background: #F8F9FC;">
        <div class="container shadow-lg p-3 mb-5 bg-body rounded">
            <?php echo "<H1 class='display-5' style=''>SERVICIO DE GUARDIA DE FECHA $fechaformateada</H1>"; ?>
            <hr class="my-4">
        </div>
    </div>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">

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



                            <input type="date" id="fechaP" name="fechaP" max="<?php echo $hoy;?>" value="<?php echo $fechaP;?>">
                        <?php
                          //  echo $fechaP."////";
                          //  echo strtotime($fechaP);
                            $date = date('d-m-Y H:i:s', strtotime($fechaP));
                         //   echo $date;
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

