<?php echo $form->create("User",array("action"=>"register"));
echo $form->input("username");
echo $form->input("email");
echo $form->input("password");
echo $form->input("UserField.nombre");
echo $form->input("UserField.apellido");
echo $form->end("Guardar");
?>