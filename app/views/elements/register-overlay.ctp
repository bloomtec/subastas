<div class="overlay" id="register-overlay">
	<div style="position:relative; height:100%;">
	<h1>
		Este nuevo ipad  te está buscando
	</h1>
	<h2>
		y te lo puedes llevar por el <span>10%</span> de lo que vale
	</h2>
	<div class="producto">
		<div class="banner">
			<h1>Llevatelos.com</h1>
			<p>
				es la forma de adquirir lo que yo mas quiero de una forma apasionante
				a unos precios increíbles
			</p>
		</div>
		<div class="imagen">
			
		</div>
	</div>
	<div class="bottom">
		<div class="slogan">
			<span>Llévatelos.com</span>
			<span>Todos tus sueños</span>
			al alcance de un click
		</div>
		<div class="registrate">
			<h1><?php echo $html->link("Regístrate",array("controller"=>"users","action"=>"register"));?></h1>
			<span>y comienza a</span>
			cumplir todos tus sueños
		</div>
	</div>
  <!-- </div> <div class="register usuarios   forms">
        <h2>Registrate YA!!!</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <?php echo $form -> create("User", array("action" => "register","id"=>"registerForm"));
        $datos = explode("/", $_GET['url']);
        if(isset($datos['2']) & !empty($datos['2'])) {
            echo $form -> input("Recomendado.id", array('type' => 'hidden', 'value' => $datos['2']));
        }
        echo $form -> input("UserField.nombres",array("required"=>"required"));
        echo $form -> input("UserField.apellidos",array("required"=>"required"));
        echo $form -> input("username",array("div"=>"input text required","value"=>"web","label"=>"Nombre de usuario","required"=>"required"));
        ?>
        <div class="input text required">
            <label for="UserEmail">Email</label>
            <input type="email" id="UserEmail" maxlength="45" name="data[User][email]" required="required">
        </div>
        <?php
        echo $form -> input("password");
        echo $form -> end("Guardar");
        ?> -->
    </div>
   </div>
