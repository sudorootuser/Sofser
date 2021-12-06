<?php
if (!isset($_POST["month1"]) || !isset($_POST["month2"])) {
	exit;
}
$desde = $_POST["month1"];
$hasta = $_POST["month2"];

?>

<html id="prueba">

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

$sentencia = $base_de_datos->query("SELECT compra.totalCompra, compra.fechaCompra, compra.idCompra, GROUP_CONCAT(	producto.codigoBarras, '..',  producto.nombre,'..', producto_compra.cantidad,'..', producto_compra.proveedor_idProveedor SEPARATOR '__') AS producto FROM compra INNER JOIN producto_compra ON producto_compra.compra_idcompra = compra.idCompra INNER JOIN producto ON producto.idProducto = producto_compra.producto_idProducto WHERE compra.fechaCompra BETWEEN '$desde' AND '$hasta' GROUP BY compra.idCompra ORDER BY compra.idCompra DESC;");
$compra = $sentencia->fetchAll(PDO::FETCH_OBJ);

$cantidad = count($compra);

$total_suma = 0;

foreach ($compra as $cantidades) {

	$total_suma += $cantidades->totalCompra;
}
$cantidad = $total_suma / $cantidad;

?>

<body style="background-color: #fff">
	<?php
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<br>
			</div>
		</div>
		<div class="row">

			<div class="col-2">

			</div>

			<div class="col-8" style="overflow-y:auto; height: 800px;">
				<h4 style="background-color: #7a7a7a; color:#ffffff; padding:13px; text-align:center;">REGISTRO DE COMPRAS</h4>
				<br>
				<div class="row">
					<div class="col-11">
						<form action="filtro.php" method="post">
							<div class="row g-3 align-items-center">
								<div class="col-auto">
									<label for="inputPassword6" class="col-form-label">DESDE</label>
								</div>
								<div class="col-auto">

									<input type="date" class="form-control" name="month1" id="month1">

								</div>


								<div class="col-auto">
									<label for="inputPassword6" class="col-form-label">HASTA</label>
								</div>
								<div class="col-auto">

									<input type="date" class="form-control" name="month2" id="month2">

								</div>

								<div class="col-auto">
									<button type="submit" style="background: #F3C915;color:#fff;" class="btn">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-1">
						<a class="btn btn-success btn-block" href="create.php" style="background-color:#21822A;color:#fff;margin-bottom: 20px;">NUEVO </a>
					</div>
				</div>

				<table class="table text-center">
					<thead class="thead-dark">
						<tr>
							<th>Número</th>
							<th>Fecha</th>
							<th>producto vendidos</th>
							<th>Total</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($compra as $compra) { ?>
							<tr>
								<td><?php echo $compra->idCompra ?></td>
								<td><?php echo $compra->fechaCompra ?></td>
								<td>
									<table class="table text-center">
										<thead class="thead-dark">
											<tr>
												<th>Código</th>
												<th>Descripción</th>
												<th>Cantidad</th>
												<th>proveedor</th>

											</tr>
										</thead>
										<tbody>
											<?php foreach (explode("__", $compra->producto) as $productoConcatenados) {
												$producto = explode("..", $productoConcatenados)
											?>
												<tr>
													<td><?php echo $producto[0] ?></td>
													<td><?php echo $producto[1] ?></td>
													<td><?php echo $producto[2] ?></td>
													<td><?php echo $producto[3] ?></td>

												</tr>
											<?php } ?>


										</tbody>
									</table>
								</td>
								<td>$<?php echo $compra->totalCompra ?></td>
								<td><a class="btn btn-danger" href="<?php echo "../../Controller/comprar/eliminarCompra.php?id=" . $compra->idCompra ?>"><i class="fa fa-trash"></i></a></td>
							</tr>
						<?php } ?>

						<tr>
							<td></td>
							<td></td>
							<td></td>

							<th>Promedio</th>
							<td></td>

						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<th>$<?php echo $cantidad; ?></th>
							<td></td>

						</tr>
					</tbody>
				</table>

			</div>

			<div class="col-1">

			</div>
		</div>

	</div>
	</div>

</body>

</html>