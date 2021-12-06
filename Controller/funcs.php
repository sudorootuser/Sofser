<?php

function cambiarPassword($pass_hash, $user_id)
{

	//print_r($user_id);die;
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE usuario SET password = ? WHERE idUsuario = ?");
	$stmt->bind_param('si', $pass_hash, $user_id);

	

	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}

function isNull($nombre,$documento, $email, $pass, $pass_con)
{
	if (strlen(trim($nombre)) < 1 || strlen(trim($documento)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1) {
		return true;
	} else {
		return false;
	}
}

function isEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function validaPassword($var1, $var2)
{
	if (strcmp($var1, $var2) !== 0) {
		return false;
	} else {
		return true;
	}
}

function minMax($min, $max, $valor)
{
	if (strlen(trim($valor)) < $min) {
		return true;
	} else if (strlen(trim($valor)) > $max) {
		return true;
	} else {
		return false;
	}
}

function usuarioExiste($usuario)
{
	global $mysqli; //valida desde la conexion 

	$stmt = $mysqli->prepare("SELECT idUsuario FROM usuario WHERE usuario = ? LIMIT 1");
	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function emailExiste($email)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT idUsuario FROM usuario WHERE correo = ?  LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function docExiste($documento)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT idUsuario FROM usuario WHERE cedula = ?  LIMIT 1");
	$stmt->bind_param("s", $documento);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function generateToken()
{
	$gen = md5(uniqid(mt_rand(), false));
	return $gen;
}

function hashPassword($password)
{
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

function resultBlock($errors)
{
	if (count($errors) > 0) {
		echo "<div id='error' class='alert alert-danger alert-dismissible fade show' role='alert'>
			
			<ul>";
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function registraUsuario($usu, $doc,$ema, $pass, $tok)
{

	global $mysqli;

	$stmt = $mysqli->prepare("INSERT INTO usuario (usuario,cedula,correo,password, token) VALUES (?,?,?,?,?)");
	$stmt->bind_param('ssssi', $usu, $doc,$ema, $pass, $tok);

	if ($stmt->execute()) {
		return $mysqli->insert_id;
	} else {
		return 0;
	}
}


function activarUsuario($idUsuario)
{
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE usuario SET activacion=1 WHERE idUsuario = ?");
	$stmt->bind_param('s', $idUsuario);
	$result = $stmt->execute();
	$stmt->close();
	return $result;
}


function isNullLogin($usuario, $password)
{
	if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
		return true;
	} else {
		return false;
	}
}

function login($usuario, $password)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT idUsuario, password FROM usuario WHERE correo = ? LIMIT 1");
	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {

			$stmt->bind_result($idUsuario, $passwd);
			$stmt->fetch();

			$validaPassw = password_verify($password, $passwd);

			if ($validaPassw) {
				session_start();
				$_SESSION['id_usuario'] = $idUsuario;

				header("location:home.php");
			} else {

				$errors = "La contraseña es <strong>Incorrecta!</strong>";
			}
	} else {
		$errors = "El nombre de usuario o correo electr&oacute;nico no <strong>Existe!</strong>";
	}
	return $errors;
}

function lastSession($idUsuario)
{
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE usuario SET last_session=NOW(), token_password='', password_request=0 WHERE idUsuario = ?");
	$stmt->bind_param('s', $idUsuario);
	$stmt->execute();
	$stmt->close();
}

function generaTokenPass($user_id)
{
	global $mysqli;

	$token = generateToken();

	$stmt = $mysqli->prepare("UPDATE usuario SET token_password=?, password_request=1 WHERE idUsuario = ?");
	$stmt->bind_param('ss', $token, $user_id);
	$stmt->execute();
	$stmt->close();

	return $token;
}

function getValor($campo, $campoWhere, $valor)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT $campo FROM usuario WHERE $campoWhere = ? LIMIT 1");
	$stmt->bind_param('s', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	} else {
		return null;
	}
}

function getPasswordRequest($idUsuario)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT password_request FROM usuario WHERE idUsuario = ?");
	$stmt->bind_param('i', $idUsuario);
	$stmt->execute();
	$stmt->bind_result($_id);
	$stmt->fetch();

	if ($_id == 1) {
		return true;
	} else {
		return null;
	}
}

function cambiaPassword($pass_hash, $user_id)
{
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE usuario SET password = ? WHERE idUsuario = ? ");
	$stmt->bind_param($pass_hash, $user_id);

	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}
