<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$identificacion =  $_POST['identificacion'];
	$nombre = filter_var(strtolower($_POST['nombres']),FILTER_SANITIZE_STRING);
	$apellidos = $_POST['apellidos'];
	$especialidad =  $_POST['especialidad'];
	$telefono =  $_POST['telefono'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$correo =  $_POST['correo'];
	$roll = $_POST['roll'];	
	$mensaje='';
	if(empty($nombre) or empty($apellidos)  or empty($identificacion)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

		$statement = $conexion -> prepare(
			'SELECT * FROM medicos WHERE idMedico = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='El nombre de usuario ya existe </br>';

		}

		$password = hash('sha512',$password);
		$password2 = hash('sha512',$password2);
		if($password2 != $password){
			$errores .= '<li>Las contraseñas no son iguales</li>';
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO medicos (idMedico, medidentificacion, mednombres
		, medapellidos, medEspecialidad, medtelefono, pass, medcorreo, Roll)
		values(null, :id,:nombre,:apellidos,:especialidad,:telefono,:password2
		,:correo,:roll)');

		$statement ->execute(array(
		':id'=>$identificacion,
		':nombre'=> $nombre,
		':apellidos'=>$apellidos,
		':especialidad'=>$especialidad,
		':telefono'=>$telefono,
		':password2'=>$password2,
		':correo'=>$correo,
		':roll'=>$roll
		));
		header('Location: medicos.php');
	}
}
require 'vista/agg_medicos_vista.php';
?>