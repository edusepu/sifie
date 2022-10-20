<?php
session_start();
$redir=$_SESSION["tipologin"];
unset($_SESSION["s_usuario"]);
session_destroy();
if($redir==1){
    header("Location: ../../login.php");    //ldap
}else{
    header("Location: ../login.php"); //usuario BD Guardia
}

?>