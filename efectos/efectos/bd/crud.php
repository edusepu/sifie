<?php
include_once '../../../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$NNE = (isset($_POST['NNE'])) ? $_POST['NNE'] : '';
$INE = (isset($_POST['INE'])) ? $_POST['INE'] : '';
$NI = (isset($_POST['NI'])) ? $_POST['NI'] : '';
$dpto = (isset($_POST['dpto'])) ? $_POST['dpto'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO efectos (NNE, INE, NI, dpto, ubicacion) VALUES('$NNE', '$INE', '$NI', '$dpto', '$ubicacion') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, NNE, INE, NI, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre FROM efectos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE efectos SET NNE='$NNE', INE='$INE', NI='$NI', dpto='$dpto', ubicacion='$ubicacion' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, NNE, INE, NI, dpto, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, ubicacion, nombreEquipo, (select descripcion from departamentos where id=dpto) as dptoNombre, usuario as usuariopc, monitor, (SELECT CONCAT(id,' ',marca, ' ',modelo, ' ', tamanio, '') FROM monitores WHERE monitores.id=detallecomputadora.monitor) AS monitorNombre FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "UPDATE efectos SET activo=1 WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id, NNE, INE, NI, dpto, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, ubicacion, nombreEquipo, (select descripcion from departamentos where id=dpto) as dptoNombre, usuario as usuariopc, monitor, (SELECT CONCAT(id,' ',marca, ' ',modelo, ' ', tamanio, '') FROM monitores WHERE monitores.id=detallecomputadora.monitor) AS monitorNombre FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
