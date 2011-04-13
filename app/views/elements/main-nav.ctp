<ul class="main_nav">
            <li>
            	<?php 
            	echo $html->link("Inicio",
            			"/",
						array(
							"class"=>"color home other",
						)
					);
				?>
            </li>
            <li>
            	<?php 
            	echo $html->link("¿Como Funciona?",
            			array(
							"controller"=>"pages","action"=>"view","como-funciona"),
						array(
							"class"=>"other color como-funciona",
						)
						);
				?>
            </li>
            <li>
            	<?php 
            	echo $html->link("Subastas Finalizadas",
            			array(
							"controller"=>"pages","action"=>"view","subastas-finalizadas"),
						array(
							"class"=>"other color subastas-finalizadas",
						)
						);
				?>
            </li>
            <li>
            	<?php 
            	echo $html->link("Registrarse",
            			array(
							"controller"=>"pages","action"=>"view","registrarse"),
						array(
							"class"=>"final color registrarse",
						)
						);
				?>
            </li>
            <li>
            	<?php 
            	echo $html->link("Contactos",
            			array(
							"controller"=>"pages","action"=>"view","contactos"),
						array(
							"class"=>"final color contactos",
						)
						);
				?>
            </li>
            
</ul>