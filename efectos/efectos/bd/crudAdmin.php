<?php
//include_once '../bd/conexion.php';
include_once '../../../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$departamento = (isset($_POST['departamento'])) ? $_POST['departamento'] : '';
$cargos = (isset($_POST['cargos'])) ? $_POST['cargos'] : '';
$fundacion = (isset($_POST['fundacion'])) ? $_POST['fundacion'] : '';
$proyecto = (isset($_POST['proyecto'])) ? $_POST['proyecto'] : '';



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO usuarios (usuario, tipo, departamento, cargos, fundacion, proyecto) VALUES('$usuario', '$tipo', '$departamento', '$cargos', '$fundacion', '$proyecto') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, usuario, tipo, (select descripcion from roles where id=tipo) as tipoDesc, departamento, (select descripcion from departamentos where id=departamento) as departamentoDesc, cargos, fundacion, proyecto FROM usuarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE usuarios SET tipo='$tipo', departamento='$departamento', cargos='$cargos', fundacion='$fundacion', proyecto='$proyecto' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, usuario, tipo, (select descripcion from roles where id=tipo) as tipoDesc, departamento, (select descripcion from departamentos where id=departamento) as departamentoDesc, cargos, fundacion, proyecto FROM usuarios  WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "UPDATE usuarios SET activo=0 WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id, usuario, tipo, (select descripcion from roles where id=tipo) as tipoDesc, departamento, (select descripcion from departamentos where id=departamento) as departamentoDesc, cargos, fundacion, proyecto FROM usuarios  WHERE id='$id' ";
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
