<div class="testimonios index">
	<h2><?php __('Testimonios');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('imagen_path');?></th>
			<th><?php echo $this->Paginator->sort('titulo');?></th>
			<th><?php echo $this->Paginator->sort('texto');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($testimonios as $testimonio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $testimonio['Testimonio']['id']; ?>&nbsp;</td>
		<td><?php echo $testimonio['Testimonio']['imagen_path']; ?>&nbsp;</td>
		<td><?php echo $testimonio['Testimonio']['titulo']; ?>&nbsp;</td>
		<td><?php echo $testimonio['Testimonio']['texto']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $testimonio['Testimonio']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $testimonio['Testimonio']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $testimonio['Testimonio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testimonio['Testimonio']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
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
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Testimonio', true), array('action' => 'add')); ?></li>
	</ul>
</div>