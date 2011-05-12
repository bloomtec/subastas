<div>
	<?php echo $this -> Form -> create('User'); ?>
	<fieldset>
 		<legend>
 			<?php __('Redimir Creditos'); ?>
 		</legend>
	<?php
		$user = $this->Session->read('Auth');
		echo $this -> Form -> input('user_id', array('type' => 'hidden', 'value' => $user['User']['id']));
		echo $this -> Form -> input('codigo_a_redimir');
	?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Enviar', true)); ?>
</div>
