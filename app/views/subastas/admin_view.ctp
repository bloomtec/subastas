<div class="subastas view">
<h2><?php  __('Subasta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $subasta['Subasta']['id']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
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
			<!-- <?php echo $this->Html->link($subasta['TipoSubasta']['nombre'], array('controller' => 'tipo_subastas', 'action' => 'view', $subasta['TipoSubasta']['id'])); ?> -->
			<?php echo $subasta['TipoSubasta']['nombre']; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $subasta['Subasta']['valor']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Umbral Minimo Creditos'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $subasta['Subasta']['umbral_minimo_creditos']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
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
				echo '>'.$subasta['Subasta']['valor'].'&nbsp;</dd>';
			} else {
				echo '>'.$subasta['Subasta']['umbral_minimo_creditos'].'&nbsp;</dd>';
			}		 
		?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creditos x Puja'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['cantidad_creditos_puja']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Días Espera'); ?></dt>
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
			<?php
				if ($subasta['Subasta']['posicion_en_cola'] == -1) {
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha De Venta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['fecha_de_venta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha De Inicio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Última Actualización'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subasta['Subasta']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Subastas', true), array('action' => 'index')); ?> </li>
		<i>
			<li><?php echo $this->Html->link(__('Modificar Subasta', true), array('action' => 'edit', $subasta['Subasta']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Eliminar Subasta', true), array('action' => 'delete', $subasta['Subasta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subasta['Subasta']['id'])); ?> </li>
		</i>
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New Subasta', true), array('action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List Tipo Subastas', true), array('controller' => 'tipo_subastas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Tipo Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List Estados Subastas', true), array('controller' => 'estados_subastas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Estados Subasta', true), array('controller' => 'estados_subastas', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Oferta', true), array('controller' => 'ofertas', 'action' => 'add')); ?> </li> -->
	</ul>
</div>
	<div class="related">
		<h3><?php __('Venta');?></h3>
		<?php if (!empty($subasta['Venta'])):?>
	<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
	<!-- <?php echo $subasta['Venta']['id'];?> -->
<!-- &nbsp;</dd> -->
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subasta');?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
	<!-- <?php echo $subasta['Venta']['subasta_id'];?> -->
<!-- &nbsp;</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['user_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $subasta['Venta']['estados_venta_id'];?>
&nbsp;</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
	<!-- <?php echo $subasta['Venta']['created'];?> -->
<!-- &nbsp;</dd> -->
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated');?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
	<!-- <?php echo $subasta['Venta']['updated'];?> -->
<!-- &nbsp;</dd> -->
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Modificar', true), array('controller' => 'ventas', 'action' => 'edit', $subasta['Venta']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Ofertas');?></h3>
	<?php if (!empty($subasta['Oferta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<!-- <th><?php __('Id'); ?></th> -->
		<th><?php __('User Id'); ?></th>
		<th><?php __('Subasta Id'); ?></th>
		<!-- <th><?php __('Creditos Descontados'); ?></th> -->
		<th><?php __('Created'); ?></th>
		<!-- <th><?php __('Updated'); ?></th> -->
		<th class="actions"><?php __('Acciones');?></th>
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
			<!-- <td><?php echo $oferta['id'];?></td> -->
			<td><?php echo $oferta['user_id'];?></td>
			<td><?php echo $oferta['subasta_id'];?></td>
			<!-- <td><?php echo $oferta['creditos_descontados'];?></td> -->
			<td><?php echo $oferta['created'];?></td>
			<!-- <td><?php echo $oferta['updated'];?></td> -->
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'ofertas', 'action' => 'view', $oferta['id'])); ?>
				<?php echo $this->Html->link(__('Modificar', true), array('controller' => 'ofertas', 'action' => 'edit', $oferta['id'])); ?>
				<?php echo $this->Html->link(__('Eliminar', true), array('controller' => 'ofertas', 'action' => 'delete', $oferta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oferta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Ofertar', true), array('controller' => 'ofertas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
