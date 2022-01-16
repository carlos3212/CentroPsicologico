<?php session_start();

if (isset($_SESSION['usuario'])){
	header('Location: index.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$usuario =  $_POST['usuario'];
	$password = $_POST['password'];
	$password = hash('sha512', $password);
	$errores ='';	
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$statement = $conexion -> prepare(
			'SELECT * FROM medicos WHERE medidentificacion= :usuario AND pass= :password');

	$statement ->execute(array(':usuario'=> $usuario,':password'=> $password));

	$resultado = $statement->fetch();
	if($resultado !==false){
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	}else{
		$errores .= 'Datos incorrectos y/o invalidos!';
	}
}
	require 'vista/login.php';
?>