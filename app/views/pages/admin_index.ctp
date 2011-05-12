<div class="pages">
	<h2><?php __('Páginas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('Título','title');?></th>
			<th><?php echo $this->Paginator->sort('Descripción','description');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('Creada','created');?></th>
			<th><?php echo $this->Paginator->sort('Modificada','updated');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pages as $page):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $page['Page']['title']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['description']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['slug']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['created']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['updated']; ?>&nbsp;</td>
		<td class="actions_icons">
			<?php echo $this->Html->image(("ver.gif"),array("alt"=>'ver',"url"=>array('action' => 'view', $page['Page']['id']))); ?>
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"tittle"=>'editar',"url"=>array('action' => 'edit', $page['Page']['id']))); ?>
			<?php // echo $this->Html->link(__('Delete', true), array('action' => 'delete', $page['Page']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $page['Page']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>


	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>