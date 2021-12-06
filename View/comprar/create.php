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
?>




<body style="background-color: #fff;overflow: hidden !important;">

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
                <div class="container-fluid">
                    <h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">COMPRA DE PRODUCTOS</h4>
                    <br>
                    <?php
                    if (isset($_GET["status"])) {
                        if ($_GET["status"] === "1") {
                    ?>
                            <div class="alert alert-success">
                                <strong>¡Correcto!</strong> Compra realizada correctamente
                            </div>
                        <?php
                        } else if ($_GET["status"] === "2") {
                        ?>
                            <div class="alert alert-info">
                                <strong>Compra cancelada</strong>
                            </div>
                        <?php
                        } else if ($_GET["status"] === "3") {
                        ?>
                            <div class="alert alert-info">
                                <strong>Ok</strong> Producto quitado de la lista
                            </div>
                        <?php
                        } else if ($_GET["status"] === "4") {
                        ?>
                            <div class="alert alert-warning">
                                <strong>Error:</strong> El producto que buscas no existe
                            </div>
                        <?php
                        } else if ($_GET["status"] === "5") {
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error: </strong>Cantidad mas alta que las existencias del producto
                            </div>
                        <?php
                        } else if ($_GET["status"] === "6") {
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error: </strong>Proveedor no existe
                            </div>
                        <?php
                        } else if ($_GET["status"] === "7") {
                        ?>
                            <div class="alert alert-info">
                                <strong>Aviso:  </strong>Producto agregado al carrito
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error:</strong> Algo salió mal mientras se realizaba la compra
                            </div>
                    <?php
                        }
                    }
                    ?>


                    <form method="post" action="../../Controller/comprar/agregarAlCarrito.php" autocomplete="off">

                        <label for="codigo">Código de barras:</label>
                        <input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo">

                        <label for="proveedor">Código Proveedor:</label>
                        <input autocomplete="off" type="text" name="proveedor" id="proveedor" class="form-control" required>

                        <label for="cantidad">Cantidad:</label>
                        <input autocomplete="off" type="text" name="cantidad" id="cantidad" class="form-control" required>

                        <br>
                        <button type="submit" style="background-color:#F3C915;color:#fff" class="btn ">Agregar</button>
                    </form>



                    <table class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Precio de Compra</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $granTotal = 0;
                            if (!isset($_SESSION["compras"])) {
                                $_SESSION["compras"]=[];
                            }
                            foreach ($_SESSION["compras"] as $indice => $producto) {
                                $granTotal += $producto->total;
                            ?>
                                <tr>
                                    <td><?php echo $producto->codigoBarras ?></td>
                                    <td><?php echo $producto->nombre ?></td>
                                    <td><?php echo $producto->precio ?></td>
                                    <td><?php echo $producto->cantidad ?></td>
                                    <td><?php echo $producto->total ?></td>
                                    <td><a class="btn btn-danger" href="<?php echo "../../Controller/comprar/quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <h4>TOTAL: <?php
                                if (!isset($granTotal)) {
                                    $granTotal = 0;
                                    echo $granTotal;
                                } else {
                                    echo $granTotal;
                                }  ?></h4>
                    <form action="../../Controller/comprar/terminarCompra.php" method="POST">
                        <input name="total" type="hidden" value="<?php echo $granTotal; ?>">
                        <button type="submit" class="btn btn text-white" style="background-color:#21822A;color:#fff;">Terminar Compra</button>
                        <a href="../../Controller/comprar/cancelarCompra.php" class="btn btn-danger">Cancelar Compra</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>