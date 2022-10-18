<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$local = (isset($_GET['local'])) ? $_GET['local'] : '';

        $consulta = "UPDATE efectos SET idLocal='$local' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        //$consulta = "SELECT id, NNE, INE, NI, dpto FROM efectos LEFT JOIN detallecomputadora ON efectos.id=detallecomputadora.idDetalle WHERE id='$id' ";
        //resultado = $conexion->prepare($consulta);
        //$resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>



<link rel="shortcut icon" href="../../imagenes/icono.ico">

<link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="../../fuentes/iconic/css/material-design-iconic-font.min.css">

<script src="../../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    //alert("chau");
    Swal.fire({
        title: "Efecto ubicado!",
        text: "Efecto ubicado en el local correctamente.",
        button: "Cerrar", // Text on button
        icon: "success", //built in icons: success, warning, error, info
        timer: 5000, //timeOut for auto-close
        buttons: {
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "",
                closeModal: true
            }
        }
    }).then((result) => {
            window.location.href = "../../redirect.php";
    });

    </script>