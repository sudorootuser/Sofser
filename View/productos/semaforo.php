<!DOCTYPE html>
<html lang="en">

<?php
include_once '../../Resource/Header/Header_Index2.php';
include_once '../../Resource/Header/Menu_Nav2.php';
require '../../Model/Conexion.php';
require '../../Model/base_de_datos.php';
require '../../Model/Conexion2.php';
include_once '../../Controller/userInfo.php';
include_once '../../Controller/funcs.php';
?>

<?php
$per_page_record = 10;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page_record;
$query = "SELECT * FROM producto LIMIT $start_from, $per_page_record ";
$rs_result = mysqli_query($conn, $query);
?>

<body style="background-color: #fff;">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-sm ">
                <br>
            </div>
        </div>
        <div class="row ">
            <div class="col-1">

            </div>
            <div class="col-sm-10 ">
                <div class="container-fluid ">
                    <div class="col-sm-12 col-xs-12 ">
                        <h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">PRODUCTOS</h4>
                        <div class="row">



                            <div class="col-8">
                                <form class="d-flex" name="form1" method="post">
                                    <input class="form-control me-2" name="PalabraClave" type="search" placeholder="Search..." aria-label="Search">
                                    <input name="buscar" type="hidden" class="form-control " id="inlineFormInput" value="v">
                                    <button class="btn btn-outline " style="color:#fff; background-color:#F3C915;width: 150px;" type="submit">Buscar</button>
                                </form>
                            </div>


                            <div class="col"> 
                                <a href="create.php"><button class="btn btn-outline " style="color:#fff; background-color:#21822A;width: 100%;">Crear</button></a>

                            </div>

                            <div class="col"> 
                                <a href="read.php" ><button style="width: 100%;" class="btn btn-light">Desactivar Colores</button></a>
                            </div>




                        </div>



                        <!-- BUSQUEDA -->
                        <div class="data-table " style="overflow: auto; width: 100%;">
                            <table class="table text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Código de Barras</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($_POST)) {
                                        $aKeyword = explode(" ", $_POST['PalabraClave']);
                                        $query = "SELECT * FROM producto WHERE codigoBarras like '%" . $aKeyword[0] . "%'";

                                        for ($i = 1; $i < count($aKeyword); $i++) {
                                            if (!empty($aKeyword[$i])) {
                                                $query .= " OR nombre like '%" . $aKeyword[$i] . "%'";
                                            }
                                        }
                                        $result = $conn->query($query);
                                        echo "<br>Has buscado la palabra clave:<b> " . $_POST['PalabraClave'] . "</b>";
                                        if (mysqli_num_rows($result) > 0) {
                                            $row_count = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $row_count = $row_count++;
                                    ?>
                                                <tr>
                                                    <td><?php echo $row['codigoBarras']; ?></td>
                                                    <td><?php echo $row['nombre']; ?></td>
                                                    <td><?php echo $row['precio']; ?></td>
                                                    <td><?php echo $row['empresa']; ?></td>
                                                    <?php if ($row['stockBasico'] <= $row['existencia']) { ?>

                                                        <td style="background-color: #21822A;color:#fff;"><?php echo $row['existencia']; ?></td>

                                                    <?php } ?>
                                                    <?php if ($row['stockMinimo'] < $row['existencia'] && $row['stockBasico'] > $row['existencia']) { ?>

                                                        <td style="background-color: #f3c915;color:#fff;"><?php echo $row['existencia']; ?></td>

                                                    <?php } ?>

                                                    <?php if ($row['stockMinimo'] >= $row['existencia']) { ?>

                                                        <td style="background-color: #BB2D3B;color:#fff;"><?php echo $row['existencia']; ?></td>

                                                    <?php } ?>
                                                    <td><a class="btn btn" style="Background-color:#21822A;color:#ffffff;" href="update.php?id=<?php echo $row['idProducto']; ?>"><i class="fa fa-edit"></i></a></td>
                                                    <td><a class="btn btn-danger" href="../../Controller/producto/delete.php?id=<?php echo $row['idProducto']; ?>"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            echo "<br>Resultados encontrados: Ninguno";
                                        }
                                    } else {
                                        if (isset($query)) {
                                            while ($row = $rs_result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['codigoBarras']; ?></td>
                                                    <td><?php echo $row['nombre']; ?></td>
                                                    <td><?php echo $row['precio']; ?></td>
                                                    <td><?php echo $row['empresa']; ?></td>

                                                    <?php if ($row['stockBasico'] <= $row['existencia']) { ?>

                                                        <td style="background-color: #21822A;color:#fff;"><?php echo $row['existencia']; ?></td>

                                                    <?php } ?>
                                                    <?php if ($row['stockMinimo'] < $row['existencia'] && $row['stockBasico'] > $row['existencia']) { ?>

                                                        <td style="background-color: #f3c915;color:#fff;"><?php echo $row['existencia']; ?></td>

                                                    <?php } ?>

                                                    <?php if ($row['stockMinimo'] >= $row['existencia']) { ?>

                                                        <td style="background-color: #BB2D3B;color:#fff;"><?php echo $row['existencia']; ?></td>

                                                    <?php } ?>


                                                    <td><a class="btn btn" style="Background-color:#21822A;color:#ffffff;" href="update.php?id=<?php echo $row['idProducto']; ?>"><i class="fa fa-edit"></i></a></td>
                                                    <td><a class="btn btn-danger" href="../../Controller/producto/delete.php?id=<?php echo $row['idProducto']; ?>"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                    <?php }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation example" style="left: 30%;">
                            <div class="pagination" style="overflow: auto; width: 100%;
                        height: 100px;">
                                <?php

                                $query = "SELECT COUNT(*) FROM producto";
                                $rs_result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_row($rs_result);
                                $total_records = $row[0];

                                echo "</br>";
                                // Number of pages required.
                                $total_pages = ceil($total_records / $per_page_record);
                                $pagLink = "";

                                if ($page >= 2) {
                                    echo "<li class='page-item'><a class='page-link' style='color:white; background-color:#7a7a7a;' href='read.php?page=" . ($page - 1) . "'> Anterior </a></li>";
                                }

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $page) {
                                        $pagLink .= "<li class='page-item'><a style='color:white; background-color:#7a7a7a;' class = 'page-link active' href='read.php?page=" . $i . "'>" . $i . " </a></li>";
                                    } else {
                                        $pagLink .= "<li class='page-item'><a style='color:white; background-color:#7a7a7a;' class='page-link'href='read.php?page=" . $i . "'>   
                                                " . $i . " </a></li>";
                                    }
                                };
                                echo $pagLink;
                                if ($page < $total_pages) {
                                    echo "<li class='page-item'><a  style='color:white; background-color:#7a7a7a;' class='page-link' href='read.php?page=" . ($page + 1) . "'>  Siguiente </a></li>";
                                } ?>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>