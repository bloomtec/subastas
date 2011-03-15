<div class="testimonios view">
<h2><?php  __('Testimonio');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testimonio['Testimonio']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testimonio['Testimonio']['imagen_path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testimonio['Testimonio']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Texto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testimonio['Testimonio']['texto']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Testimonio', true), array('action' => 'edit', $testimonio['Testimonio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Testimonio', true), array('action' => 'delete', $testimonio['Testimonio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testimonio['Testimonio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Testimonios', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Testimonio', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
