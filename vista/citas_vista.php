<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM citas ORDER BY citFechaCita");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Citas</h2>
					</div>
					<a class="agregar" href="agregarcitas.php">Agregar Cita</a>
					<table class="tabla">
						  <tr>
							<th>Identificacion</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Fecha Cita</th>
							<th>Hora</th>
							<th>Consultorio</th>
							<th>Psicólogo</th>
							<th>Estado</th>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
							<?php echo "<td>". $Sql['citIdentificacion']. "</td>"; ?>
							<?php echo "<td>". $Sql['citNombres']. "</td>"; ?>
							<?php echo "<td>". $Sql['citApellidos']. "</td>"; ?>
							<?php echo "<td>". $Sql['citFechaCita']. "</td>"; ?>
							<?php echo "<td>". $Sql['citHora']. "</td>"; ?>
							<?php echo "<td>". $Sql['citConsultorio']. "</td>"; ?>
							<?php echo "<td>". $Sql['citMedico']. "</td>"; ?>
							<?php echo "<td>". $Sql['citEstado']. "</td>"; ?>
                            
						</tr>
						<?php endforeach; ?>
					</table>
							<?php  if(!empty($mensaje)): ?>
							  <ul>
								  <?php echo $mensaje; ?>
							  </ul>
							<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>