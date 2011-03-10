<div class="subastas with-image">
<h2><?php  __('Subasta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo Subasta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['TipoSubasta']['nombre']; ?>
			&nbsp;
		</dd>
		<?php
			echo '<dt';
			if ($i % 2 == 0) echo $class;
			echo '>';
			if($subasta['TipoSubasta']['id'] == 1) {
				__('Valor');	
			} else {
				__('Mínimo De Creditos');
			}
			echo '</dt><dd';
			if ($i++ % 2 == 0) echo $class;
			if($subasta['TipoSubasta']['id'] == 1) {
				echo '>$'.$subasta['Subasta']['valor'].'&nbsp;</dd>';
			} else {
				echo '>'.$subasta['Subasta']['umbral_minimo_creditos'].'&nbsp;</dd>';
			}		 
		?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dias Espera'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['dias_espera']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contenido Pagina'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['contenido_pagina']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posicion En Cola'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['posicion_en_cola']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Estado']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha De Venta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['fecha_de_venta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha Inicio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha Actualización'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="image">
	<?php echo $html->image($subasta['Subasta']['imagen_path']); ?>
</div>

<div class="related">
	<h3><?php __('Venta Relacionada');?></h3>
	<?php if (!empty($subasta['Venta'])):?>
	<dl>	<?php $i = 0; $class = ' class="altrow"';?>
	<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID Subasta');?></dt>
	<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['subasta_id'];?>
	&nbsp;</dd>
	<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID Usuario');?></dt>
	<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['user_id'];?>
	&nbsp;</dd>
	<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado');?></dt>
	<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['estado'];?>
	&nbsp;</dd>
	<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creada');?></dt>
	<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['created'];?>
	&nbsp;</dd>
	<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actualizada');?></dt>
	<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['updated'];?>
	&nbsp;</dd>
	</dl>
	<?php endif; ?>
</div>
	
<div class="related">
	<h3><?php __('Ofertas Relacionadas');?></h3>
	<?php if (!empty($subasta['Oferta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Subasta Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Creditos Descontados'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subasta['Oferta'] as $oferta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $oferta['id'];?></td>
			<td><?php echo $oferta['subasta_id'];?></td>
			<td><?php echo $oferta['user_id'];?></td>
			<td><?php echo $oferta['creditos_descontados'];?></td>
			<td><?php echo $oferta['created'];?></td>
			<td><?php echo $oferta['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'ofertas', 'action' => 'view', $oferta['id'])); ?>
				<?php echo $this->Html->link(__('Modificar', true), array('controller' => 'ofertas', 'action' => 'edit', $oferta['id'])); ?>
				<?php echo $this->Html->link(__('Borrar', true), array('controller' => 'ofertas', 'action' => 'delete', $oferta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oferta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
