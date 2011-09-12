<div class="testimonio estilo-borde">
	<?php $testimonio=$this->requestAction("testimonios/random");?>

	<h1 class="titulo-amarillo">Testimonios</h1>
	<?php echo $html->image($testimonio["Testimonio"]["imagen_path"],array("width"=>150))?>
	<?php echo $html->link($testimonio["Testimonio"]["titulo"],array("controller"=>"testimonios","action"=>"index"))?>
</div>