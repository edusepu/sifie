<?php
include_once '../../../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$elemento = (isset($_POST['elemento'])) ? $_POST['elemento'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$dpto = (isset($_POST['dpto'])) ? $_POST['dpto'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
//$observacion = (isset($_POST['observacion'])) ? $_POST['observacion'] : '';
$proyecto = (isset($_POST['proyecto'])) ? $_POST['proyecto'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO fundacion (elemento, descripcion, dpto, ubicacion, proyecto) VALUES('$elemento', '$descripcion', '$dpto', '$ubicacion', '$proyecto') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

       // $consulta = "SELECT * FROM fundacion ORDER BY id DESC LIMIT 1";
        $consulta = "SELECT id, elemento, descripcion, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre FROM fundacion ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE fundacion SET elemento='$elemento', descripcion='$descripcion', ubicacion='$ubicacion', dpto='$dpto' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, elemento, descripcion, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre, nombreEquipo, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, usuario as usuariopc, monitor, (SELECT CONCAT(id,' ',marca, ' ',modelo, ' ', tamanio, '') FROM monitores WHERE monitores.id=detallefundacion.monitor) AS monitorNombre FROM fundacion LEFT JOIN detalleFundacion ON fundacion.id=detalleFundacion.idDetalle WHERE id='$id' ";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "UPDATE fundacion SET activo=1 WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id, elemento, descripcion, dpto, ubicacion FROM fundacion LEFT JOIN detalleFundacion ON fundacion.id=detalleFundacion.idDetalle WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
