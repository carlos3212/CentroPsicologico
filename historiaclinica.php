<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}
require 'vista/Medical_Appointment_Form_in_Spanish.php';

?>