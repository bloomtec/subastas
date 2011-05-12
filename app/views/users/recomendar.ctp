<div>
	<?php echo $this -> Form -> create('User'); ?>
	<fieldset>
 		<legend>
 			<?php __('Recomendar'); ?>
 		</legend>
	<?php
		$user = $this->Session->read('Auth');
		echo $this -> Form -> input('user_id', array('type' => 'hidden', 'value' => $user['User']['id']));
		echo $this -> Form -> input('correo_amigo_1');
		echo $this -> Form -> input('correo_amigo_2');
		echo $this -> Form -> input('correo_amigo_3');
		echo $this -> Form -> input('correo_amigo_4');
		echo $this -> Form -> input('correo_amigo_5');
	?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Enviar', true)); ?>
</div>