<div id="footer_links">
	<ul>
		<li class="first">
			<?php echo $html -> link("Pagos seguros", array("controller" => "pages", "action" => "view", "pagos"));?>
		</li>

		<li >
			<?php echo $html -> link("Términos y Condiciones", array("controller" => "pages", "action" => "view", "terminos-condiciones"));?>
		</li>
		<li>
			<?php echo $html -> link("Privacidad", array("controller" => "pages", "action" => "view", "privacidad"));?>
		</li>
		
		<li>
			<?php //echo $html->link("Sobre Nosotros",array("controller"=>"pages","action"=>"view","sobre-nosotros"));?>
			<?php echo $html -> link("Preguntas Frecuentes", array("controller" => "pages", "action" => "view", "faq"));?>
		</li>
		
		<li>
			<?php echo $html -> link("Juego responsable", array("controller" => "pages", "action" => "view", "juego-responsable"));?>
		</li>
		
		<li>
			<?php
			echo $html -> link("Quienes Somos", array("controller" => "pages", "action" => "view", "quienes-somos"), array("class" => "other color como-funciona", ));
			?>
		</li>
		<li>
			<?php echo $html -> link("Contáctanos", array("controller" => "pages", "action" => "contacto"));?>
		</li>
		
		<li class="last">
			<?php echo $html -> link("Mapa del sitio", array("controller" => "pages", "action" => "view", "mapa"));?>
		</li>
		
	</ul>
</div>
<div style="clear:both">
</div>