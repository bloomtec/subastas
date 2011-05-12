<div class="pages">
<?php echo $this->Form->create('Page');?>
	<fieldset>
 		<legend><?php __('Nueva Página'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('slug');
		echo $this->Form->input('content',array("name"=>"editor"));
		

	?>
	</fieldset>
<?php echo $this->Form->end("Guardar");?>
	
</div>

<script type="text/javascript">
					CKEDITOR.replace( 'editor',{
        				filebrowserUploadUrl : '/priceshoes/upload.php',
        				filebrowserBrowseUrl : '/priceshoes/admin/images/wysiwyg',


					} );
	
</script>