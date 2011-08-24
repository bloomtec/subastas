<div id="left-content">
		 <?php echo $this->element("referidos");?>
	 <?php echo $this->element("seguridad");?>
</div>
<div id="right-content" class="pages">
<h1 class="titulo-amarillo">INACTIVIDAD</h1>
<div class="WYSIWYG inactivity">
	<p>
		No has tenido actividad por 15 minutos ¿sigues ahí?
	</p>
	<div class="continuar"><?php echo $html->link($html->image("continuar.png"),"/",array("escape"=>false));?></div>
</div>
</div>

