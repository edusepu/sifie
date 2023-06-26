<!DOCTYPE html>
<html>
<head>
    <title>Listado de Imágenes</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap y DataTables -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
</head>
<body>

<div class="container">
    <a href="index.php" class="btn btn-primary">Volver</a>

    <h2>Listado de Imágenes</h2>

    <button class="btn btn-primary btn-new" data-toggle="modal" data-target="#myModal">Nuevo</button>

    <table id="imageTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Miniatura</th>
            <th>Nombre de la Imagen</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $imageDir = "imagenes/";
        $files = scandir($imageDir);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $imagePath = $imageDir . $file;
                echo "<tr>";
                echo "<td><img src='{$imagePath}' width='100' height='100'></td>";
                echo "<td>{$file}</td>";
                echo "<td><button class='btn btn-danger btn-delete' data-image='{$file}'>Eliminar</button></td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo</h4>
            </div>
            <div class="modal-body">
                <!-- Agrega aquí el formulario para cargar una nueva imagen -->
                <form class="form-signin" method="POST" action="listado.php" enctype="multipart/form-data"/>
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
              //  var_dump( $archivo);
              //  echo "asdfsd";
               // exit;

                if (isset($archivo) && $archivo != "") {
                    $tipo = $_FILES['archivo']['type'];
                    $tamano = $_FILES['archivo']['size'];
                    $temp = $_FILES['archivo']['tmp_name'];

                    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 20000000))) {
                        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 2 MB como máximo.</b></div>';
                    }
                    else {
                        if (move_uploaded_file($temp, 'imagenes/'.$archivo)) {
//                            echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
//                            echo '<p><img src="imagenes/menu.jpg"></p>';
                            header("Location: " . $_SERVER['PHP_SELF']);

                        }
                        else {
                            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                            echo "Not uploaded because of error #".$_FILES["archivo"]["error"];

                        }
                    }
                }
            }
            ?>
            </div>
        </div>
    </div>
</div>

<!-- Agrega los enlaces a los archivos JS de jQuery, Bootstrap y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#imageTable').DataTable();

        $('.btn-delete').click(function() {
            var imageName = $(this).data('image');
            var deleteUrl = 'delete_image.php?image=' + imageName;

            $.ajax({
                url: deleteUrl,
                type: 'POST',
                success: function(response) {
                    if (response == 'success') {
                        alert('La imagen ha sido eliminada correctamente.');
                        location.reload();
                    } else {
                        alert('Error al eliminar la imagen.');
                    }
                }
            });
        });

        $('#newImageForm').submit(function(e) {
            e.preventDefault(); // Evita el envío del formulario por defecto

            var formData = new FormData(this);

            $.ajax({
                url: 'upload_image.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response == 'success') {
                        alert('La imagen ha sido cargada correctamente.');
                        location.reload();
                    } else {
                        alert('Error al cargar la imagen.');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>

</body>
</html>
