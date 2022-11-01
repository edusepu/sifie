<?php
include_once 'conexion.php';
// include_once 'bd/conexion.php';

 
$objeto = new Conexion();
$conexion = $objeto->Conectar();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('Y-m-d', time());
$consulta = "SELECT * FROM planillas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$cantidad = $resultado->rowCount();
//echo $cantidad;


$consulta = "SELECT * FROM registroplanillas WHERE fecha='$fecha'";
//echo $consulta;
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$existe=0;
foreach ($data as $datos) {
    $existe=1;
}
if($existe==0){
    for ($i = 1; $i <= $cantidad; $i++) {
        $consulta = "INSERT INTO registroplanillas (idPlanilla, estado, fecha) VALUES($i, 1, '$fecha') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        echo "registros creados";

    }

}
$conexion = NULL;