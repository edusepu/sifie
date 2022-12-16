<?php
session_start();

if (isset($_SESSION["s_usuario"])) {
} else {
    header("Location: ../../index.php?id=" . $_GET['id']);
}

include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
// Recepción de los datos enviados mediante POST desde el JS
//$consulta = "SELECT * FROM detalleComputadora where idDetalle=" . $id;
$consulta = "SELECT * FROM efectossindetalle WHERE id=" . $id . " and activo=0";
//echo $consulta;
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$existe = 0;
foreach ($data as $datos) {
    $observaciones = $datos['observaciones'];
    $marca = $datos['marca'];
    $modelo = $datos['modelo'];
    $ine = $datos['INE'];
    $nne = $datos['NNE'];
    $ni = $datos['NI'];
    $ubicacion = $datos['ubicacion'];
    $existe = 1;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detalle Efecto</title>
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
                        if ($existe == 0) {
                            echo "<h1>No existe el EFECTO</h1>";
                            exit;
                        }
                        ?>
                        <br>
                        <h3>Detalle Efecto <?php echo "$id"; ?> </h3>
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
                                MARCA
                            </td>
                            <td>
                                <?php echo($marca); ?>
                            </td>
                        </tr>
                        <tr class="table-danger">
                            <td>
                                MODELO
                            </td>
                            <td>
                                <?php echo($modelo); ?>
                            </td>
                        </tr>
                        <tr class="table-success">
                            <td>
                                UBICACIÓN
                            </td>
                            <td>
                                <?php echo($ubicacion); ?>
                            </td>
                        </tr>
                        <tr class="table-active">
                            <td>
                                OBSERVACIONES
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