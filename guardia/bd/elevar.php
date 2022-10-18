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
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$idPlanilla = (isset($_POST['idPlanilla'])) ? $_POST['idPlanilla'] : '';
$aux = (isset($_POST['aux'])) ? $_POST['gradoAux']." ".$_POST['aux'] : '';
$jGu = (isset($_POST['jGu'])) ? $_POST['gradoJ']." ".$_POST['jGu'] : '';
$ofSer = (isset($_POST['ofSer'])) ? $_POST['gradoOf']." ".$_POST['ofSer'] : '';


switch ($opcion) {
    case 1: //Elevar al J GU
        $consulta = "UPDATE registroplanillas SET estado=2, auxGu='$aux' WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //Elevar al OF Ser
        $consulta = "UPDATE registroplanillas SET estado=3, jGu='$jGu' WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
//    case 3: //baja
//        $consulta = "DELETE FROM movimientosvo WHERE id='$id' ";
//        $resultado = $conexion->prepare($consulta);
//        $resultado->execute();
////        $consulta = "SELECT id, NNE, INE, NI, dpto, ubicacion, (select descripcion from departamentos where id=dpto) as dptoNombre FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE id='$id' ";
////        $resultado = $conexion->prepare($consulta);
////        $resultado->execute();
//        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
//        break;
    case 3: //Elevar al J Dpto Apoyo
        $consulta = "UPDATE registroplanillas SET estado=$opcion, ofSer='$ofSer' WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4: //Elevar al Vicedecano
        $consulta = "UPDATE registroplanillas SET estado=5 WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5: //Elevar al Decano
        $consulta = "UPDATE registroplanillas SET estado=6 WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6: //Elevar al Decano
        $consulta = "UPDATE registroplanillas SET estado=10 WHERE idPlanilla='$idPlanilla' and fecha='$fechaElevar' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
header("Location:../index.php");
