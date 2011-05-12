<div>
	<h2><?php __('Paquetes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('estado');?></th>
			<th><?php echo $this->Paginator->sort('creditos');?></th>
			<th><?php echo $this->Paginator->sort('precio');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($paquetes as $paquete):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $paquete['Paquete']['nombre']; ?>&nbsp;</td>
		<td><?php echo $paquete['Paquete']['estado']; ?>&nbsp;</td>
		<td><?php echo $paquete['Paquete']['creditos']; ?>&nbsp;</td>
		<td><?php echo $paquete['Paquete']['precio']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $paquete['Paquete']['id'])); ?>
			<?php echo $this->Html->link(__('Adquirir', true), array('action' => 'adquirir', $paquete['Paquete']['id'])); ?>
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