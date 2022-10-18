<?php
session_start();
//echo "prueba";
//var_dump($_GET);
//echo $_SESSION["url"];
//echo $_GET['id'];
if(isset($_GET['id'])){
    echo "con id";
    header("Location: efectos/detalle.php?id=".$_GET['id']);
}else{
    echo "sin id";
    header("Location: index.php");
}
//header("Location: ".$_SESSION["url"]);
die();
//require('efectos/index.php');
?>