<?php
class UsersController extends AppController {

	var $name = 'Users';

	private $directorioFoto = "";
	private $administradorRolId = 1;
	private $clienteRolId = 2;
	private $registradoRolId = 2;

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->deny("login","abonarCreditosPorRecomendacion","checkEmail","register","checkPassword","rememberPassword","reponerCreditos","creditosUsuario","creditosSuficientes","descontarCreditos");
		//	$this->Auth->allow("index","confirm",'login');
	}

	function index() {
		$user = $this -> User -> read(null, $this -> Auth -> user("id"));
		//debug($user);
		$this -> set('user', $user);
		if (empty($user)) {
			$this -> redirect(array("action" => "login"));
		}
	}

	function validarCompra() {
		$this -> loadModel('User');
		$datos = explode("-", $_POST['codigoFactura']);
		$user = $this -> User -> find('first', array('conditions' => array('User.id' => $datos[1]), 'recursive' => -1));
		$this -> Auth -> login($user);
		$this -> set('_POST', $_POST);
		$this -> set('user', $user);
	}

	function pasoFinalValidarCompra($user_id = null, $creditos = null) {
		$user = $this -> User -> find('first', array('conditions' => array('User.id' => $user_id), 'recursive' => -1));
		$this -> User -> read(null, $user_id);
		$this -> User -> set('creditos', $user['User']['creditos'] + $creditos);
		$this -> User -> save();
	}

	function ingresoPIN() {
		$this -> autoRender = false;

		$this -> loadModel('Code');

		// Obtener el codigo de la BD
		$code = $this -> Code -> find('first', array('conditions' => array('estado' => 1, 'codigo' => $this -> data['User']['pin'], 'fecha_expiracion >=' => date('Y-m-d'))));

		if ($code) {
			// Cambiar el estado del codigo
			//
			$this -> Code -> read(null, $code['Code']['id']);
			$this -> Code -> set('estado', 0);
			$this -> Code -> save();

			// Sumarle los creditos al usuario
			//
			$user = $this -> User -> find('first', array('conditions' => array('User.id' => $this -> Auth -> user('id')), 'recursive' => -1));
			$this -> User -> read(null, $this -> Auth -> user('id'));
			$this -> User -> set('creditos', $user['User']['creditos'] + $code['Code']['creditos']);
			$this -> User -> save();

			$this -> Session -> setFlash('Se redimio su codigo');
		} else {
			$this -> Session -> setFlash('Codigo no valido. Verifique el codigo, la fecha de expiracion e intente de nuevo');
		}
		$this -> redirect(array('action' => 'comprarCreditos'));
	}

	function modificarDatos() {
		$user_id = $this -> Auth -> user("id");
		$user = $this -> User -> read(null, $user_id);
		if (!empty($this -> data)) {
			$this -> data["User"]["id"] = $user_id;
			if ($this -> User -> saveAll($this -> data)) {
				if ($user['User']['datos_ingresados'] == 0) {
					$user['User']['datos_ingresados'] = 1;
					$user['User']['bonos'] += Configure::read("creditos_por_modificar");
				}

				$this -> User -> save($user);
				$this -> Session -> setFlash(__('Datos de usuario modificados.', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				debug($this -> User -> invalidFields());
				$this -> Session -> setFlash(__('Todos los campos son requeridos. Inténtelo de nuevo.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> User -> read(null, $user_id);
		}
		$this -> set('user', $user);
	}

	function getCreditos() {
		$this -> User -> recursive = -1;
		$user = $this -> User -> read(null, $this -> Auth -> user("id"));
		if (!empty($this -> params['requested'])) {
			return $user["User"]["creditos"];
		}
		/*if($this->RequestHandler->isAjax()){
		 echo $user["User"]["creditos"];
		 Configure::write("debug",0);
		 $this->autoRender=false;
		 exit(0);
		 }*/
	}

	function getCreditos2() {// SE UTILIZA EN EL HOME PARA MOSTRAR LOS CREDITOS DEL USUARIO
		$this -> User -> recursive = -1;
		$user = $this -> User -> read(null, $this -> Auth -> user("id"));
		if (!empty($this -> params['requested'])) {
			return $user["User"]["creditos"] + $user["User"]["bonos"];
		}
		/*if($this->RequestHandler->isAjax()){
		 echo $user["User"]["creditos"];
		 Configure::write("debug",0);
		 $this->autoRender=false;
		 exit(0);
		 }*/
	}

	function getBonos() {
		$this -> User -> recursive = -1;
		$user = $this -> User -> read(null, $this -> Auth -> user("id"));
		if (!empty($this -> params['requested'])) {
			return $user["User"]["bonos"];
		}
		if ($this -> RequestHandler -> isAjax()) {
			echo $user["User"]["bonos"];
			Configure::write("debug", 0);
			$this -> autoRender = false;
			exit(0);
		}
	}

	function __abonarCreditosPorRecomendacion($email = null, $email_usuario = null) {
		if ($email) {
			$user = $this -> User -> find('first', array('conditions' => array('User.email' => $email)));
			if ($user) {
				$this -> User -> read(null, $user['User']['id']);
				$this -> User -> set('bonos', $user['User']['bonos'] + $this -> requestAction('/configs/creditosPorRecomendacion'));
				$this -> User -> save();
				$this -> __enviarCorreoAbonoPorRecomendar($email, $email_usuario);
			}
		}
	}

	function __obtenerCorreoReferente($encryptedID = null) {
		// Encontrar el total de usuarios registrados
		//
		//$totalUsuarios = $this->User->find('first', array('conditions' => array()));
		$max_id = $this -> User -> find('first', array('fields' => array('MAX(User.id) as user_id'), 'recursive' => -1));
		$usuario = null;
		for ($id = 1; $id <= $max_id; $id++) {
			if ($encryptedID == crypt($id, "23()23*$%g4F^aN!^^%")) {
				// Las ID son iguales, abonar por recomendacion
				//
				$usuario = $this -> User -> read(null, $id);
				break;
			} else {
				// Seguir buscando
				//
			}
		}
		return $usuario['User']['email'];
	}

	function checkEmail() {
		$checkMail = $this -> User -> findByEmail($_GET["data"]["User"]["email"]);
		$checUserName = $this -> User -> findByUsername($_GET["data"]["User"]["username"]);
		$devolver;
		if ($checkMail || $checUserName) {
			if ($checkMail)
				$devolver["data[User][email]"] = "el email se encuentra registrado";
			if ($checUserName)
				$devolver["data[User][username]"] = "el nombre de usuario se encuentra registrado";
			//echo json_encode(array("data[User][email]"=>"el email se encuentra registrado"));
			echo json_encode($devolver);
			Configure::write("debug", 0);
			$this -> autoRender = false;
			exit(0);

		} else {
			echo json_encode(true);
			Configure::write("debug", 0);
			$this -> autoRender = false;
			exit(0);
		}
		Configure::write("debug", 0);
		$this -> autorender = false;
		exit(0);
	}

	function confirmRegister() {

	}

	function register() {
		if (!empty($this -> data)) {
			$user_pass = $this -> data['User']['password2'];
			$this -> User -> recursive = 0;
			$this -> User -> create();
			$this -> data['User']['role_id'] = 2;
			// Is set as a Basic user for default
			$this -> data['User']['bonos'] = $this -> requestAction('/configs/creditosIniciales');
			if ($this -> User -> save($this -> data)) {
				$user_id = $this -> User -> id;
				$encrypted_user_id = crypt($user_id, "23()23*$%g4F^aN!^^%");
				$this -> data['UserField']['user_id'] = $user_id;
				$this -> User -> UserField -> save($this -> data["UserField"]);

				/*	if (isset($this->data['User']['referido_por'])) {
				 $this->__abonarCreditosPorRecomendacion($this->data['User']['referido_por'],$this->data['User']['email'] );
				 }*/

				// Importar clases de Mad Mimi
				//
				App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'MadMimi.class.php'));
				App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'Spyc.class.php'));

				// Crear el objeto de Mad Mimi
				//
				$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));

				// Arreglo para añadir un usuario a Mad Mimi
				//

				$userMimi = array('email' => $this -> data['User']['email'], 'firstName' => $this -> data['User']['username'], 'add_list' => 'cuentas-creadas');

				// Añadir el usuario a Mad Mimi
				//
				$mailer -> AddUser($userMimi);

				$this -> Session -> setFlash(__('Su registro ha sido exitoso', true));
				//$this->Auth->login($this->data);
				$this -> Cookie -> write("registrado", true);

				// Opciones de configuracion para enviar un correo via Mad Mimi
				//
				$options = array('promotion_name' => 'bienvenida', 'recipients' => $this -> data['User']['email'], 'subject' => 'Bienvenida', 'from' => 'no-reply@llevatelos.com');

				// Opciones del cuerpo de mensaje de Mad Mimi
				//
				$username = $this -> data['User']['username'];

				// Cuerpo HTML
				//

				$html_body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
					<head>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
						<title></title>
						<style type=\"text/css\">
							.txt {
								font-family: Arial, Helvetica, sans-serif;
								font-size: 14px;
							}
							.nombre {
								color: #666;
							}
							.rojo {
								color: #F00;
							}
							.verde {
								color: #9C0;
							}
							.peke {
								font-size: 12px;
							}
				
						</style>
					</head>
					<body>
						[[tracking_beacon]]
						<table summary=\"\" width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td width=\"50\" rowspan=\"4\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//bienvenida//rp01.jpg\" width=\"50\" height=\"525\" /></td>
								<td width=\"310\" height=\"165\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//bienvenida//rp02.jpg\" width=\"310\" height=\"165\" /></td>
								<td width=\"340\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//bienvenida//rp03.jpg\" width=\"340\" height=\"165\" /></td>
							</tr>
							<tr>
								<td height=\"75\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//bienvenida//b01.jpg\" width=\"366\" height=\"75\" /></td>
							</tr>
							<tr>
								<td height=\"205\" colspan=\"2\">
								<table summary=\"\" width=\"650\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
									<tr>
										<td>
										<p class=\"txt\">
											<strong>Hola,</strong>
										</p>
										<p class=\"txt\">
											<strong>Te damos la bienvenida a Llevatelos.com. </strong>
										</p>
										<p class=\"txt\">
											<strong>A continuación te brindamos los datos de usuario que te ayudarán a acceder a llevatelos.com
											<br />
											<span class=\"verde\">Usuario:</span> $username
											<br />
											<span class=\"verde\">Contraseña:</span> $user_pass </strong>
											<br />
											<span class=\"verde\">Solo falta que valides tu cuenta dando click <a href=\"http://www.llevatelos.com/users/validateEmail/$encrypted_user_id\">aquí.</a> </strong>
										</p>
										<p class=\"txt\">
											<strong>Hasta pronto, y sigue atrapando tus sueños.
											<br />
											<br />
											<span class=\"peke\">Equipo llevatelos.com - Atrapa tus sueños.</span></strong>
										</p></td>
									</tr>
								</table></td>
							</tr>
							<tr>
								<td height=\"80\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//bienvenida//rp04.jpg\" width=\"650\" height=\"80\" /></td>
							</tr>
						</table>
					</body>
				</html>";

				// Enviar el mensaje via Mad Mimi
				//
				$result = $mailer -> SendHTML($options, $html_body);
				$mailer -> RemoveMembership("mailing", $this -> data['User']['email']);

				if ($this -> referer() == "/") {
					$this -> redirect(array("controller" => "subastas", 'action' => 'index'));
				} else {
					$this -> redirect(array("controller" => "users", 'action' => 'confirmRegister'));
				}

			} else {
				$this -> Session -> setFlash(__('No se pudo completar el registro. Por favor, intente de nuevo', true));
			}

		} else {
			if (!empty($this -> params['pass'][0])) {
				$this -> set('email_referente', $this -> __obtenerCorreoReferente($this -> params['pass'][0]));
			}
		}
	}

	function validateEmail($encryptedID = null) {
		$this -> autoRender = false;
		if ($encryptedID) {
			// Encontrar el total de usuarios registrados
			//
			//$totalUsuarios = $this->User->find('first', array('conditions' => array()));
			$max_id = $this -> User -> find('first', array('fields' => array('MAX(User.id) as user_id'), 'recursive' => -1));
			$usuario = null;
			for ($id_tested = 1; $id_tested <= $max_id; $id_tested++) {
				if ($id_tested == crypt($encryptedID, "23()23*$%g4F^aN!^^%")) {
					// Las ID son iguales, abonar por recomendacion
					//
					$usuario = $this -> User -> read(null, $max_id);
					break;
				} else {
					// Seguir buscando
					//
				}
			}
			$usuario['User']['email_validado'] = true;
			if ($this -> User -> save($usuario)) {
				$this -> __abonarCreditosPorRecomendacion($usuario['User']['referido_por'], $usuario['User']['email']);
				$this -> Session -> setFlash(__('Gracias por validar su cuenta', true));
				$this -> Auth -> login($usuario);
				$this -> redirect(array("controller" => "users", 'action' => 'recomendar'));
			} else {
				// Hacer algo si error?
			}
		}
		$this -> redirect(array("controller" => "subastas", 'action' => 'index'));
	}

	function checkPassword() {
		$this -> User -> recursive = 0;
		$user = $this -> User -> read(null, $this -> Auth -> user("id"));
		if ($user["User"]["password"] == $this -> Auth -> password($_GET["data"]["User"]["actualPassword"])) {
			$user["User"]["password"] = $this -> Auth -> password($_GET["data"]["User"]["password"]);
			$this -> User -> save($user, array("validate" => false));
			$this -> Session -> setFlash(__('Se ha modificado su contraseña', true));
			echo json_encode(true);
		} else {
			echo json_encode(array("data[User][actualPassword]" => "Contraseña actual no valida"));
		}
		Configure::write("debug", 0);
		$this -> autoRender = false;
		exit(0);
	}

	function changePassword() {
		if (!empty($this -> data)) {

		}
	}

	function menu() {
		if (!$this -> Acl -> check(array('model' => 'User', 'foreign_key' => $this -> Session -> read("Auth.User.id")), 'menu')) {
			$this -> Session -> setFlash(__($this -> Auth -> authError, true));
			$this -> redirect($this -> referer());
		}
	}

	function admin_menu() {
		if (!$this -> Acl -> check(array('model' => 'User', 'foreign_key' => $this -> Session -> read("Auth.User.id")), 'admin_menu')) {
			$this -> Session -> setFlash(__($this -> Auth -> authError, true));
			$this -> redirect($this -> referer());
		}
	}

	function admin_index() {
		$this -> User -> recursive = 0;
		$this -> set('users', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid user', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('user', $this -> User -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> User -> create();
			if ($this -> User -> save($this -> data)) {
				$aro = &$this -> Acl -> Aro;
				$elaro = $aro -> find("first", array("conditions" => array("Model" => "Role", "foreign_key" => $this -> data["User"]["role_id"])));
				$newAro = array("alias" => $this -> data["User"]["username"], "parent_id" => $elaro["Aro"]["id"], "foreign_key" => $this -> User -> id, "model" => "User", );
				$aro -> create();
				$aro -> save($newAro);
				$this -> Session -> setFlash(__('The user has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$roles = $this -> User -> Role -> find('list');
		$this -> set(compact('roles'));
	}

	function admin_edit($id = null) {

		//$foto['user']['foto'] = $this->User->find("first", array('fields'=>'foto','conditions'=>array('User.id'=>'$id')));

		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid user', true));
			$this -> redirect(array('action' => 'index'));
		}

		if (!empty($this -> data)) {
			if ($this -> User -> save($this -> data)) {
				$this -> Session -> setFlash(__('The user has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> User -> read(null, $id);
		}

		$roles = $this -> User -> Role -> find('list');
		$this -> set(compact('roles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for user', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> User -> delete($id)) {
			$this -> Session -> setFlash(__('User deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('User was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	//LOGIN USER
	function login() {

		if (!empty($this -> data) && !empty($this -> Auth -> data['User']['username'])) {

			$user = $this -> User -> find('first', array('conditions' => array('username' => $this -> Auth -> data['User']['username'], 'password' => $this -> Auth -> data['User']['password']), 'recursive' => -1));

			if (!$user) {
				$user = $this -> User -> find('first', array('conditions' => array('email' => $this -> Auth -> data['User']['username'], 'password' => $this -> Auth -> data['User']['password']), 'recursive' => -1));
			}

			if (!empty($user) && $this -> Auth -> login($user)) {
				$userId = $this -> Auth -> user('id');
				$this -> set("login", true);

				if ($this -> Auth -> autoRedirect) {
					$this -> redirect($this -> Auth -> redirect());
				}

			} else {
				$this -> Session -> setFlash("Por favor revisa los datos ingresados e intenta de nuevo.");
			}

		} else {
			$this -> Session -> setFlash("Ingrese su usuario/correo y contraseña");
		}

	}

	function registerMadMimi() {
		// Importar clases de Mad Mimi
		//
		App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'MadMimi.class.php'));
		App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'Spyc.class.php'));

		// Crear el objeto de Mad Mimi
		//
		$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));
		$userMimi = array('email' => $_POST["email"], 'firstName' => $_POST["name"], 'add_list' => 'mailing');
		$mailer -> AddUser($userMimi);
		echo true;
		Configure::write("debug", 0);
		$this -> autoRender = false;
		exit(0);
	}

	function ajaxLogin() {
		$this -> Auth -> data['User']['username'] = $_POST["data"]["User"]["username"];
		$this -> Auth -> data['User']['password'] = $this -> Auth -> password($_POST["data"]["User"]["password"]);
		if (!empty($this -> Auth -> data['User']['username']) && !empty($this -> Auth -> data['User']['password'])) {

			$user = $this -> User -> find('first', array('conditions' => array('username' => $this -> Auth -> data['User']['username'], 'password' => $this -> Auth -> data['User']['password']), 'recursive' => -1));

			if (!$user) {
				$user = $this -> User -> find('first', array('conditions' => array('email' => $this -> Auth -> data['User']['username'], 'password' => $this -> Auth -> data['User']['password']), 'recursive' => -1));
			}

			if (!empty($user) && $this -> Auth -> login($user)) {
				if (!$user["User"]["email_validado"]) {// SI NO HA VERIFICADO EL MAIL NO LO DEJA LOGUEAR
					echo false;
				} else {
					$userId = $this -> Auth -> user('id');
					$this -> set("login", true);
					echo true;
				}

			} else {
				echo false;
			}

		} else {
			echo false;
		}
		Configure::write("debug", 0);
		$this -> autoRender = false;
		exit(0);
	}

	function admin_login() {
		$this -> set("login", true);
	}

	//LOGOUT USER
	function logout() {
		$this -> redirect($this -> Auth -> logout());
	}

	function admin_logout() {
		$this -> redirect($this -> Auth -> logout());
	}

	//Recordar email
	//Recordar email
	function generarPassword() {
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for ($i = 0; $i < 8; $i++) {
			$cad .= substr($str, rand(0, 62), 1);
		}
		return $cad;
	}

	function rememberPassword() {
		if (!empty($this -> data)) {
			$this -> User -> recursive = 0;
			$user = $this -> User -> find("first", array('conditions' => array('User.email' => trim($this -> data['User']['email'])), 'recursive' => -1));

			$newPassword = $this -> generarPassword();
			//debug($newPassword);

			$user["User"]["password"] = $this -> Auth -> password($newPassword);
			//debug($datos);

			$user_email = $user['User']['email'];

			if ($user_email && $this -> User -> save($user)) {

				App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'MadMimi.class.php'));
				App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'Spyc.class.php'));

				$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));

				$options = array('promotion_name' => 'recuperar_pass', 'recipients' => $user_email, 'subject' => 'Recupera Tu Contraseña', 'from' => 'no-reply@llevatelos.com');

				$html_body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
					<head>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
						<title></title>
						<style type=\"text/css\">
							.txt {
								font-family: Arial, Helvetica, sans-serif;
								font-size: 14px;
							}
							.nombre {
								color: #666;
							}
							.rojo {
								color: #F00;
							}
							.verde {
								color: #9C0;
							}
							.peke {
								font-size: 12px;
							}
				
						</style>
					</head>
					<body>
						[[tracking_beacon]]
						<table summary=\"\" width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td width=\"50\" rowspan=\"4\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//recuperar_pass//rp01.jpg\" width=\"50\" height=\"525\" /></td>
								<td width=\"310\" height=\"165\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//recuperar_pass//rp02.jpg\" width=\"310\" height=\"165\" /></td>
								<td width=\"340\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//recuperar_pass//rp03.jpg\" width=\"340\" height=\"165\" /></td>
							</tr>
							<tr>
								<td height=\"75\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//recuperar_pass//rp05.jpg\" width=\"380\" height=\"75\" /></td>
							</tr>
							<tr>
								<td height=\"205\" colspan=\"2\">
								<table summary=\"\" width=\"650\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
									<tr>
										<td>
										<p class=\"txt\">
											<strong>Hola,</strong>
										</p>
										<p class=\"txt\">
											<span class=\"rojo\"><strong>¿Olvidaste tu contraseña?</strong></span><strong> no te preocupes, puedes recuperarla fácilmente. </strong>
										</p>
										<p class=\"txt\">
											<strong>A continuación te brindamos los datos de usuario que te ayudarán a acceder nuevamente a llevatelos.com
											<br />
											<span class=\"verde\">Usuario:</span> $user_email
											<br />
											<span class=\"verde\">Contraseña:</span> $newPassword
											<br />
											<span class=\"peke\">Recuerda ingresar a llevatelos.com para modificarla lo antes posible.</span></strong>
										</p>
										<p class=\"txt\">
											<strong>Hasta pronto, y sigue atrapando tus sueños.
											<br />
											<br />
											<span class=\"peke\">Equipo llevatelos.com - Atrapa tus sueños.</span></strong>
										</p></td>
									</tr>
								</table></td>
							</tr>
							<tr>
								<td height=\"80\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//recuperar_pass//rp04.jpg\" width=\"650\" height=\"80\" /></td>
							</tr>
						</table>
					</body>
				</html>";

				$result = $mailer -> SendHTML($options, $html_body);

				$this -> set("mensaje", 'Datos enviados a su correo');
				return;
			} else {
				$this -> set("mensaje", 'No existe ningun usuario registrado con ese email');
				return;
			}
		}
	}

	function reponerCreditos($userID = null, $creditosAReponer = null, $bonosAReponer = null) {
		$usuario = $this -> User -> read(null, $userID);
		$creditos = $usuario['User']['creditos'];
		$bonos = $usuario['User']['bonos'];
		$this -> User -> set('creditos', $creditos + $creditosAReponer);
		$this -> User -> set('bonos', $bonos + $bonosAReponer);
		$this -> User -> save();
	}

	function creditosUsuario($userID = null) {
		$usuario = $this -> User -> read(null, $userID);
		return $usuario['User']['creditos'];
	}

	function creditosSuficientes($userID = null, $cantidadAVerificar = null, $minimoDeCreditos = null) {
		$usuario = $this -> User -> read(null, $userID);
		if (($usuario['User']['creditos'] + $usuario['User']['bonos']) >= $cantidadAVerificar) {
			if (!$minimoDeCreditos) {
				return true;
			} else {
				if (($usuario['User']['creditos'] + $usuario['User']['bonos']) >= $minimoDeCreditos) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	function descontarCreditos($subastaID = null, $userID = null, $creditosADescontar = null) {
		$user = $this -> User -> read(null, $userID);
		$creditosDescontados = 0;
		$bonosDescontados = 0;

		// Ver si el usuario tiene o no bonos
		//
		if ($user['User']['bonos'] > 0) {
			// El usuario tiene bonos; hay que descontar de estos primero
			//
			// Verificar si la cantidad de bonos disponible es mayor o igual
			// que la cantidad de creditos a descontar
			//
			if ($user['User']['bonos'] >= $creditosADescontar) {
				// La cantdidad de bonos disponible es mayor o igual que la
				// cantidad de creditos a descontar
				//
				$user['User']['bonos'] = $user['User']['bonos'] - $creditosADescontar;
				$bonosDescontados = $creditosADescontar;
			} else {
				// AquÃ­ los bonos no son suficientes para pagar la subasta; descontar
				// primero los bonos y luego descontar los creditos
				//
				$creditosADescontar = $creditosADescontar - $user['User']['bonos'];
				$bonosDescontados = $user['User']['bonos'];
				$user['User']['bonos'] = 0;
				$user['User']['creditos'] = $user['User']['creditos'] - $creditosADescontar;
				$creditosDescontados = $creditosADescontar;
			}
		} else {
			// El usuario no tiene bonos; descontar crÃ©ditos
			//
			$user['User']['creditos'] = $user['User']['creditos'] - $creditosADescontar;
			$creditosDescontados = $creditosADescontar;
		}

		if ($this -> User -> save($user)) {
			// Cargar el modelo Subasta
			//
			$this -> loadModel('Subasta');

			// Aumentar la duracion de la subasta
			//
			$subasta = $this -> Subasta -> read(null, $subastaID);
			$fecha_de_venta = date($subasta['Subasta']['fecha_de_venta']);
			$fecha_de_venta = strtotime(date("Y-m-d H:i:s", strtotime($fecha_de_venta)) . " +" . $subasta['Subasta']['aumento_duracion'] . " seconds");
			$fecha_de_venta = date("Y-m-d H:i:s", $fecha_de_venta);
			$fecha_de_venta = new DateTime($fecha_de_venta);
			$fecha_de_venta = $fecha_de_venta -> format('Y-m-d H:i:s');
			$subasta['Subasta']['fecha_de_venta'] = $fecha_de_venta;
			$this -> Subasta -> save($subasta);

			// Crear la oferta para finalizar el proceso
			//
			return $this -> requestAction('ofertas/crearOferta/' . $userID . '/' . $subastaID . '/' . $creditosDescontados . '/' . $bonosDescontados);
		} else {
			return false;
		}
	}

	function redimirCreditos() {
		if (!empty($this -> data)) {
			if ($user = $this -> User -> read(null, $this -> data['User']['user_id'])) {
				$creditos = $this -> requestAction('/codes/redimirCodigo/' . $this -> data['User']['codigo_a_redimir']);
				if ($creditos == 0) {
					$this -> Session -> setFlash(__('CÃ³digo no vÃ¡lido.', true));
				} else {
					$this -> User -> set('creditos', $user['User']['creditos'] + $creditos);
					$this -> User -> save();
					$this -> Session -> setFlash(__('Se redimiÃ³ el cÃ³digo', true));
				}
			} else {
				$this -> Session -> setFlash(__('No hay un usuario con esa ID', true));
			}
		}
	}

	function recomendar() {
		if (!empty($this -> data)) {
			// Proceder a enviar correos
			//
			$user_email = $this->Session->read('Auth.User.email');
			if (
				(!$this -> User -> find('first', array('conditions' => array('User.email' => $this -> data['User']['correo_recomendado_1']), 'recursive' => -1)))
				&& ($user_email != $this -> data['User']['correo_recomendado_1'])
			) {
				$this -> __enviarCorreoRecomendado($this -> data['User']['user_id'], $this -> data['User']['correo_recomendado_1']);
			}
			if (
				(!$this -> User -> find('first', array('conditions' => array('User.email' => $this -> data['User']['correo_recomendado_2']), 'recursive' => -1)))
				&& ($user_email != $this -> data['User']['correo_recomendado_2'])
			) {
				$this -> __enviarCorreoRecomendado($this -> data['User']['user_id'], $this -> data['User']['correo_recomendado_2']);
			}
			if (
				(!$this -> User -> find('first', array('conditions' => array('User.email' => $this -> data['User']['correo_recomendado_3']), 'recursive' => -1)))
				&& ($user_email != $this -> data['User']['correo_recomendado_3'])
			) {
				$this -> __enviarCorreoRecomendado($this -> data['User']['user_id'], $this -> data['User']['correo_recomendado_3']);
			}
			if (
				(!$this -> User -> find('first', array('conditions' => array('User.email' => $this -> data['User']['correo_recomendado_4']), 'recursive' => -1)))
				&& ($user_email != $this -> data['User']['correo_recomendado_4'])
			) {
				$this -> __enviarCorreoRecomendado($this -> data['User']['user_id'], $this -> data['User']['correo_recomendado_4']);
			}
			if (
				(!$this -> User -> find('first', array('conditions' => array('User.email' => $this -> data['User']['correo_recomendado_5']), 'recursive' => -1)))
				&& ($user_email != $this -> data['User']['correo_recomendado_5'])
			) {
				$this -> __enviarCorreoRecomendado($this -> data['User']['user_id'], $this -> data['User']['correo_recomendado_5']);
			}
			$this -> redirect(array("controller" => "users", 'action' => 'modificarDatos'));
		}
	}

	function getUsuario($userID = null) {
		if ($userID) {
			return $this -> User -> find('first', array('conditions' => array('User.id' => $userID), 'recursive' => -1));
		} else {
			return null;
		}
	}

	function comprarCreditos() {
		$id = $this -> Auth -> user("id");
		$this -> loadModel('Paquete');
		$paquetes = $this -> Paquete -> find('all');
		$this -> set('paquetes', $paquetes);
		$this -> set('user_id', $id);
	}

	function __enviarCorreoAbonoPorRecomendar($correoDestino = null, $email_usuario = null) {
		// Encriptar el ID de quien envía la recomendacion
		//
		if ($correoDestino && $email_usuario) {

			$user = $this -> User -> find('first', array('conditions' => array('User.email' => $correoDestino), 'recursive' => -1));
			$this -> loadModel('UserField');
			$user_fields = $this -> UserField -> find('first', array('conditions' => array('UserField.user_id' => $user['User']['id']), 'recursive' => -1));
			$bonos = $this -> requestAction('/configs/creditosPorRecomendacion');

			App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'MadMimi.class.php'));
			App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'Spyc.class.php'));

			$options = array('promotion_name' => 'suma_creditos', 'recipients' => $correoDestino, 'subject' => 'Suma Creditos', 'from' => 'no-reply@llevatelos.com');

			$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));

			$correo_recomendado = $email_usuario;

			$html_body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
					<title>Documento sin título</title>
					<style type=\"text/css\">
						.txt {
							font-family: Arial, Helvetica, sans-serif;
							font-size: 14px;
						}
						.nombre {
							color: #666;
						}
						.rojo {
							color: #F00;
						}
						.verde {
							color: #9C0;
						}
						.peke {
							font-size: 12px;
						}
			
					</style>
				</head>
				<body>
					[[tracking_beacon]]
					<table summary=\"\" width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
							<td width=\"75\" rowspan=\"3\" align=\"left\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//suma_creditos//d01.jpg\" width=\"75\" height=\"525\" /></td>
							<td align=\"center\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//suma_creditos//rp02.jpg\" width=\"285\" height=\"165\" /><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//suma_creditos//rp03.jpg\" width=\"315\" height=\"165\" /></td>
							<td width=\"50\" rowspan=\"3\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//suma_creditos//rp04.jpg\" width=\"50\" height=\"525\" /></td>
						</tr>
						<tr>
							<td width=\"600\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//suma_creditos//sc01.jpg\" width=\"420\" height=\"75\" /></td>
						</tr>
						<tr>
							<td valign=\"top\">
							<table summary=\"\" width=\"600\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
								<tr>
									<td>
									<p class=\"txt\">
										Hola,
									</p>
									<p class=\"txt\">
										$correo_recomendado se ha registrado exitosamente en llevatelos.com gracias a tu referencia
										y ahora tienes $bonos créditos nuevos que podrás usar en cualquier momento.
										<br />
										Gracias por referirnos y sigue trabajando con nosotros para atrapar tus sueños.
										<br />
										Revisa el listado de subastas actuales de llevatelos.com y escoge el artículo que podrá ser tuyo.
									</p>
									<p class=\"txt\">
										Ya tenemos muchos soñadores felices y tú puedes ser el próximo, te esperamos.
									</p>
									<p class=\"txt\">
										<span class=\"nombre\">Hasta pronto.</span>
										<br />
										<span class=\"peke\">Equipo llevatelos.com - Atrapa tus sueños. </span>
									</p></td>
								</tr>
							</table></td>
						</tr>
					</table>
				</body>
			</html>";

			$result = $mailer -> SendHTML($options, $html_body);

		} else {
			// TODO: Algun error
		}
	}

	function __enviarCorreoRecomendado($userID = null, $correoDestino = null) {
		// Encriptar el ID de quien envía la recomendacion
		//
		if ($userID) {
			$IDEncriptada = crypt($userID, "23()23*$%g4F^aN!^^%");
			$user = $this -> User -> read(null, $userID);
			$this -> loadModel('UserField');
			$user_fields = $this -> UserField -> find('first', array('conditions' => array('user_id' => $user['User']['id']), 'recursive' => -1));

			// TODO : Enviar el correo a $correoDestino con el enlace y la $IDEncriptada
			//

			if ($correoDestino) {
				App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'MadMimi.class.php'));
				App::import('Vendor', 'MadMimi', array('file' => 'madmimi' . DS . 'Spyc.class.php'));

				$options = array('promotion_name' => 'descubrelo', 'recipients' => $correoDestino, 'subject' => 'Descubrelo', 'from' => 'no-reply@llevatelos.com');

				$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));

				$correo_referente = $user['User']['email'];

				$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));

				$html_body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
					<head>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
						<title>Documento sin título</title>
						<style type=\"text/css\">
							.txt {
								font-family: Arial, Helvetica, sans-serif;
								font-size: 14px;
							}
							.nombre {
								color: #666;
							}
							.rojo {
								color: #F00;
							}
							.verde {
								color: #9C0;
							}
							.peke {
								font-size: 12px;
							}
				
						</style>
					</head>
					<body>
						[[tracking_beacon]]
						<table summary=\"\" width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td width=\"75\" rowspan=\"3\" align=\"left\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//descubrelo//d01.jpg\" width=\"75\" height=\"525\" /></td>
								<td align=\"center\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//descubrelo//rp02.jpg\" width=\"285\" height=\"165\" /><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//descubrelo//rp03.jpg\" width=\"315\" height=\"165\" /></td>
								<td width=\"50\" rowspan=\"3\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//descubrelo//rp04.jpg\" width=\"50\" height=\"525\" /></td>
							</tr>
							<tr>
								<td width=\"600\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//descubrelo//d02.jpg\" width=\"380\" height=\"87\" /></td>
							</tr>
							<tr>
								<td valign=\"top\">
								<table summary=\"\" width=\"600\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
									<tr>
										<td>
										<p class=\"txt\">
											Hola,
										</p>
										<p class=\"txt\">
											$correo_referente quiere que sepas que los sueños se pueden atrapar con un solo clic.
											<br />
											En llevatelos.com puedes tener contigo tecnología y diversión. Revisa la lista de sueños
											<br />
											o subastas, trabaja con nosotros y podrás ser un ganador de artículos como: <span class=\"rojo\">APPLE, DELL,
											<br />
											BLACKBERRY, MOTOROLA, SAMSUMG, CANON, SONY entre otros.</span>
										</p>
										<p class=\"txt\">
											Estos artículos serán tuyos por solo el 10% de su valor comercial, no dejes pasar esta
											<br />
											oportunidad, infórmate <span class=\"rojo\">¡HAZ CLIC AQUÍ Y LLEVATELOS YA! </span>
										</p>
										<p class=\"txt\">
											&nbsp;
										</p>
										<p class=\"txt\">
											Utiliza el siguiente enlace o registrate en la página mencionando a $correo_referente para
											bonificarlo por darte a conocer llevatelos.com
											&nbsp;									
										</p>
										<p class=\"txt\">
											<a href=\"http://www.llevatelos.com/users/register/$IDEncriptada\">¡Registrate aquí!</a>
											&nbsp;
										</p>
										<p class=\"txt\">
											<span class=\"nombre\">Hasta pronto.</span>
											<br />
											<span class=\"peke\">Equipo llevatelos.com - Atrapa tus sueños. </span>
										</p></td>
									</tr>
								</table></td>
							</tr>
						</table>
					</body>
				</html>";

				$result = $mailer -> SendHTML($options, $html_body);

			} else {
				// TODO : El correo destino no es valido
			}
		} else {
			// TODO : La ID de usuario no es valida
		}
	}

}
?>