<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = filter_var(strtolower($_POST['nombres']),FILTER_SANITIZE_STRING);
	$apellidos = $_POST['apellidos'];
	$identificacion =  $_POST['identificacion'];
	$fecha =  $_POST['fechaCita'];
	$hora =  $_POST['hora'];
	$consultorio =  $_POST['consultorio'];
	$medico =  $_POST['medico'];
	$estado =  $_POST['estado'];
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
			'SELECT * FROM citas WHERE citIdentificacion = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje.='Ya existe una cita con esa identificación </br>';
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO citas
		values(null, :id,:nombre,:apellidos,:fecha,:hora,:consultorio,:medico, :estado)');

		$statement ->execute(array(
		':id'=>$identificacion,
		':nombre'=> $nombre,
		':apellidos'=>$apellidos,
		':fecha'=>$fecha,
		':hora'=>$hora,
		':consultorio'=> $consultorio,
		':medico'=> $medico,
		':estado'=> $estado
		));
		header('Location: citas.php');
	}
}
require 'vista/agregarcitas_vista.php';
?>