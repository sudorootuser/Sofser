<html>
<!-- <link rel="icon" type="image/png" href="Recursos/Imagenes/LOGO PASION DEPORTIVA COMPLETO2.png" /> -->
<!-- Headers -->

<head>
    <link rel="stylesheet" href="../Resource/css/login.css">
</head>

<?php
include_once '../Resource/Header/Header_Index.php';

require '../Model/Conexion.php';
require '../Controller/funcs.php';

$errors = array();
if (!empty($_POST)) {
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $password = $mysqli->real_escape_string($_POST['password']);

    if (isNulllogin($usuario, $password)) {
        $errors[] = "Debe diligenciar los campos";
    }

    $errors[] = login($usuario, $password);
}
?>

<body>
    <div class="box">
        <div class="row content">
            <div class="col-4 Lateral">

            </div>
            <div class="col-4 text-center">
                <br>
                <br>
                <br><br><br><br><br><br><br><br><br><br>
                <div class="card" style="border: 3px solid #a3a3a3; border-radius: 25px;">
                    <div class="card-header" >
                        <div class="card-title">
                            <!-- <img src="Recursos/Imagenes/LOGO FARMA PNG.png" class="img-fluid" style="width: 15%;"> -->
                        </div>
                        <h3>INICIAR SESIÓN</h3>
                        <!-- Mensaje de Alerta -->
                        <?php echo resultBlock($errors); ?>
                        <!-- Fin alerta -->
                    </div>
                    <div class="card-body" >
                        <form id="loginform" class="form-login" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            <div class="mb-3 text-left">
                                <input type="text" name="usuario" class="form-control" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="mb-3 text-left">
                                <input type="password" name="password" class="form-control" placeholder="Contraseña..." aria-label="password" aria-describedby="basic-addon1">
                            </div>
                            <button type="submit" class="btn" style="background-color: #2196f3;color: white;width: 100%;">Ingresar</button>
                            <br>
                            <div class="botones_regresos mt-3">
                                <a href="recupera.php" class="old text-center">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                            <div class="botones_regreso">
                                <a href="registro.php" class="old text-center">
                                    ¿No tienes una cuenta?,¡Registrate!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4 Lateral">

            </div>
        </div>
    </div>
</body>

</html>