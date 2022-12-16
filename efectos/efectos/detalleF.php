<?php
session_start();
if(isset($_SESSION["s_usuario"])){
    $_SESSION["url"]=100;
    }else{
     header("Location: ../index.php?id=".$_GET['id']);
}


include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
// Recepción de los datos enviados mediante POST desde el JS
$consulta = "SELECT * FROM fundacion LEFT JOIN detalleFundacion ON fundacion.id=detalleFundacion.idDetalle WHERE fundacion.id=" . $id." and fundacion.activo=0";
//$consulta = "SELECT * FROM detalleFundacion where idDetalle=". $id." and activo=0";
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
    $nombreEquipo = $datos['elemento'];
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
						<table class="table">
							<thead>
								<tr>
									<th>

									</th>
									<th>
                                        <?php
                                            if($existe==0){
                                            echo "<h1>No existe el EFECTO</h1>";
                                            exit;
                                        }
                                        ?>
										<h1>Detalle PC</h1>
										<h5>ID: <?php echo "$id ($nombreEquipo)"; ?></h5>
									</th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										Microprocesador
									</td>
									<td>
										<?php echo ($micro); ?>
									</td>

								</tr>
								<tr class="table-active">
									<td>
										Memoria RAM
									</td>
									<td>
										<?php echo ($ram); ?> GB
									</td>

								</tr>
								<tr class="table-success">
									<td>
										Disco Rígido
									</td>
									<td>
										<?php echo ($disco); ?>
									</td>

								</tr>
								<tr class="table-warning">
									<td>
										Sistema Operativo
									</td>
									<td>
										<?php echo ($sistemaOperativo); ?>
									</td>

								</tr>
								<tr class="table-danger">
									<td>
										Observaciones
									</td>
									<td>
										<?php echo ($observaciones); ?>
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