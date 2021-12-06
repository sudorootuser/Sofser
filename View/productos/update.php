<!DOCTYPE html>
<html id="prueba">
<!-- <link rel="icon" type="image/png" href="Recursos/Imagenes/LOGO PASION DEPORTIVA COMPLETO2.png"/> -->
<?php

include_once '../../Resource/Header/Header_Index2.php';
include_once '../../Resource/Header/Menu_Nav2.php';
require '../../Model/Conexion.php';
require '../../Model/base_de_datos.php';

require '../../Model/Conexion2.php';
include_once '../../Controller/userInfo.php';
include_once '../../Controller/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
    header('Location:../login.php');
}

?>

<?php
if (!isset($_GET["id"])) exit();
$id = $_GET["id"];

$sentencia = $base_de_datos->prepare("SELECT * FROM producto WHERE idProducto = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if ($producto === FALSE) {
    echo "¡No existe algún producto con ese ID!";
    exit();
}

?>

<body style="background-color: #fff;">

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <br>
            </div>
        </div>
        <div class="row">

            <div class="col-2">

            </div>

            <div class="col-8">
                <div class="container-fluid" style="height: 80%;">
                    <div class="col-xs-12">
                        <h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">PRODUCTO: # <?php echo $producto->codigoBarras; ?></h4>
                        <form method="post" action="../../Controller/producto/update.php">
                            <input type="hidden" name="id" value="<?php echo $producto->idProducto; ?>">

                            <label for="codigo">Código de barras:</label>
                            <input value="<?php echo $producto->codigoBarras ?>" class="form-control" name="codigo" required type="text" id="codigo">

                            <label for="precioVenta">Nombre</label>
                            <input value="<?php echo $producto->nombre ?>" class="form-control" name="nombre" required type="text" id="precioVenta">

                            <label for="precio">Precio</label>
                            <input value="<?php echo $producto->precio ?>" class="form-control" name="precio" required type="text" id="precio">

                            <label for="ubicacion">Ubicacion</label>
                            <select class="form-select" name="ubicacion" aria-label="Default select example" aria-palceholder="Seleccione">

                                <option selected value="Bodega">Bodega</option>
                                <option value="Vitrina">Vitrina</option>

                            </select>

                            <label for="precio">Perecedero</label>
                            <select class="form-select" name="perecedero" aria-label="Default select example">
                                <option selected value="Si">Si</option>
                                <option value="NO">NO</option>
                                
                            </select>

                            <label for="fechaVencimiento">Fecha de Vencimiento:</label>
                            <input value="<?php echo $producto->fechaVencimiento ?>" class="form-control" name="fechaVencimiento" required type="date" id="fechaVencimiento">

                            <label for="registroInvima">Empresa</label>
                            <input value="<?php echo $producto->empresa ?>" class="form-control" name="empresa" required type="text" id="registroInvima">

                            <label for="registroInvima">Stock Minimo</label>
                            <input value="<?php echo $producto->stockMinimo ?>" class="form-control" name="stockMin" required type="text" id="registroInvima">

                            <label for="registroInvima">Stock Básico</label>
                            <input value="<?php echo $producto->stockBasico ?>" class="form-control" name="stockBas" required type="text" id="registroInvima">

                            <label for="registroInvima">Stock Máximo</label>
                            <input value="<?php echo $producto->stockMaximo ?>" class="form-control" name="stockMax" required type="text" id="registroInvima">

                            <label for="existencia">Existencia:</label>
                            <input value="<?php echo $producto->existencia ?>" class="form-control" name="existencia" required type="number" id="existencia">
                            <br><br><input class="btn" style="background-color:#21822A;color:#fff;" type="submit" value="Guardar">
                            <a class="btn btn-danger" href="read.php">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-2">

            </div>
        </div>
    </div>
    <!-- Footer Principal -->

</body>

</html>