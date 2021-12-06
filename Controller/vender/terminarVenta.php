<?php
if (!isset($_POST["total"])) exit;

session_start();


$total = $_POST["total"];
include_once "../../Model/base_de_datos.php";

$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO venta(fechaVenta, totalVenta) VALUES (?, ?);");
$var = $sentencia->execute([$ahora, $total]);


$sentencia = $base_de_datos->prepare("SELECT idVenta FROM venta ORDER BY idVenta DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);



$idVenta = $resultado


	=== false ? 1 : $resultado->idVenta;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO producto_venta(producto_idProducto, venta_idVenta, cantidad,proveedor_idProveedor) VALUES (?, ?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE producto SET existencia = existencia - ? WHERE idProducto = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	// print_r($idVenta);die;
	$sentencia->execute([$producto->idProducto, $idVenta, $producto->cantidad,$producto->proveedor]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->idProducto]);
}

$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ../../view/vender/registro.php?status=1");
