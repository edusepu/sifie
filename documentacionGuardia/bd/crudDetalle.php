<?php
//echo "detalle crud";
//var_dump($_POST);
//exit;
//include_once '../bd/conexion.php';
include_once '../../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$tipoMicro = (isset($_POST['marcaProcesador'])) ? $_POST['marcaProcesador'] : '';
$micro = (isset($_POST['micro'])) ? $_POST['micro'] : '';
$ram = (isset($_POST['ram'])) ? $_POST['ram'] : '';
$tipoDisco = (isset($_POST['tipoDisco'])) ? $_POST['tipoDisco'] : '';
$capacidadDisco = (isset($_POST['medidaCapacidad'])) ? $_POST['medidaCapacidad'] : '';
$disco = (isset($_POST['disco'])) ? $_POST['disco'] : '';
$so = (isset($_POST['so'])) ? $_POST['so'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
$nombreEquipo = (isset($_POST['nombreEquipo'])) ? $_POST['nombreEquipo'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
switch($opcion){
    case 1: //alta

        $consulta = "INSERT INTO detallecomputadora (idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, nombreEquipo) VALUES ('$id', '$tipoMicro', '$micro', '$ram', '$tipoDisco', '$disco', '$capacidadDisco', '$so','$obs','$nombreEquipo') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, NNE, INE, NI, dpto, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, ubicacion, nombreEquipo, (select descripcion from departamentos where id=dpto) as dptoNombre FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE id='$id' ";

        //$consulta = "SELECT id, NNE, INE, NI, dpto FROM efectos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        $consulta = "UPDATE detallecomputadora SET marcaProcesador='$tipoMicro', procesador='$micro', ram='$ram', tipoDisco='$tipoDisco', capacidadDisco='$disco', medidaCapacidad='$capacidadDisco', sistemaOperativo='$so', observaciones='$obs', nombreEquipo='$nombreEquipo'  WHERE idDetalle='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
       // echo("<script>console.log('PHP: ".$consulta."');</script>");
        $consulta = "SELECT id, NNE, INE, NI, dpto, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, ubicacion, nombreEquipo, (select descripcion from departamentos where id=dpto) as dptoNombre FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE idDetalle='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE efectos SET activo=1 WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta = "SELECT id, NNE, INE, NI, dpto FROM efectos WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                      
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
