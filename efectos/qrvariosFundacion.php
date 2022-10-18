<?php
//$textqr=$_POST['textqr'];//Recibo la variable pasada por post
//$sizeqr=300;$_POST['sizeqr'];//Recibo la variable pasada por post

include('vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
$str = base64_encode($textqr);

$str = "http://sifie/efectos/efectos/detalleF.php?id=".$numeroConCeros;
$qrCode = new QrCode($str);//Creo una nueva instancia de la clase
$qrCode->setSize($sizeqr);//Establece el tamaño del qr
//header('Content-Type: '.$qrCode->getContentType());
$image= $qrCode->writeString();//Salida en formato de texto

$imageData = base64_encode($image);//Codifico la imagen usando base64_encode

echo '<img src="data:image/png;base64,'.$imageData.'"></img>';

?>