<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="corner">
		<h1 class="titulo-amarillo">Testimonios</h1>
	<h2><?php __('Testimonios');?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('titulo');?></th>
			<th><?php echo $this->Paginator->sort('texto');?></th>
			<th><?php echo $this->Paginator->sort('imagen_path');?></th>
			<th class="actions"><?php __('Acciones');?></th>
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
			<td><?php echo $testimonio['Testimonio']['titulo']; ?>&nbsp;</td>
			<td><?php echo $testimonio['Testimonio']['texto']; ?>&nbsp;</td>
			<td><?php echo $html->image($testimonio['Testimonio']['imagen_path'],array("width"=>"200")); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $testimonio['Testimonio']['id'])); ?>
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
</div>