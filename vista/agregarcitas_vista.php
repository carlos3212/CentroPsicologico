<?php
 // Obteniendo la fecha actual del sistema con PHP
 $fechaActual = date('d-m-Y');
 
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA CONSULTORIOS
$consultorio = $conexion -> prepare("SELECT * FROM consultorios");

$consultorio ->execute();
$consultorio = $consultorio ->fetchAll();
if(!$consultorio)
	$mensaje .= 'No hay consultorios, por favor registre primero! <br />';
//SELECT PARA MEDICOS
$medicos = $conexion -> prepare("SELECT * FROM medicos");

$medicos ->execute();
$medicos = $medicos ->fetchAll();
if(!$medicos)
	$mensaje .= 'No hay medicos, por favor registre primero! <br />';

include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MEDICOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Cita</h2>
						<input required type="numeric" name="identificacion" placeholder="identificación:">
						<input required type="text" name="nombres" placeholder="Nombres:">
						<input required type="text" name="apellidos" placeholder="Apellidos:">
						<input type="date" name="fechaCita" min="2022-01-14" placeholder="Fecha Cita:">
						<input required type="text" name="hora" placeholder="Hora:">
						<select name="consultorio" class="mayusculas" required> 
	                        <?php foreach ($consultorio as $Sql2): ?>
							<?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
						<select name="medico" class="mayusculas" required> 
	                        <?php foreach ($medicos as $Sql): ?>
							<?php echo "<option value='". $Sql['mednombres']. "'>". $Sql['mednombres']." ". $Sql['medapellidos']. "</option>"; ?>
							<?php endforeach; ?>
                        </select>
						<select name="estado">
                            <option value="Asignado">Asignado</option>
							<option value="Atendido">Atendido</option> 
                        </select>
						<input type="submit" name="enviar" value="Agregar Cita">
						
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