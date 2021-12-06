<?php
if (!isset($_POST["total"])) exit;

session_start();


$total = $_POST["total"];
include_once "../../Model/base_de_datos.php";

$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO compra(fechaCompra, totalCompra) VALUES (?, ?);");
$var = $sentencia->execute([$ahora, $total]);


$sentencia = $base_de_datos->prepare("SELECT idCompra FROM compra ORDER BY idCompra DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

// print_r($resultado);die;

$idcompra = $resultado


	=== false ? 1 : $resultado->idCompra;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO producto_compra(producto_idProducto, compra_idCompra, cantidad,proveedor_idProveedor) VALUES (?, ?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE producto SET existencia = existencia + ? WHERE idProducto = ?;");
foreach ($_SESSION["compras"] as $producto) {
	$total += $producto->total;
	// print_r($idcompra);die;
	$sentencia->execute([$producto->idProducto, $idcompra, $producto->cantidad,$producto->proveedor]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->idProducto]);
}

$base_de_datos->commit();
unset($_SESSION["compras"]);
$_SESSION["compras"] = [];
header("Location: ../../view/comprar/registro.php?status=1");
