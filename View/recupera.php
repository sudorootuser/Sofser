<html>
<!-- <link rel="icon" type="image/png" href="Recursos/Imagenes/LOGO PASION DEPORTIVA COMPLETO2.png"/> -->

<head>
    <link rel="stylesheet" href="../Resource/css/login.css">
</head>
<!-- Headers -->
<?php
include_once '../Resource/Header/Header_Index.php';

require '../Model/Conexion.php';
require '../Controller/funcs.php';

$errors = array();

if (!empty($_POST)) {
    $email = $mysqli->real_escape_string($_POST['email']);
    if (!isEmail($email)) {
        $errors[] = "Debe ingresar un correo electronico valido";
    }
    if (emailExiste($email)) {
        $user_id = getValor('idUsuario', 'correo', $email);
        $nombre = getValor('usuario', 'correo', $email);
        header("Location:cambia_pass.php?user_id=" . $user_id);

        echo "<script>alert('Validacion Del correo Exitosa.');window.location='inicio.php'</script>";
    } else {
        $errors[] = "El correo electronico no existe ";
    }
}
?>

<body style="overflow: hidden !important;">
    <div class="box">
        <div class="row content">
            <div class="col-3 Lateral">
            </div>
            <div class="col-6 text-center">
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="card" style="border: 3px solid #a3a3a3; border-radius: 25px;">
                    <div class="card-header">
                        <h3>RECUPERAR CONTRASEÑA</h3>
                        <!-- Mensaje de Alerta -->
                        <?php echo resultBlock($errors); ?>
                        <!-- Fin alerta -->
                    </div>
                    <!-- border: solid #006666 4px;border-radius: 0px 0px 20px 20px;" -->
                    <div class="card-body">
                        <form id="loginform" class="form-login" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="Correo" aria-label="Correo" aria-describedby="basic-addon1" required>
                            </div>
                            <button type="submit" class="btn" style="background-color: #2196f3;color: #ffffff;width: 100%;font-weight: bold;">Enviar</button>
                            <br>
                            <div class="botones_regresos mt-3">
                                <a href="login.php" class="old">
                                    <center>Iniciar Sesión</center>
                                </a>
                            </div>
                            <div class="botones_regreso">
                                <a href="registro.php" class="form-an-account">
                                    <center>¿No tienes una cuenta?,¡Registrate!</center>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>