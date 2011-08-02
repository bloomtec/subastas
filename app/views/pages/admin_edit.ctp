<div class="pages">
<?php echo $this->Form->create('Page');?>
	<fieldset>
 		<legend><?php __('Modificar Página'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title',array("div"=>"float","label"=>"Título"));
		echo $this->Form->hidden('slug',array("div"=>"float"));
		echo $this->Form->input('description',array("label"=>"Descripción","div"=>"float"));
		
		//echo $this->Form->input('order');
		echo $this->Form->input('content',array("name"=>"editor","label"=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end("Guardar");?>
</div>

<script type="text/javascript">
					CKEDITOR.replace( 'editor',{
        				filebrowserUploadUrl : '/upload.php',
        				filebrowserBrowseUrl : '/admin/images/wysiwyg',


					} );
	
</script>