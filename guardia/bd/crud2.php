<?php
include_once '../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$grado = (isset($_POST['grado'])) ? $_POST['grado'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$dominio = (isset($_POST['dominio'])) ? $_POST['dominio'] : '';
$ingreso = (isset($_POST['ingreso'])) ? $_POST['ingreso'] : '';
$egreso = (isset($_POST['egreso'])) ? $_POST['egreso'] : '';
$visito = (isset($_POST['visito'])) ? $_POST['visito'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
$oldDate = strtotime($_POST['fecha']);
$fecha = date('Y-m-d',$oldDate);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
//$opcion = 1;
switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO persajeno (grado, nombre, dni, marca, dominio, ingreso, egreso,visito,obs, fecha) VALUES('$grado', '$nombre', '$dni', '$marca', '$dominio', '$ingreso', '$egreso', '$visito', '$obs', '$fecha') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, grado, nombre, dni, marca, dominio, ingreso, egreso,visito,obs FROM persajeno ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE persajeno SET grado='$grado', nombre='$nombre', dni='$dni', marca='$marca', dominio='$dominio', ingreso='$ingreso', egreso='$egreso',  visito='$visito', obs='$obs' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, grado, nombre, dni, marca, dominio, ingreso, egreso,visito,obs FROM persajeno  WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "DELETE FROM persajeno WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
//        $consulta = "SELECT id, lugar, horaSalida, horaEntrada, destino, (select tipo from vehiculos where id=vehiculo) as vehiculo, conductor, kmSalida,kmEntrada,observacion FROM movimientosvo WHERE id='$id'";
//        $resultado = $conexion->prepare($consulta);
//        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
