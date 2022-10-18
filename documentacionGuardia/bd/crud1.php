<?php
include_once '../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$lugar = (isset($_POST['lugar'])) ? $_POST['lugar'] : '';
$salida = (isset($_POST['salida'])) ? $_POST['salida'] : '';
$entrada = (isset($_POST['entrada'])) ? $_POST['entrada'] : '';
$destino = (isset($_POST['destino'])) ? $_POST['destino'] : '';
$vehiculo = (isset($_POST['vehiculo'])) ? $_POST['vehiculo'] : '';
$conductor = (isset($_POST['conductor'])) ? $_POST['conductor'] : '';
$kmsalida = (isset($_POST['kmsalida'])) ? $_POST['kmsalida'] : '';
$kmentrada = (isset($_POST['kmentrada'])) ? $_POST['kmentrada'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
//date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('Y-m-d', time());

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO movimientosvo (lugar, horaSalida, horaEntrada, destino, vehiculo, conductor, kmSalida,kmEntrada,observacion, fecha) VALUES('$lugar', '$salida', '$entrada', '$destino', '$vehiculo', '$conductor', '$kmsalida', '$kmentrada', '$obs', '$fecha') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, lugar, horaSalida, horaEntrada, destino, (select tipo from vehiculos where id=vehiculo) as vehiculo, conductor, kmSalida,kmEntrada,observacion FROM movimientosvo ORDER BY id DESC LIMIT 1";
       // $consulta = "SELECT * FROM movimientosvo ORDER BY id DESC LIMIT 1";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE movimientosvo SET lugar='$lugar', horaSalida='$salida', horaEntrada='$entrada', destino='$destino', vehiculo='$vehiculo', conductor='$conductor', kmSalida='$kmsalida',  kmEntrada='$kmentrada', observacion='$obs' WHERE id='$id' ";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, lugar, horaSalida, horaEntrada, destino, (select tipo from vehiculos where id=vehiculo) as vehiculo, conductor, kmSalida,kmEntrada,observacion FROM movimientosvo WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "DELETE FROM movimientosvo WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
//        $consulta = "SELECT id, NNE, INE, NI, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE id='$id' ";
//        $resultado = $conexion->prepare($consulta);
//        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
