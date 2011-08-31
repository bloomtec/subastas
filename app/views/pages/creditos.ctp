<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
		<?php 
			$paquetes=$this->requestAction("/paquetes/get");
			
		?>
	<div class="corner">
		<h1 class="titulo-amarillo">Mi cuenta</h1>
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
	<?php echo $html -> link($html -> image("volver_cuenta.png"), "/users", array("escape" => false, "class" => "volver"));?>
</div>