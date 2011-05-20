<div>
	<h2><?php __('Lista Correos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('correo');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($listaCorreos as $listaCorreo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $listaCorreo['ListaCorreo']['correo']; ?>&nbsp;</td>
		<td><?php echo $listaCorreo['ListaCorreo']['created']; ?>&nbsp;</td>
		<td><?php echo $listaCorreo['ListaCorreo']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $listaCorreo['ListaCorreo']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $listaCorreo['ListaCorreo']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $listaCorreo['ListaCorreo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listaCorreo['ListaCorreo']['id'])); ?>
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