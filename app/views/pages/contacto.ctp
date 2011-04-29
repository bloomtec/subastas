<div id="contacto">
	<?php echo $form->create("Page",array("action"=>"contacto","controller"=>"pages"));?>
	<fieldset>
		<legend>
			Formulario de contacto
		</legend>
		<p>Con el fin de conocer sus preguntas y opiniones sobre nuestros productos y servicios tanto en red como en nuestras tiendas, ponemos a su disposición esta sección en la cual podrá enviarnos sus comentarios y sugerencias, nuestro equipo de soporte estará atento para brindarle colaboración que usted necesite.</p>
		<?php echo $form->input("nombre_contacto",array('div' => 'nombre-contacto',"label"=>"Escribe tu (s) Nombre (s):"));?>
		<?php echo $form->input("email",array('div' => 'email-contacto',"label"=>"Dirección E-mail:"));?>
		<?php echo $form->input("telefono",array('div' => 'telefono-contacto',"label"=>"Teléfono:"));?>
		<div style="clear:both;"></div>
		<?php echo $form->input("comentario",array('type'=>'textarea','div' => 'comentario-contacto',"label"=>"Escribe tu (s) Comentario (s)"));?>
		<div style="clear:both;"></div>
		<?php echo $form->end(__('Envíar', true), array('div' => false));?>
	</fieldset>
	<div style="clear:both;"></div>
</div>
