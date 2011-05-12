<div class="users view">
<h2><?php  __('Usuario');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $user['User']['id']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<!-- <?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?> -->
			<?php echo $user['Role']['name']; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $user['User']['password']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $user['User']['created']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $user['User']['updated']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
	</dl>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Usuarios', true), array('action' => 'index')); ?> </li>
		<i>
			<li><?php echo $this->Html->link(__('Modificar Usuario', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Eliminar Usuario', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		</i>
		<li><?php echo $this->Html->link(__('Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List Roles', true), array('controller' => 'roles', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Role', true), array('controller' => 'roles', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List User Fields', true), array('controller' => 'user_fields', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add')); ?> </li> -->
	</ul>
</div>
<div class="related">
	<h3><?php __('Campos Relacionados');?></h3>
	<?php if (!empty($user['UserField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserField'] as $userField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userField['id'];?></td>
			<td><?php echo $userField['user_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_fields', 'action' => 'view', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_fields', 'action' => 'edit', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_fields', 'action' => 'delete', $userField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
