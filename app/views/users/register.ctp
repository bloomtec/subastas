<?php echo $form -> create("User", array("action" => "register"));
$datos = explode("/", $_GET['url']);
if(isset($datos['2']) & !empty($datos['2'])) {
	echo $form -> input("Recomendado.id", array('type' => 'hidden', 'value' => $datos['2']));
}
echo $form -> input("username");
echo $form -> input("email");
echo $form -> input("password");
echo $form -> input("UserField.nombre");
echo $form -> input("UserField.apellido");
echo $form -> end("Guardar");
?>