<?php
session_start();
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Credenciales de prueba

/*$usuario = "sepulveda";
$user = 'est\\' . $usuario;
$password = "123456789";*/

// Datos de acceso al servidor LDAP
$host = "10.24.32.8";
$port = "389";

// Conexto donde se encuentran los usuarios
$basedn = "OU=Efectos,DC=EST,DC=LOCAL";//arbol de cirectorio del LDAP

// Atributos a recuperar
$searchAttr = array("dn", "cn", "sn", "givenName", "sAMAccountName");

// Atributo para incorporar en la respuesta
$displayAttr = "cn";

// Respuesta por defecto
$status = 1;
$msg = "";
$userDisplayName = "null";

// Recuperar datos del POST
if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $user = 'est\\' . $usuario;
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
//$usuario = 'sepulveda';

//$user = 'est\\sepulveda';
//$password = '123456789';
// Establecer la conexión con el servidor LDAP
$ad = ldap_connect($host, $port) or die("No se pudo conectar al servidor LDAP.");


// Autenticar contra el servidor LDAP

ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
//$ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass);
$entries = null;
$data = null;
if (@ldap_bind($ad, $user, $password)) {
    // En caso de éxito, recuperar los datos del usuario
    $result = ldap_search($ad, $basedn, "(sAMAccountName={$usuario})", $searchAttr);
    $entries = ldap_get_entries($ad, $result);
//var_dump($entries);
//echo "//////////////";
    //var_dump(ldap_explode_dn($ad,0));

    foreach($entries[0] as $datos3=>$d)
    {
        foreach($d as $dato=>$jugador)
        {
            $nombre = $jugador;//exit;
        }
        //echo "<br>";
        break;
    }
   // echo $nombre;
   // echo "<br>";

    $pass = $password;//md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD
   // $usuario="administrador";
    $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' and activo=1";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $usuarios= array();

    foreach ($data as $row => $link) {
        $usuarios[$row] = $link['tipo'];
        $rol = $link['tipo'];
        $cargos = $link['cargos'];
        $fundacion = $link['fundacion'];
        $proyecto = $link['proyecto'];
        $rolG =  $link['guardia'];

    }


    if($resultado->rowCount() >= 1){
        //  $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["s_usuario"] = $usuario;
        $_SESSION["g_usuario"] = $usuario;
        $_SESSION["s_rol"] = $rol; //rol para el sistema de efectos
        $_SESSION["g_rol"] = $rolG; //rol para sistema de la guardia
        $_SESSION["cargos"] = $cargos;
        $_SESSION["fundacion"] = $fundacion;
        $_SESSION["proyecto"] = $proyecto;
        $_SESSION["tipologin"] = 1;//con usuario de dominio
        $_SESSION["nombre"] = $nombre;
    }else{
        $_SESSION["s_usuario"] = null;
        $_SESSION["g_usuario"] = null;

        $data=null;
    }
}

// Respuesta en formato JSON
print json_encode($data);

//header('Content-Type: application/json');
//echo "{\"uid\": \"{$user}\", \"estado\": \"{$status}\", \"nombre\": \"{$userDisplayName}\", \"debug\": \"{$msg}\"}";
?>