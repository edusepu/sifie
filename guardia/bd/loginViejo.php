<?php
session_start();
//$url=$_SERVER['HTTP_REFERER'];
//$_SESSION["url"]=$url;
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
//$usuario="administrador";
//$password="1234";
$pass = $password;//md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$pass'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();

$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$usuarios= array();

foreach ($data as $row => $link) {
    $usuarios[$row] = $link['tipo'];
    $rol = $link['rol'];
   // $cargos = $link['cargos'];
   // $fundacion = $link['fundacion'];
   // $proyecto = $link['proyecto'];

}


if($resultado->rowCount() >= 1){
  //  $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $usuario;
    $_SESSION["s_rol"] = $rol;
//    $_SESSION["cargos"] = $cargos;
//    $_SESSION["fundacion"] = $fundacion;
//    $_SESSION["proyecto"] = $proyecto;
}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}

//$data[]=("url:hola");
print json_encode($data);
$conexion=null;
