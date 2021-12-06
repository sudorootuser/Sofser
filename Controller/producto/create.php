<?php
#Salir si alguno de los datos no está presente
if (
	!isset($_POST["codigo"]) ||
	!isset($_POST["nombre"]) ||
	!isset($_POST["precio"]) ||
	!isset($_POST["perecedero"]) ||
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
include_once "../../Model/Conexion.php";

$nombre = $_POST["nombre"];
$codigo = $_POST["codigo"];
$precio = $_POST["precio"];
$perecedero = $_POST["perecedero"];
$fechaVencimiento = $_POST["fechaVencimiento"];
$empresa = $_POST['empresa'];
$stockMin = $_POST['stockMin'];
$stockBas = $_POST["stockBas"];
$stockMax = $_POST['stockMax'];
$existencia = $_POST['existencia'];

$stmt = $mysqli->prepare("SELECT codigoBarras FROM  producto WHERE codigoBarras=? LIMIT 1");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$stmt->store_result();
$num = $stmt->num_rows;
$stmt->close();

if ($num === 0) {
	$sentencia = $base_de_datos->prepare("INSERT INTO producto(nombre, codigoBarras, precio, perecedero,fechaVencimiento,empresa, existencia,stockMinimo,stockBasico,stockMaximo) VALUES (?,?,?,?,?,?,?,?,?,?);");
	$resultado = $sentencia->execute([$nombre, $codigo, $precio, $perecedero, $fechaVencimiento, $empresa,  $existencia, $stockMin, $stockBas, $stockMax]);

	if ($resultado === TRUE) {
		header("Location: ../../View/productos/read.php");
		exit;
	} else echo "Algo salió mal. Por favor verifica que la tabla Exista, así como el ID del producto";
}else {

	header("Location: ../../View/productos/create.php?status=2");
}


// print_r($existencia);die;
