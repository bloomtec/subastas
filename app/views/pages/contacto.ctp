<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="corner">
		<h1 class="titulo-amarillo">Contáctenos</h1>
		<div class="forms">
			<div class="texto">
				<p style="font-size:20px;">
					En llévatelos.com intentamos solucionar tus
					interrogantes o inconvenientes de la manera
					más rápida, eficiente y clara.
					Si tienes dudas revisa nuestra sección de
					<span>Preguntas frecuentes.</span>
					Nuestra razón de ser es ofrecer una novedosa
					forma de comprar de una manera divertida para
					los usuarios.
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

