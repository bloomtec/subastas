<div>
	<h2><?php __('Paquetes De PIN\'s');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($batchCodes as $batchCode):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $batchCode['BatchCode']['nombre']; ?>&nbsp;</td>
		<td><?php echo $batchCode['BatchCode']['descripcion']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $batchCode['BatchCode']['id'])); ?>
<!-- 			<?php echo $this->Html->link(__('Modificar', true), array('action' => 'edit', $batchCode['BatchCode']['id'])); ?> -->
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $batchCode['BatchCode']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $batchCode['BatchCode']['id'])); ?>
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