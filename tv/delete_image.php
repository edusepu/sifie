<?php
if (isset($_GET['image'])) {
    $imageDir = "imagenes/";
    $imageName = $_GET['image'];
    $imagePath = $imageDir . $imageName;

    if (file_exists($imagePath)) {
        unlink($imagePath);
        echo 'success';
        exit;
    }
}

echo 'error';
