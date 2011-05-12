<div class="ofertas index">
	<h2><?php __('Ofertas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('subasta_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('creditos_descontados');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ofertas as $oferta):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $oferta['Oferta']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($oferta['Subasta']['nombre'], array('controller' => 'subastas', 'action' => 'view', $oferta['Subasta']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($oferta['User']['password'], array('controller' => 'users', 'action' => 'view', $oferta['User']['id'])); ?>
		</td>
		<td><?php echo $oferta['Oferta']['creditos_descontados']; ?>&nbsp;</td>
		<td><?php echo $oferta['Oferta']['created']; ?>&nbsp;</td>
		<td><?php echo $oferta['Oferta']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $oferta['Oferta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $oferta['Oferta']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $oferta['Oferta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oferta['Oferta']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Oferta', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>