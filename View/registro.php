<html>

<head>
    <link rel="stylesheet" href="../Resource/css/registro.css">
</head>


<!-- Headers -->
<?php
include_once '../Resource/Header/Header_Index.php';
require '../Model/Conexion.php';
require '../Controller/funcs.php';
$errors = array();

if (!empty($_POST)) {
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $documento = $mysqli->real_escape_string($_POST['documento']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $con_password = $mysqli->real_escape_string($_POST['con_password']);

    $activo = 0;

    if (isNull($usuario, $documento, $email, $password, $con_password)) {
        $errors[] = "Hay campos vacios";
    }
    if (!isEmail($email)) {
        $errors[] = "Direcci&oacute;n de correo no Valida";
    }
    if (!validaPassword($password, $con_password)) {
        $errors[] = "Las contraseñas deben ser iguales";
    }
    if (emailExiste($email)) {
        $errors[] = "correo eletronico $email ya existe";
    }
    if (docExiste($documento)) {
        $errors[] = "documento de identidad $documento ya existe";
    }
    if (count($errors) == 0) {

        $pass_hash = hashPassword($password);
        $token = generateToken();

        $registro = registraUsuario($usuario, $documento, $email, $pass_hash, $token);

        echo "<script>alert('Creación de Cuenta Exitosa');window.location='login.php'</script>";
    } else {
        $errors[] = "ERROR AL CARGAR EL REGISTRO";
    }
}

?>

<body>
    <div class="box">
        <div class="row content">
            <div class="col-4 Lateral">

            </div>
            <div class="col-4 text-center" >
                <br>
                <br>
                <br><br><br><br><br><br>
                <div class="card" style="border: 3px solid #a3a3a3;border-radius: 25px;">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <img src="Recursos/Imagenes/LOGO FARMA PNG.png" class="img-fluid" style="width: 15%;"> -->
                        </div>
                        <h3>REGISTRAR USUARIO</h3>
                        <!-- Mensaje de Alerta -->
                        <?php echo resultBlock($errors); ?>
                        <!-- Fin alerta -->
                    </div>
                    <div class="card-body" style="border-radius: 20px">
                        <form id="loginform" class="form-login" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

                            <div class="input-group mb-3">

                                <input type="text" name="usuario" class="form-control" placeholder="Nombre Completo" aria-label=" Usuario" aria-describedby="basic-addon1" value="<?php if (isset($usuario)) echo $usuario; ?>" required />
                            </div>
                            <div class="input-group mb-3">

                                <input type="text" name="documento" maxlength="10" class="form-control" placeholder="Documento de identidad" aria-label="documento" aria-describedby="basic-addon1" value="<?php if (isset($documento)) echo $documento; ?>" required />
                            </div>
                            <div class="input-group mb-3">

                                <input type="email" name="email" class="form-control" placeholder="Correo Eletronico" aria-label="Correo Eletronico" aria-describedby="basic-addon1" value="<?php if (isset($email)) echo $email; ?>" required />
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1" required />
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="con_password" class="form-control" placeholder="Confirmar Contraseña" id="myPassword" aria-label="Contraseña" aria-describedby="basic-addon1" required />
                            </div>
                            <button type="submit" class="btn" style="background-color: #2196f3;color: #ffffff;width: 100%;font-weight: bold;">Registrarse</button>
                            <div class="botones_regresos mt-3">
                                <a href="login.php" class="old">
                                    <center>Tienes una cuenta inicia aquí !!</center>
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