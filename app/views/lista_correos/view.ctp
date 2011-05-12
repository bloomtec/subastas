<div class="listaCorreos view">
<h2><?php  __('Lista Correo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $listaCorreo['ListaCorreo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Correo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $listaCorreo['ListaCorreo']['correo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $listaCorreo['ListaCorreo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $listaCorreo['ListaCorreo']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lista Correo', true), array('action' => 'edit', $listaCorreo['ListaCorreo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Lista Correo', true), array('action' => 'delete', $listaCorreo['ListaCorreo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listaCorreo['ListaCorreo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lista Correos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lista Correo', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
