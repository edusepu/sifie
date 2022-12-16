<?php
include_once '../../../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$tamanio = (isset($_POST['tamanio'])) ? $_POST['tamanio'] : '';
$origen = (isset($_POST['origen'])) ? $_POST['origen'] : '';
//$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
//$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
//$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
//$observacion = (isset($_POST['observacion'])) ? $_POST['observacion'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO monitores (marca, modelo, tamanio, origen) VALUES('$marca', '$modelo', '$tamanio', '$origen') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, marca, modelo, tamanio, origen, (select descripcion from origen where origen.id=monitores.origen) as origenNombre FROM monitores ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE monitores SET marca='$marca', modelo='$modelo', tamanio='$tamanio', origen='$origen' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, marca, modelo, tamanio, origen, (select descripcion from origen where origen.id=monitores.origen) as origenNombre  FROM monitores WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "UPDATE monitores SET activo=1 WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id, marca, modelo, tamanio, origen, (select descripcion from origen where origen.id=monitores.origen) as origenNombre  FROM monitores WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4: //busqueda
      /*  $consulta = "UPDATE monitores SET activo=1 WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();*/
        $consulta = "SELECT * FROM monitores WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
