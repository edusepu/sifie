<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cargar Menu</title>
<link rel="shortcut icon" href="imagenes/icono.ico">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/personal.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/personal.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript"></script>
<style>
.form-signin {
  max-width: 380px;
  padding: 15px 35px 5px;
  margin: 0 auto;

}
</style>
             
</head>
<body>



     <div class="wrapper">

      <form class="form-signin" method="POST" action="cargar.php" enctype="multipart/form-data"/>
      <div class="banner" id="banner">
			<h1>Cargar Menú</h1>
			<br>
			<br>
			<br>
		</div>

        <input name="archivo" id="archivo" type="file"/>
         <input class="btn btn-lg btn-primary btn-block" type="submit" name="subir" value="Subir imagen"/><br>
			<br>

      </form>
    </div>

     <?php
     if (isset($_POST['subir'])) {
         $archivo = $_FILES['archivo']['name'];
         if (isset($archivo) && $archivo != "") {
             $tipo = $_FILES['archivo']['type'];
             $tamano = $_FILES['archivo']['size'];
             $temp = $_FILES['archivo']['tmp_name'];

             if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 20000000))) {
                 echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 2 MB como máximo.</b></div>';
             }
             else {
                 if (move_uploaded_file($temp, 'imagenes2/menu.jpg')) {
                     echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                     echo '<p><img src="imagenes2/menu.jpg"></p>';
                 }
                 else {
                     echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                     echo "Not uploaded because of error #".$_FILES["archivo"]["error"];

                 }
             }
         }
     }
     ?>
</body>
</html>
