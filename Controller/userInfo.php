<?php
// Consulta para Mostrar el Usuario
$idUsuario = $_SESSION["id_usuario"];
$sql = "SELECT idUsuario,usuario FROM usuario  WHERE idUsuario ='$idUsuario'";
$result = $mysqli->query($sql);
$rowUser = $result->fetch_assoc();