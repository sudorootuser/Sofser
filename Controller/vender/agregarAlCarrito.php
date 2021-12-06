<?php
if (!isset($_POST["codigo"]) || !isset($_POST["proveedor"]) || !isset($_POST["cantidad"])) {
    return;
}
require '../../Model/base_de_datos.php';
$codigo = $_POST["codigo"];
$cantidad = $_POST["cantidad"];
$proveedor = $_POST["proveedor"];
$sentencia = $base_de_datos->prepare("SELECT * FROM producto  WHERE codigoBarras = ?  LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT * FROM proveedores WHERE proveedores.idProveedor = ?  LIMIT 1;");
$sentencia->execute([$proveedor]);
$prov = $sentencia->fetch(PDO::FETCH_OBJ);


if (!$producto) {
    header("Location: ../../View/vender/create.php?status=4");
    exit;
}
# Si no hay existencia...
if ($producto->existencia < 1) {
    header("Location: ../../View/vender/create.php?status=5");
    exit;
}
if (!$prov) {
    header("Location: ../../View/vender/create.php?status=6");
    exit;
}

session_start();
$_SESSION["carrito"]=[];

# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->codigo === $codigo) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = $cantidad;
    $total = $producto->precio;
    $producto->valor_uno = $producto->precio;
    $producto->proveedor=$proveedor;
    $producto->total = $cantidad*$producto->precio;

    array_push($_SESSION["carrito"], $producto);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + $cantidad > $producto->existencia) {
        header("Location: ../../View/vender/create.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad+$cantidad;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->total + $_SESSION["carrito"][$indice]->valor_uno;
}
header("Location: ../../View/vender/create.php?status=7");
