<?php
include("../librerias/phpqrcode/qrlib.php");

// Texto o URL que deseas codificar en el QR
$texto = $_POST['codigoMateria'];

// Nombre del archivo de imagen QR que se generará (opcional)
$archivoQR = 'codigo_qr.png';

// Tamaño y margen del código QR (opcional)
$tamaño = 10; // Tamaño de los módulos en píxeles
$margen = 4; // Margen en módulos

// Generar el código QR
QRcode::png($texto, $archivoQR, QR_ECLEVEL_L, $tamaño, $margen);

echo '<img src="' . $archivoQR. '" />';
?>