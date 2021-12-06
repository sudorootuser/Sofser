<?php
#Salir si alguno de los datos no está presente
if (
	!isset($_POST["documento"]) ||
	!isset($_POST["nombre"]) ||
	!isset($_POST["empresa"]) ||
	!isset($_POST["codigoEmpresa"])
) exit();
#Si todo va bien, se ejecuta esta parte del código...

include_once "../../Model/base_de_datos.php";
include_once "../../Model/Conexion.php";


$documento = $_POST["documento"];
$nombre = $_POST["nombre"];
$empresa = $_POST["empresa"];
$codigoEmpresa = $_POST["codigoEmpresa"];

$stmt = $mysqli->prepare("SELECT documentoProveedor FROM  proveedores WHERE documentoProveedor=? LIMIT 1");
$stmt->bind_param("s", $documento);
$stmt->execute();
$stmt->store_result();
$num = $stmt->num_rows;
$stmt->close();

if ($num === 0) {
	$sentencia = $base_de_datos->prepare("INSERT INTO proveedores(documentoProveedor, nombreProveedor, empresaProveedor, codigoEmpresa) VALUES (?,?,?,?);");
	$resultado = $sentencia->execute([$documento, $nombre, $empresa, $codigoEmpresa]);

	if ($resultado === TRUE) {
		header("Location: ../../View/proveedores/read.php?status=1");
		exit;
	} else echo "Algo salió mal.";
} else {

	header("Location: ../../View/proveedores/create.php?status=2");
}
