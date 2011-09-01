<div id="left-content">
		 <?php echo $this->element("left");?>

</div>
<div id="right-content" class="pages como-funciona">
<h1 class="titulo-amarillo">Como Funciona</h1>
<div class="corner">
<?php echo $html->image("como-funciona.jpg");?>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="559" height="347" id="como funciona interna" align="middle">
				<param name="movie" value="/swf/como_funciona_interna.swf" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="/swf/como_funciona_interna.swf" width="559" height="347">
					<param name="movie" value="/swf/como_funciona_interna.swf" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
					<param name="wmode" value="window" />
					<param name="scale" value="showall" />
					<param name="menu" value="true" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
				<!--<![endif]-->
					<a href="http://www.adobe.com/go/getflash">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" />
					</a>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
<?php echo $html->image("botones-como-funciona.png");?>
<?php $paquetes=$this->requestAction("/paquetes/get"); ?>
		<div class="paquetes">
			<h1 class="titleForms" >Así de fácil <span> Llévatelos </span> </h1>
			<table class="creditos">
				<thead>
					<tr>
						<td>Paquete</td>
						<td>Valor</td>
						<td>Creditos</td>
						<td>Comprar</td>
					</tr>
				</thead>
				<?php foreach($paquetes as $paquete) : ?>
				<tr>
					<td>
					<?php echo $paquete['Paquete']['nombre'];?>
					</td>
					<td>
					<?php echo("$" . number_format($paquete['Paquete']['precio'], 0, ' ', '.'));?>
					</td>
					<td>
					<?php echo $paquete['Paquete']['creditos'];?>
					</td>
					<td>
					<?php
					// Crear el form
					//
					$form_id = $paquete['Paquete']['id'];
					echo $this -> Form -> create(null, array('class' => 'formCompraCreditos', 'type' => 'POST', 'url' => '/users/register'));
					// Datos de comercio
					//
					echo $form -> hidden('usuario', array('name' => 'usuario', 'value' => 'o61qja192w81o1zb'));
					$gmt = 3600 * -5;
					// GMT -5 para hora colombiana
					$fechaActual = gmdate('YmdHis', time() + $gmt);
					$factura_id = "1-"  . "-" . $paquete['Paquete']['creditos'] . "-" . $fechaActual;
					echo $this -> Form -> hidden('factura', array('name' => 'factura', 'value' => "$factura_id"));
					echo $this -> Form -> hidden('valor', array('name' => 'valor', 'value' => $paquete['Paquete']['precio']));
					$nombre = $paquete['Paquete']['nombre'];
					echo $this -> Form -> hidden('descripcionFactura', array('name' => 'descripcionFactura', 'value' => "Compra del paquete $nombre de llevatelos.com"));
					// Datos de usuario
					// Se pide: documento, nombre, apellido, correo,
					// direccion, telefono, celular, ciudad, pais
					
					// Finalizar el form
					//
					echo $this -> Form -> end(" ");
					?>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
			<div class="pins">
				<ul>
					<li>  1. Toda Subasta inicia en $0.0 Pesos </li>
					<li>  2. Cada oferta incrementa el precio del producto solo en $20 pesos </li>
					<li>  3. La oferta finaliza cuando el contador de tiempo llegue a 00:00:00 </li>
					<li>  4. Si eres el ultimo ofertante, LLEVATELO!!! </li>
				</ul>
			</div>
		</div>
</div>
<?php echo $html -> link($html -> image("volver_al_inicio.png"), "/", array("escape" => false, "class" => "volver"));?>
</div>
