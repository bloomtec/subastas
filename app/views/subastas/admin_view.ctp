<div>
<h2><?php  __('Subasta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<!-- <?php echo $subasta['Subasta']['imagen_path']; ?> -->
			<?php echo $html->image($subasta['Subasta']['imagen_path'],array("width"=>"200")); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['TipoSubasta']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['valor']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mínimo De Créditos'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $subasta['Subasta']['umbral_minimo_creditos']; ?>
		&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creditos x Puja'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['cantidad_creditos_puja']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['precio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Aumento Precio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['aumento_precio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Días Espera'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['dias_espera']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posicion En Cola'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				if ($subasta['Subasta']['posicion_en_cola'] < 1) {
					echo $subasta['EstadosSubasta']['nombre'];
				} else {
					echo $subasta['Subasta']['posicion_en_cola'];
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<!-- <?php echo $this->Html->link($subasta['EstadosSubasta']['nombre'], array('controller' => 'estados_subastas', 'action' => 'view', $subasta['EstadosSubasta']['id'])); ?> -->
			<?php echo $subasta['EstadosSubasta']['nombre']; ?>
			&nbsp;
		</dd>
</div>
	
<div class="related">
	<h3><?php __('Ofertas');?></h3>
	<?php if (!empty($subasta['Oferta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Created'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subasta['Oferta'] as $oferta):
			debug($oferta);
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
	?>
		<tr<?php echo $class;?>>
			<td><?php echo $oferta['user_id'];?></td>
			<td><?php echo $oferta['created'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
		<h3><?php __('Venta');?></h3>
		<?php
			if (!empty($subasta['Venta'])):
				debug($subasta);
		?>
	<dl>	<?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['user_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<!-- <?php echo $subasta['Venta']['estados_venta_id'];?> -->
	<?php echo $subasta['Subasta']['EstadosSubasta']['nombre'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
</div>