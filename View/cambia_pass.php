<html>
<!-- <link rel="icon" type="image/png" href="Recursos/Imagenes/LOGO PASION DEPORTIVA COMPLETO2.png" /> -->

<head>
    <link rel="stylesheet" href="../Resource/css/registro.css">
</head>
<!-- Headers -->
<?php
include_once '../Resource/Header/Header_Index.php';
require '../Controller/funcs.php';

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
                        <div class="card-title" >
                            <h3>CAMBIO DE CONTRASEÑA</h3>
                        </div>
                    </div>
                    <div class="card-body" >
                        <form id="loginform" class="form-login" role="form" action="../Controller/guarda_pass.php" method="POST" autocomplete="off">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
                            <div class="input-group mb-3">
                                <input type="password"  name="password" class="form-control" placeholder="Nueva Contraseña" aria-label="newpassword" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <input type="password"  name="con_password" class="form-control" placeholder="Confirmar Contraseña" aria-label="conpassword" aria-describedby="basic-addon1">
                            </div>
                            
                            <input type="submit" class="btn" style="background-color: #2196f3;color: #fff;width: 100%;font-weight: bold;" value="Modificar">
                            <br>
                            <div class="botones_regresos mt-3">
                                <a href="login.php" class="old">
                                    <center>Iniciar Sesion !!</center>
                                </a>
                            </div>
                            <div class="botones_regreso">
                                <a href="registro.php" class="old">
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