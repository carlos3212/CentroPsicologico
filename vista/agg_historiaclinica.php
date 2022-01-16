<?php include 'plantillas/header.php'; 

extract ($_REQUEST);
$busca =$_SESSION['usuario'];
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//Medico
$consulta = $conexion -> prepare("
SELECT * FROM `medicos` WHERE medidentificacion = $busca and mednombres = mednombres");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY medicos PARA MOSTRAR';
}
//Paciente

$paciente = $conexion -> prepare("SELECT * FROM pacientes WHERE idPaciente = '$_REQUEST[idPaciente]'");

$paciente ->execute();
$paciente = $paciente ->fetchAll();
if(!$paciente)
	$mensaje .= 'No hay paciente, por favor registre primero! <br />';


	 

?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Historia Clinica</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Historia Clinica</h2>
                        <select name="psicAsignado">  
                        <?php foreach ($consulta as $Sql): ?>
						<?php echo "<option value='". $Sql['mednombres']. "'>". $Sql['mednombres']. "</option>"; ?>
						<?php endforeach; ?>
						</select>
						
                        <input required type="text" name="servicio" placeholder="Servicio:">
                        <select name="numHistoria">  
                        <?php foreach ($paciente as $Sql): ?>
						<?php echo "<option value='". $Sql['pacIdentificacion']. "'>". $Sql['pacIdentificacion']. "</option>"; ?>
						<?php endforeach; ?>
						</select>
                        <input required type="text" name="perServicio" placeholder="Persona soliciata el servicio:">
                        <input required type="text" name="perParentesco" placeholder="Parentesco soliciata el servicio:">
                        <select name="pacNombre">  
                        <?php foreach ($paciente as $Sql): ?>
						<?php echo "<option value='". $Sql['pacNombre']. "'>". $Sql['pacNombre']. "</option>"; ?>
						<?php endforeach; ?>
						</select>
					    <select name="pacfechaNcimiento">  
                        <?php foreach ($paciente as $Sql): ?>
						<?php echo "<option value='". $Sql['pacFechaNacimiento']. "'>". $Sql['pacFechaNacimiento']. "</option>"; ?>
						<?php endforeach; ?>
						</select>
                        <select name="pacCi">  
                        <?php foreach ($paciente as $Sql): ?>
						<?php echo "<option value='". $Sql['pacIdentificacion']. "'>". $Sql['pacIdentificacion']. "</option>"; ?>
						<?php endforeach; ?>
						</select>
                        <select name="pacEdad">  
                        <?php foreach ($paciente as $Sql): ?>
                            
                            <?php
                                $fechaActual = date('Y-m-d');

                                $edad =  $fechaActual - $Sql['pacFechaNacimiento']  ?>
						<?php echo "<option value='".$edad . "'>". $edad. "</option>"; ?>
						<?php endforeach; ?>
						</select>
                        <select name="sexo">  
                        <?php foreach ($paciente as $Sql): ?>
						<?php echo "<option value='". $Sql['pacSexo']. "'>". $Sql['pacSexo']. "</option>"; ?>
						<?php endforeach; ?>
                        <input required type="text" name="pacEstCivil" placeholder="Estado Civil Paciente:">
                        <input required type="text" name="pacEscolaridad" placeholder="Nivel de Estudios:">
                        <input required type="text" name="pacIstitucionEdu" placeholder="Institución Educativa Paciente:">
					    <input required type="text" name="pacOcupacion" placeholder="Ocupación Paciente:">
                        <input required type="text" name="pacIstitucionLab" placeholder="Institución Laboral Paciente:">
					    <input required type="text" name="pacDireccion" placeholder="Dirección Paciente:">
					    <input required type="numeric" name="pacCel" placeholder="Numero Telefono:">
                        <input type="date" name="fechaPropuesta" placeholder="Fecha Propuesta:">
                        <input required type="text" name="horarioAtencion" placeholder="Horario de atención:"> 
                        <input required type="numeric" name="valor" placeholder="Valor Consulta:">
                        <textarea required type="text" name="motCOnsulta" placeholder="Motivo Consulta:"></textarea>
                        <textarea required type="text" name="pacVida" placeholder="Vida Paciente:"></textarea>
                        <textarea required type="text" name="tratamiento" placeholder="Programa a tratar:"></textarea>
                      

					   
					   
					   

						<input type="submit" name="enviar" value="Agregar Paciente">
						
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>