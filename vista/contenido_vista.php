
<?php /*
$busca =$_SESSION['usuario'];
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
SELECT * FROM `medicos` WHERE medidentificacion = $busca");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
 foreach ($consulta as $Sql): 
	
		echo $Sql['medidentificacion'];
		
		
	
	 endforeach
	 
?>

*/

 include 'plantillas/header.php'; ?>

	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
			
				<article>
					<div class="mensaje">
						<h2>Psicoludioc</h2>
						<h1>Centro Psicologico</h1>
					</div>
						<p><img src="img/psicoludic.png">
						</p><br/><br/>
						<p>Bienvenido a <b>CenterMedicine</b>! un Sistema de Citas Medicas util para consultorios medicos y/o medicos independientes.</p>
						<br/><br/>
						<h3>Nuestras funciones</h3><br/>
						<p>	- Gestion de Citas <br/>
							- Gestion de Medicos <br/>
							- Gestion de Pacientes <br/>
							- Gestion de Consultorios <br/>
							- Gestion de Usuarios con Acceso al Sistema <br/>
						</p>
				</article>
	</section>
	<?php include 'plantillas/footer.php'; ?>
</body>
</html>