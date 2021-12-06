<?php

#Salir si alguno de los datos no está presente
if (
	!isset($_POST["documento"]) ||
	!isset($_POST["nombre"]) ||
	!isset($_POST["empresa"]) ||
	!isset($_POST["codigoEmpresa"])

	// tp_iva
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../Model/base_de_datos.php";
$id = $_POST["id"];

$documento = $_POST["documento"];
$nombre = $_POST["nombre"];
$empresa = $_POST["empresa"];
$codigoEmpresa = $_POST["codigoEmpresa"];



// print_r($tp_iva);die;

$sentencia = $base_de_datos->prepare("UPDATE proveedores SET documentoProveedor = ?, nombreProveedor = ?, empresaProveedor = ?, codigoEmpresa = ? WHERE idProveedor = ?;");
$resultado = $sentencia->execute([$documento, $nombre, $empresa, $codigoEmpresa,$id]);

if ($resultado === TRUE) {
	header("Location: ../../View/proveedores/read.php");
	exit;
} else echo "Algo salió mal. Por favor verifica que la tabla Exista, así como el ID del producto";
