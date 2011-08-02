<div id="contacto">
	<div class="texto">
	<h1>Contáctenos</h1>
	<p>
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
	<div class="atrapa">
		<?php echo $html->image("atrapa.png");?>
		<div style="clear:both"></div>
	</div>
	<?php echo $form->create("Page",array("action"=>"contacto","controller"=>"pages"));?>
		<?php echo $form->input("nombre_contacto",array('div' => 'nombre-contacto',"label"=>"Nombre (s):"));?>
		<?php echo $form->input("email",array('div' => 'email-contacto',"label"=>"E-mail:"));?>
		<?php echo $form->input("telefono",array('div' => 'telefono-contacto',"label"=>"Teléfono:"));?>
		<div style="clear:both;"></div>
		<?php echo $form->input("comentario",array('type'=>'textarea','div' => 'comentario-contacto',"label"=>"Comentario (s)"));?>
		<div style="clear:both;"></div>
		<?php echo $form->end(__('Envíar', true), array('div' => false));?>
	</div>
	<div style="clear:both;"></div>
</div>
