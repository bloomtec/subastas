<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="corner contact">
		<h1 class="titulo-amarillo">Contáctanos</h1>
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
				<?php echo $form -> create("Page", array("action" => "contacto", "controller" => "pages","id"=>"contacto-form","novalidate"=>"novalidate"));?>
				<?php echo $form -> input("nombre_contacto", array("label" => "Nombre (s):","required"=>"required"));?>
				<div class="input text">
					<label for="email">E-mail:</label>
					<input type="email" required="required" name="data[Page][email]" id="email"/>
				</div>
				<?php echo $form -> input("telefono", array( "label" => "Teléfono:","required"=>"required"));?>
				<div style="clear:both;">
				</div>
				<?php echo $form -> input("comentario", array('type' => 'textarea', "label" => "Comentario (s)","required"=>"required"));?>
				<div style="clear:both;">
				</div>
				<?php echo $form -> end(__(' ', true), array('div' => false));?>
			</div>
			<div style="clear:both;">
			</div>
		</div>
	</div>
</div>

