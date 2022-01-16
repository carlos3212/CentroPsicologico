<?php session_start();
if(isset($_SESSION['usuario'])){
	require 'vista/citas_vista.php';
}else{
	header('Location: login.php');
}
?>