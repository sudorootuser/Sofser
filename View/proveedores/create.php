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
                        <h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">CREAR PROVEEDOR</h4>
<br>
                    <?php
                    if (isset($_GET["status"])) {
                    ?>
                            
                        <?php
                        if ($_GET["status"] === "2") {
                        ?>
                            <div class="alert alert-danger">
                                <strong>Proveedor ya existe</strong>
                            </div>
                        <?php
                        } }?>

                        <form method="post" action="../../Controller/proveedores/create.php" autocomplete="off">

                            <label for="codigo">Identificacion:</label>
                            <input class="form-control" name="documento" required type="text" id="documento">

                            <label for="codigo">Nombre:</label>
                            <input class="form-control" name="nombre" required type="text" id="nombre">

                            <label for="codigo">Empresa:</label>
                            <input class="form-control" name="empresa" required type="text" id="empresa">

                            <label for="codigo">Código de empresa:</label>
                            <input class="form-control" name="codigoEmpresa" required type="text" id="codigoEmpresa">

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