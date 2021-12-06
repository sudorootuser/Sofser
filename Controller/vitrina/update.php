<?php

#Salir si alguno de los datos no está presente
if (
	!isset($_POST["codigo"]) ||
	!isset($_POST["nombre"]) ||
	!isset($_POST["perecedero"]) ||
	!isset($_POST["ubicacion"]) ||
	!isset($_POST["fechaVencimiento"]) ||
	!isset($_POST['empresa']) ||
	!isset($_POST['stockMin']) ||
	!isset($_POST["stockBas"]) ||
	!isset($_POST['stockMax']) ||
	!isset($_POST["existencia"])

	// tp_iva
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../../Model/base_de_datos.php";
$id = $_POST["id"];
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$ubicacion = $_POST["ubicacion"];
$perecedero = $_POST["perecedero"];
$fechaVencimiento = $_POST["fechaVencimiento"];
$empresa = $_POST['empresa'];
$stockMin = $_POST['stockMin'];
$stockBas = $_POST["stockBas"];
$stockMax = $_POST['stockMax'];
$existencia = $_POST['existencia'];


// print_r($tp_iva);die;

$sentencia = $base_de_datos->prepare("UPDATE producto SET codigoBarras = ?, nombre = ?, precio = ?, perecedero = ?, empresa = ?, fechaVencimiento = ?, existencia = ?, stockMinimo = ?, stockBasico = ?, stockMaximo = ?, ubicacion=?    WHERE idProducto = ?;");
$resultado = $sentencia->execute([$codigo, $nombre, $precio, $perecedero, $empresa, $fechaVencimiento, $existencia,$stockMin,$stockBas,$stockMax,$ubicacion, $id]);

if ($resultado === TRUE) {
	header("Location: ../../View/vitrina/read.php");

} else echo "Algo salió mal. Por favor verifica que la tabla Exista, así como el ID del producto";
