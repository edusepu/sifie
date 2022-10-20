<?php
include_once '../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$fechaElevar = (isset($_POST['fechaElevar'])) ? $_POST['fechaElevar'] : '';
$idPlanilla = (isset($_POST['idPlanilla'])) ? $_POST['idPlanilla'] : '';

echo "fecha: ". $fechaElevar;
echo "<br>nroPlanilla: ". $idPlanilla;

//$opcion=1;
$estado = (isset($_POST['estado2'])) ? $_POST['estado2'] : '';
$opcion = (isset($_POST['opcion2'])) ? $_POST['opcion2'] : '';

$idPlanilla = (isset($_POST['idPlanilla2'])) ? $_POST['idPlanilla2'] : '';
//$aux = (isset($_POST['aux'])) ? $_POST['gradoAux']." ".$_POST['aux'] : '';
//$jGu = (isset($_POST['jGu'])) ? $_POST['gradoJ']." ".$_POST['jGu'] : '';
$observa = (isset($_POST['observa'])) ? $_POST['observa'] : '';


switch ($opcion) {
    case 1: //Elevar al J GU
//        $consulta = "UPDATE registroplanillas SET estado=2, auxGu='$aux' WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
//        $resultado = $conexion->prepare($consulta);
//        $resultado->execute();
//        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //Elevar al OF Ser
        $consulta = "UPDATE registroplanillas SET estado=1, observacion='$observa' WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3: //Elevar al J Dpto Apoyo
        $consulta = "UPDATE registroplanillas SET estado=2, observacion='$observa'   WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4: //Elevar al Vicedecano
    case 5: //Elevar al Decano
    case 6: //Elevar al Decano
        $consulta = "UPDATE registroplanillas SET estado=3, observacion='$observa'  WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
header("Location:../index.php");
