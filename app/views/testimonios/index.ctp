<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
<div class="corner">
<h1 class="titulo-amarillo">Testimonios</h1>
	<?php foreach($testimonios as $testimonio):?>
		<div class="testimonio">
			<div class="image">
				<?php echo $html->image($testimonio["Testimonio"]["imagen_path"]);?>
			</div>
			<div class="info">
				<h2><?php echo $testimonio["Testimonio"]["titulo"]?></h2>
				<div class="escrito">
				<?php echo $testimonio["Testimonio"]["texto"]?>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	<?php endforeach;?>
</div>
</div>