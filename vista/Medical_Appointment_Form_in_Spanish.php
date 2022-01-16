<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM medicos ORDER BY medidentificacion");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY MEDICOS PARA MOSTRAR';
}
?>
<?php include 'historiaclinica/heade.php'; ?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
  <form1 class="jotform-form" action="https://submit.jotform.com/submit/220145557252653/" method="post" name="form_220145557252653" id="220145557252653" accept-charset="utf-8" autocomplete="on">
  <input type="hidden" name="formID" value="220145557252653" />
  <input type="hidden" id="JWTContainer" value="" />
  <input type="hidden" id="cardinalOrderNumber" value="" />
  <div role="main" class="form-all">
    <ul1 class="form-section page-section">
      <li id="cid_1" class="form-input-wide" data-type="control_head">
        <div style="display:table;width:100%">
          <div class="form-header-group hasImage header-default" data-imagealign="Left">
            <div class="header-logo">
              <img src="https://www.jotform.com/uploads/promomsiv/form_files/medicos_6.5b6a7d5e39e095.56719926.jpg" alt="" width="309" class="header-logo-left" />
            </div>
            <div class="header-text httal htvam">
              <h2 id="header_1" class="form-header" data-component="header">
                Cita Medica Dra. Silvana Aurey
              </h2>
              <div id="subHeader_1" class="form-subHeader">
                Médica General
              </div>
            </div>
          </div>
        </div>
      </li>
      <li id="cid_22" class="form-input-wide" data-type="control_head">
        <div class="form-header-group  header-default">
          <div class="header-text httal htvam">
            <h2 id="header_22" class="form-header" data-component="header">
              Datos de la consulta
            </h2>
          </div>
        </div>
      </li>
 </form></article>
				
	</section>
<?php include 'plantillas/footer.php'; ?>


