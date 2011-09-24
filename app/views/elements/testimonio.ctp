<div class="testimonio estilo-borde">
	<?php debug("HOLA"); ?>
	<?php $user_id = $this-> requestAction('/users/readCookieUserID'); debug($user_id); ?>
	<?php $testimonio=$this->requestAction("testimonios/random");?>
	<h1 class="titulo-amarillo">Testimonios</h1>
	<?php echo $html->image($testimonio["Testimonio"]["imagen_path"],array("width"=>150))?>
	<?php echo $html->link($testimonio["Testimonio"]["titulo"],array("controller"=>"testimonios","action"=>"index"))?>
</div>