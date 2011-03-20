<div class="users index">
	<h2><?php __('Usuarios');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!-- <th><?php echo $this->Paginator->sort('id');?></th> -->
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('role_id');?></th>
			<!-- <th><?php echo $this->Paginator->sort('password');?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('created');?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('updated');?></th> -->
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $user['User']['id']; ?>&nbsp;</td> -->
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<!-- <td> -->
			<!-- <?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?> -->
		<!-- </td> -->
		<td><?php echo $user['Role']['name']; ?>&nbsp;</td>
		<!-- <td><?php echo $user['User']['password']; ?>&nbsp;</td> -->
		<!-- <td><?php echo $user['User']['created']; ?>&nbsp;</td> -->
		<!-- <td><?php echo $user['User']['updated']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('¿Eliminar el usuario %s?', true), $user['User']['username'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de %count% en total, mostrando desde el registro %start%, hasta el %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Crear Un Usuario', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('Roles', true), array('controller' => 'roles', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Role', true), array('controller' => 'roles', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('Campos De Usuario', true), array('controller' => 'user_fields', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add')); ?> </li> -->
	</ul>
</div>