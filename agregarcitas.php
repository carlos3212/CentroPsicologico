<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){

	$citfecha = $_POST['fecha'];
	$cithora = $_POST['hora'];
	$citPaciente =  $_POST['paciente'];
	$citMedico =  $_POST['medico'];
	$citConsultorio =  $_POST['consultorio'];
	$citestado =  $_POST['estado'];
	$citobservaciones =  $_POST['observaciones'];
	$mensaje='';

	if(empty($citfecha) or empty($cithora)  or empty($citConsultorio) or empty($citPaciente) or empty($citestado)or empty($citMedico)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
			'INSERT INTO citas values(null, :citfecha,:cithora,:citPaciente,:citMedico,:citConsultorio,:citestado,:citobservaciones)');

		$statement ->execute(array(
			':citfecha'=>$citfecha,
			':cithora'=>$cithora,
			':citPaciente'=>$citPaciente,
			':citMedico'=>$citMedico,
			':citConsultorio'=>$citConsultorio,
			':citestado'=>$citestado,
			':citobservaciones'=>$citobservaciones
		));

		#print_r($statement->errorInfo());exit;

		header('Location: citas.php');
	}
}
require 'vista/agregarcitas_vista.php';
?>
