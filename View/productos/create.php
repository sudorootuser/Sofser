<html id="prueba">
<!-- <link rel="icon" type="image/png" href="Recursos/Imagenes/LOGO PASION DEPORTIVA COMPLETO2.png"/> -->

<?php
// <!-- Headers -->

include_once '../../Resource/Header/Header_Index2.php';
include_once '../../Resource/Header/Menu_Nav2.php';
require '../../Model/Conexion.php';
require '../../Model/base_de_datos.php';
require '../../Model/Conexion2.php';
include_once '../../Controller/userInfo.php';
include_once '../../Controller/funcs.php';

// print_r($la);die;
if (!isset($_SESSION["id_usuario"])) {
    header('Location:../login.php');
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
                        <h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">CREAR PRODUCTO</h4>
                        <?php
                        if (isset($_GET["status"])) {
                        ?>

                            <?php
                            if ($_GET["status"] === "2") {
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Producto ya existe</strong>
                                </div>
                        <?php
                            }
                        } ?>

                        <form method="post" action="../../Controller/producto/create.php" autocomplete="off">

                            <label for="codigo">Código de barras:</label>
                            <input class="form-control" name="codigo" required type="text" id="codigo">

                            <label for="precioVenta">Nombre</label>
                            <input class="form-control" name="nombre" required type="text" id="precioVenta">

                            <label for="precio">Precio</label>
                            <input class="form-control" name="precio" required type="number" id="precio">


                            <label for="precio">Ubicacion</label>
                            <select class="form-select" name="ubicacion" aria-label="Default select example">
                                <option selected value="Bodega">Bodega</option>
                                <option value="Vitrina">Vitrina</option>

                            </select>

                            <label for="precio">Perecedero</label>
                            <select class="form-select" name="perecedero" aria-label="Default select example">
                                <option selected value="Si">Si</option>
                                <option value="NO">NO</option>

                            </select>

                            <label for="fechaVencimiento">Fecha de Vencimiento:</label>
                            <input class="form-control" name="fechaVencimiento" required type="date" id="fechaVencimiento">

                            <label for="registroInvima">Empresa</label>
                            <input class="form-control" name="empresa" required type="text" id="registroInvima">

                            <label for="registroInvima">Stock Minimo</label>
                            <input class="form-control" name="stockMin" required type="number" id="registroInvima">

                            <label for="registroInvima">Stock Básico</label>
                            <input class="form-control" name="stockBas" required type="number" id="registroInvima">

                            <label for="registroInvima">Stock Máximo</label>
                            <input class="form-control" name="stockMax" required type="number" id="registroInvima">

                            <label for="existencia">Existencia:</label>
                            <input class="form-control" name="existencia" required type="number" id="existencia">
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