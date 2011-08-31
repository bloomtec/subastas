<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this -> Html -> charset();?>
		<title>
			<?php __($PAGE_TITLE);?>
			<?php echo $title_for_layout;?>
		</title>
		<?php
		echo $this -> Html -> meta('icon');
		//	echo $this -> Html -> css("ie");
		echo $this -> Html -> css('reset');
		echo $this -> Html -> css('usuarios');
		echo $this -> Html -> css('screen');
		//EStilos del layout

		echo $this -> Html -> script("jquery-1.6.2.min.js");
		echo $this -> Html -> script("http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js");

		echo $this -> Html -> script("front.js");
		echo $this -> Html -> script("subastas.js");
		echo $this -> Html -> script("cufon-yui.js");
		echo $this -> Html -> script("Helvetica_Neue_LT_Std_400.font.js");
		echo $scripts_for_layout;
		?>
		<script type="text/javascript">var server="/";<?php if($session->read("Auth")){ ?>
			var auth=<?php echo json_encode($session -> read("Auth"));?>;<?php }else{?>var auth=null;<?php }?>
			Cufon.replace("body",{
				trim:"simple",
				ignoreClass:"cerrar-formulario"
			});
			
		</script>
	</head>
	<body class="<?php if($session->read("Auth.User")) echo 'logueado'?>">
		<div class="info-creditos">
			<div class="username"> <?php echo $session->read("Auth.User.username")?></div>
			<span>Creditos: </span>
			<span id="creditos">
			<?php echo $this -> requestAction("/users/getCreditos2");?>
			</span>
			<?php echo $html->link("Cerrar sesión",array("controller"=>"users","action"=>"logout"));?>
			<div style="clear:both;"></div>
		</div>
		<div id="container">
			<div id="header">
				<div class="banner-referido">
					<h1>Lévatelos  <span style="color:#EE1A24; margin-left: 3px;">ES SEGURO</span></h1>
					<?php echo $html->image("pse.jpg",array("width"=>55));?>
				</div>
				<div class="wrapper">
					<ul id="main-menu" class="corner15">
						<li>
							<?php
							echo $html -> link("Inicio", "/", array("class" => "color home other", ));
							?>
						</li>
						<li>
							<?php
							echo $html -> link("¿Cómo Funciona?", array("controller" => "pages", "action" => "view", "como-funciona"), array("class" => "other color como-funciona", ));
							?>
						</li>
						<li>
							<?php
							//echo $html -> link("Entregados", array("controller" => "subastas", "action" => "subastasFinalizadas"), array("class" => "other color subastas-finalizadas", ));
							echo $html -> link("Creditos", array("controller" => "pages", "action" => "creditos"), array("class" => "other color compra-creditos", ));
							?>
						</li>
	
						<li>
							<?php
							echo $html -> link("Regístrate", array("controller" => "users", "action" => "register"), array("class" => "final color registrarse", ));
							?>
						</li>
						<li>
							<?php
							echo $html -> link("Contáctanos", array("controller" => "pages", "action" => "contacto"), array("class" => "final color contactos", ));
							?>
						</li>
						<li class="last acceder">
							<?php
							echo $html -> link("Inicia Sesión", array("controller" => "users", "action" => "login"), array("class" => "final color contactos", ));
							?>
						</li>
						<li class="last mi-cuenta">
							<?php
							echo $html -> link("Mi cuenta", array("controller" => "users", "action" => "index"), array("class" => "final color contactos", ));
							?>
						</li>
						<div style="clear:both;"></div>
					</ul>
					<div class="banner-principal corner">
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="496" height="209" id="banner_inicio" align="middle">
							<param name="movie" value="/swf/banner_inicio3.swf" />
							<param name="quality" value="high" />
							<param name="bgcolor" value="#ffffff" />
							<param name="play" value="true" />
							<param name="loop" value="true" />
							<param name="wmode" value="window" />
							<param name="scale" value="showall" />
							<param name="menu" value="true" />
							<param name="devicefont" value="false" />
							<param name="salign" value="" />
							<param name="allowScriptAccess" value="sameDomain" />
							<!--[if !IE]>-->
							<object type="application/x-shockwave-flash" data="/swf/banner_inicio.swf" width="496" height="209">
								<param name="movie" value="banner_inicio" />
								<param name="quality" value="high" />
								<param name="bgcolor" value="#ffffff" />
								<param name="play" value="true" />
								<param name="loop" value="true" />
								<param name="wmode" value="opaque" />
								<param name="scale" value="showall" />
								<param name="menu" value="true" />
								<param name="devicefont" value="false" />
								<param name="salign" value="" />
								<param name="allowScriptAccess" value="sameDomain" />
								<!--<![endif]-->
								<a href="http://www.adobe.com/go/getflash">
								<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" />
								</a>
								<!--[if !IE]>-->
							</object>
							<!--<![endif]-->
						</object>
					</div>
				</div>
			</div>
			<div id="content">
				<?php echo $this -> Session -> flash();?>
				<?php //echo $this->element("animacion")?>
				<?php echo $content_for_layout;?>
				<div style="clear:both">
				</div>
			</div>
			<div id="footer">
				<?php echo $this -> element("footer");?>
			</div>
		</div>
		<?php echo $this -> element('register-overlay');?>
		<?php //echo $this->element('login-overlay');?>
	</body>
</html>