<?php
//echo "detalle crud";
//var_dump($_POST);
//exit;
//include_once '../bdF/conexion.php';
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
$usuariopc = (isset($_POST['usuariopc'])) ? $_POST['usuariopc'] : '';
$monitor = (isset($_POST['monitor'])) ? $_POST['monitor'] : '';
$monitorNombre = (isset($_POST['monitorNombre'])) ? $_POST['monitorNombre'] : '';

/*$INE = (isset($_POST['INE'])) ? $_POST['INE'] : '';
$NI = (isset($_POST['NI'])) ? $_POST['NI'] : '';
$dpto = (isset($_POST['dpto'])) ? $_POST['dpto'] : '';*/

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
switch($opcion){
    case 1: //alta

        $consulta = "INSERT INTO detalleFundacion (idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, nombreEquipo, usuario, monitor) VALUES ('$id', '$tipoMicro', '$micro', '$ram', '$tipoDisco', '$disco', '$capacidadDisco', '$so','$obs','$nombreEquipo', '$usuariopc', '$monitor') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id, elemento, descripcion, dpto, ubicacion, proyecto, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, ubicacion, nombreEquipo, (select descripcion from departamentos where id=dpto) as dptoNombre, usuario as usuariopc, monitor, (SELECT CONCAT(id,' ',marca, ' ',modelo, ' ', tamanio, '''') FROM monitores WHERE monitores.id=detalleFundacion.monitor) AS monitorNombre  FROM fundacion LEFT JOIN detalleFundacion ON fundacion.id=detalleFundacion.idDetalle WHERE idDetalle='$id' ";

        //$consulta = "SELECT id, NNE, INE, NI, dpto FROM efectos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        $consulta = "UPDATE detalleFundacion SET marcaProcesador='$tipoMicro', procesador='$micro', ram='$ram', tipoDisco='$tipoDisco', capacidadDisco='$disco', medidaCapacidad='$capacidadDisco', sistemaOperativo='$so', observaciones='$obs', nombreEquipo='$nombreEquipo', usuario='$usuariopc', monitor='$monitor'  WHERE idDetalle='$id' ";
        //$consulta = "UPDATE detallecomputadora SET marcaProcesador='$tipoMicro', procesador='$micro', ram='$ram', tipoDisco='$tipoDisco', capacidadDisco='$disco', medidaCapacidad='$capacidadDisco', sistemaOperativo='$so', observaciones='$obs', nombreEquipo='$nombreEquipo', usuario='$usuariopc', monitor='$monitor'  WHERE idDetalle='$id' ";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
       // echo("<script>console.log('PHP: ".$consulta."');</script>");
        $consulta = "SELECT id, elemento, descripcion, dpto, ubicacion, proyecto, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, ubicacion, nombreEquipo, (select descripcion from departamentos where id=dpto) as dptoNombre, usuario as usuariopc, monitor, (SELECT CONCAT(id,' ',marca, ' ',modelo, ' ', tamanio, '''') FROM monitores WHERE monitores.id=detalleFundacion.monitor) AS monitorNombre  FROM fundacion LEFT JOIN detalleFundacion ON fundacion.id=detalleFundacion.idDetalle WHERE idDetalle='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        

}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
