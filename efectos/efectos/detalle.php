<?php
session_start();

if (isset($_SESSION["s_usuario"])) {
   // $_SESSION["url"] = 100;
    //var_dump($_GET);
    //  echo "session";
//echo "<br>id: ".$_GET['id'];
    // $_SESSION["s_usuario"]="s";
    //header("Location: ../index.php?id=".$_GET['id']);
} else {
    //   var_dump($_GET);
    header("Location: ../index.php?id=" . $_GET['id']);
    //   echo "no session";
}


include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
// Recepción de los datos enviados mediante POST desde el JS   
//$consulta = "SELECT * FROM detalleComputadora where idDetalle=" . $id;
$consulta = "SELECT * FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle LEFT JOIN monitores ON monitores.id=detallecomputadora.monitor WHERE efectos.id=" . $id." and efectos.activo=0";
//echo $consulta;
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$existe=0;
foreach ($data as $datos) {
    //echo $datos['sistemaOperativo'] . '<br>';

    if ($datos['tipoDisco'] == 1) {
        $tipoDisco = "HDD";
    } else {
        $tipoDisco = "SSD";
    }
    if ($datos['medidaCapacidad'] == 1) {
        $medidaCapacidad = "GB";
    } else {
        $medidaCapacidad = "TB";
    }
    $disco = $tipoDisco . " " . $datos['capacidadDisco'] . " " . $medidaCapacidad;
    if ($datos['marcaProcesador'] == 1) {
        $tipoMicro = "AMD";
    } else {
        $tipoMicro = "Intel";
    }
    $micro = $tipoMicro . " " . $datos['procesador'];
    $ram = $datos['ram'];
    $sistemaOperativo = $datos['sistemaOperativo'];
    $observaciones = $datos['observaciones'];
    $ine = $datos['INE'];
    $nne = $datos['NNE'];
    $ni = $datos['NI'];
    $nombreEquipo = $datos['nombreEquipo'];
    $usuario = $datos['usuario'];
    $monitor = $datos['marca']." ".$datos['modelo']." ".$datos['tamanio']."''";

    $existe=1;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detalle PC</title>
    <link rel="shortcut icon" href="../imagenes/icono.ico">
    <meta name="description" content="">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div style="text-align: center">
                        <?php
                        if($existe==0){
                            echo "<h1>No existe el EFECTO</h1>";
                            exit;
                        }
                        ?>
                        <br>

                        <h3>Detalle Efecto <?php echo "$id";?> </h3>
                        <br>
                    </div>
                        <table class="table">
                        <thead>
                        <tr>
                                <h5>NNE: <?php echo($nne); ?></h5>
                                <h5>INE: <?php echo($ine); ?></h5>
                                <h5>NI: <?php echo($ni); ?></h5>
                        </tr>
                        <br>
                        </thead>
                        <tbody>
                        <tr class="table-success">
                            <td>
                                Nombre de Equipo
                            </td>
                            <td>
                                <?php echo($nombreEquipo); ?>
                            </td>

                        </tr>
                        <tr class="table-warning">
                            <td>
                                Usuario
                            </td>
                            <td>
                                <?php echo($usuario); ?>
                            </td>

                        </tr>
                        <tr class="table-danger">
                            <td>
                                Microprocesador
                            </td>
                            <td>
                                <?php echo($micro); ?>
                            </td>

                        </tr>
                        <tr class="table-active">
                            <td>
                                Memoria RAM
                            </td>
                            <td>
                                <?php echo($ram); ?> GB
                            </td>

                        </tr>
                        <tr class="table-success">
                            <td>
                                Disco Rígido
                            </td>
                            <td>
                                <?php echo($disco); ?>
                            </td>

                        </tr>
                        <tr class="table-warning">
                            <td>
                                Sistema Operativo
                            </td>
                            <td>
                                <?php echo($sistemaOperativo); ?>
                            </td>

                        </tr>
                        <tr class="table-active">
                            <td>
                                Monitor
                            </td>
                            <td>
                                <?php echo($monitor); ?>
                            </td>

                        </tr>
                        <tr class="table-danger">
                            <td>
                                Observaciones
                            </td>
                            <td>
                                <?php echo($observaciones); ?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>