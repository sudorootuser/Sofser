<?php 
session_start();
include_once '../Controller/funcs.php';

// $user = $_SESSION["id_usuario"];

// print_r($user);die;
if (!isset($_SESSION["id_usuario"])) {
  header('Location:login.php');
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg" style=" background: #000">
<div class="container-fluid">
        <div class="col-3">
            <a href="home.php"><img src="../Resource/img/LOGO_BLANCO.png" width="70px" height="auto" style="margin-left: 25px;"></a>
        </div>
        <div class="col-3">
            
        </div>
        <div class="col-6">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Registro
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="vender/registro.php">Compras</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="vender/registro.php">Ventas</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Almacenamiento
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="Bodega/read.php">Bodega</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="Vitrina/read.php">Vitrina</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Listado
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="proveedores/read.php">Proveedores</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="productos/read.php">Productos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="comprar/create.php">Comprar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="vender/create.php">Vender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../controller/cerrarSesion.php">Cerrar Sesion</a>
                </li>
            </ul>
            
        </div>
        </div>
        
    </div>
</nav>