<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="corner">
		<h1 class="titulo-amarillo">Contáctenos</h1>
		<div class="forms">
			<div class="texto">
				<p>
					En llévatelos.com intentamos solucionar tus
					interrogantes o inconvenientes de la manera
					más rápida, eficiente y clara.
				</p>
				<br>
				<p>	
					Si tienes dudas revisa nuestra sección de &nbsp;&nbsp;
					 <?php echo $html->link("Preguntas Frecuentes",array("controller"=>"pages","action"=>"view","faq"),array("style"=>"margin-left:3px;"))?>.
				</p>
			</div>
			<div class="formulario">
				<?php echo $form -> create("Page", array("action" => "contacto", "controller" => "pages"));?>
				<?php echo $form -> input("nombre_contacto", array("label" => "Nombre (s):"));?>
				<?php echo $form -> input("email", array( "label" => "E-mail:"));?>
				<?php echo $form -> input("telefono", array( "label" => "Teléfono:"));?>
				<div style="clear:both;">
				</div>
				<?php echo $form -> input("comentario", array('type' => 'textarea', "label" => "Comentario (s)"));?>
				<div style="clear:both;">
				</div>
				<?php echo $form -> end(__('Envíar', true), array('div' => false));?>
			</div>
			<div style="clear:both;">
			</div>
		</div>
	</div>
</div>

