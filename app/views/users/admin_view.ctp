<div>
<h2><?php  __('Usuario');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['Role']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Campos Relacionados');?></h3>
	<?php if (!empty($user['UserField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nombres'); ?></th>
		<th><?php __('Apellidos'); ?></th>
		<th><?php __('Cédula'); ?></th>
		<th><?php __('Fecha De Nacimiento'); ?></th>
		<th><?php __('Sexo'); ?></th>
		<th><?php __('Dirección'); ?></th>
		<th><?php __('Ciudad'); ?></th>
		<th><?php __('Teléfono'); ?></th>
		<th><?php __('Ocupación'); ?></th>
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
			<td><?php echo $userField['nombres'];?></td>
			<td><?php echo $userField['apellidos'];?></td>
			<td><?php echo $userField['cedula'];?></td>
			<td><?php echo $userField['fecha_de_nacimiento'];?></td>
			<td><?php echo $userField['sexo'];?></td>
			<td><?php echo $userField['direccion'];?></td>
			<td><?php echo $userField['ciudad'];?></td>
			<td><?php echo $userField['telefono_fijo'];?></td>
			<td><?php echo $userField['ocupacion'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_fields', 'action' => 'view', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_fields', 'action' => 'edit', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_fields', 'action' => 'delete', $userField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
