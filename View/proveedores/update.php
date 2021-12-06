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

$sentencia = $base_de_datos->prepare("SELECT * FROM proveedores WHERE idProveedor = ?;");
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
                        <h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">PRODUCTO: # <?php echo $producto->idProveedor; ?></h4>
                        <form method="post" action="../../Controller/proveedores/update.php">
                            <input type="hidden" name="id" value="<?php echo $producto->idProveedor; ?>">

                            <label for="codigo">Identificacion: </label>
                            <input value="<?php echo $producto->documentoProveedor?>" readonly class="form-control" name="documento" required type="text" id="documento">

                            <label for="codigo">Nombre:</label>
                            <input value="<?php echo $producto->nombreProveedor ?>" class="form-control" name="nombre" required type="text" id="nombre">

                            <label for="codigo">Empresa:</label>
                            <input value="<?php echo $producto->empresaProveedor ?>" class="form-control" name="empresa" required type="text" id="empresa">

                            <label for="codigo">Código de empresa:</label>
                            <input value="<?php echo $producto->codigoEmpresa ?>" class="form-control" name="codigoEmpresa" required type="text" id="codigoEmpresa">

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