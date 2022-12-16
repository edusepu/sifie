<?php
include_once '../../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$NNE = (isset($_POST['NNE'])) ? $_POST['NNE'] : '';
$INE = (isset($_POST['INE'])) ? $_POST['INE'] : '';
$NI = (isset($_POST['NI'])) ? $_POST['NI'] : '';
$dpto = (isset($_POST['dpto'])) ? $_POST['dpto'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$observacion = (isset($_POST['observacion'])) ? $_POST['observacion'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO efectossindetalle (NNE, INE, NI, dpto, ubicacion,marca,modelo,observaciones) VALUES('$NNE', '$INE', '$NI', '$dpto', '$ubicacion', '$marca', '$modelo', '$observacion') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, NNE, INE, NI, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre, marca, modelo, observaciones FROM efectossindetalle ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE efectossindetalle SET NNE='$NNE', INE='$INE', NI='$NI', dpto='$dpto', ubicacion='$ubicacion', marca='$marca', modelo='$modelo', observaciones='$observacion' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, NNE, INE, NI, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre, marca, modelo, observaciones FROM efectossindetalle WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "UPDATE efectossindetalle SET activo=1 WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id, NNE, INE, NI, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre, marca, modelo, observaciones FROM efectossindetalle WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
