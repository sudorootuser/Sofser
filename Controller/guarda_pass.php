<?php 
require '../Model/Conexion.php';
require '../Controller/funcs.php';

$user_id=$mysqli->real_escape_string($_POST['user_id']);
$password=$mysqli->real_escape_string($_POST['password']);
$con_password=$mysqli->real_escape_string($_POST['con_password']);


if (validaPassword($password,$con_password)) {
    $pass_hash=hashPassword($password);
    if (cambiarPassword($pass_hash,$user_id)) {
        echo "<script>alert('Su contraseña se ha modificado con Éxito');window.location='../View/login.php'</script>";
    }else{
        echo "<script>alert('Error al modificar password');window.location='../View/cambia_pass.php'</script>";
    }
}else{
    echo "<script>alert('Las contraseñas no coinciden');window.location='../View/cambia_pass.php'</script>";

}
   