<?php
if (!isset($_GET["id"])) exit();
$id = $_GET["id"];
// print_r($id);die;
include_once "../../Model/base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM producto_venta WHERE venta_idVenta = ?");
$resultado = $sentencia->execute([$id]);

if ($resultado === TRUE) {
    $sentencia = $base_de_datos->prepare("DELETE FROM venta WHERE idVenta = ?");
    $resultado = $sentencia->execute([$id]);
    if ($resultado === TRUE) {
        header("Location: ../../View/vender/registro.php");

        exit;
    }
} else echo "Algo salió mal";
