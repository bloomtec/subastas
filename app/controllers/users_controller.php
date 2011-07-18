<?php
class UsersController extends AppController {

	var $name = 'Users';

	private $directorioFoto="";
	private $administradorRolId=1;
	private $clienteRolId=2;
	private $registradoRolId =2;

	function beforeFilter(){
		parent::beforeFilter();
		//$this->Auth->deny("login","abonarCreditosPorRecomendacion","checkEmail","register","checkPassword","rememberPassword","reponerCreditos","creditosUsuario","creditosSuficientes","descontarCreditos");
	}

	function index() {
		//debug($this->User->read(null,$this->Auth->user("id")));
		$this->set('user', $this->User->read(null,$this->Auth->user("id")));
	}
	
	function validarCompra() {
		$this->autoRender=false;
		
		$datos = explode("-", $_POST['codigoFactura']);
		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions'=>array('User.id'=>$datos[1])));
		$this->Auth->login($user);
		
		if($_POST['codigoAutorizacion'] == "00") {
			//echo "La compra no pudo realizarse";
			//
			//$this->Session->setFlash('La compra no pudo realizarse');
			
			echo "<center>";
			echo "La compra no pudo realizarse";
			echo "<form action='../../subastas'>";
			echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
			echo "</form>";
			echo "</center>";
			
		} else {
			$llaveencripcion = "6b7c2e50e9f54b3fb630197255e034ac";
			$cadena = $llaveencripcion . 
			";" .
			$_POST['codigoFactura'] . 
			";" . 
			$_POST['valorFactura'] . 
			";" . 
			$_POST['codigoAutorizacion']; 
			
			if(md5($cadena) == $_POST['firmaTuCompra']) { 
				// Compra realizada con exito
				//
				if ($datos[0] == 1) {
					// Se compro un paquete de creditos
					// Encontrar al usuario y sumarle los creditos
					//
					$user = $this->User->find('first', array('conditions'=>array('User.id'=>$datos[1])));
					$this->User->read(null, $datos[1]);
					$this->User->set('creditos', $user['User']['creditos'] + $datos[2]);
					$this->User->save();
				} else {
					if ($datos[0] == 2) {
						// Se compro una subasta ganada
						// Llamar el metodo de ventas y enviarle la id
						//
						$this->requestAction('/ventas/pagada/' . $datos[2]);
					} else {
						//Nada por hacer bajo las condiciones actuales
						//
					}
				}
				
				//$this->Session->setFlash('La compra fue exitosa');
				
				echo "<center>";
				echo "La compra fue exitosa";
				echo "<form action='../../subastas'>";
				echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
				echo "</form>";
				echo "</center>";
			} else { 
				//la firma es invalida
				//
				//$this->Session->setFlash('La compra no pudo realizarse - La firma de confirmacion no es valida');
				
				echo "<center>";
				echo "La compra no pudo realizarse - La firma de confirmacion no es valida";
				echo "<form action='../../subastas'>";
				echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
				echo "</form>";
				echo "</center>";
			} 
		}
		//$this->redirect(array('action' => 'index'));
	}
	
	function ingresoPIN () {
		$this->autoRender = false;
		
		$this->loadModel('Code');
		
		// Obtener el codigo de la BD
		$code = $this->Code->find(
			'first', array(
				'conditions'=>array(
					'estado'=>1,
					'codigo'=>$this->data['User']['pin'],
					'fecha_expiracion >='=>date('Y-m-d')
				)
			)
		);
		
		if ($code) {
			// Cambiar el estado del codigo
			//
			$this->Code->read(null, $code['Code']['id']);
			$this->Code->set('estado', 0);
			$this->Code->save();
			
			// Sumarle los creditos al usuario
			//
			$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Auth->user('id'))));
			$this->User->read(null, $this->Auth->user('id'));
			$this->User->set('creditos', $user['User']['creditos'] + $code['Code']['creditos']);
			$this->User->save();
			
			$this->Session->setFlash('Se redimio su codigo');
		} else {
			$this->Session->setFlash('Codigo no valido. Verifique el codigo, la fecha de expiracion e intente de nuevo');
		}
		$this->redirect(array('action' => 'comprarCreditos'));
	}

	function modificarDatos(){
		$id=$this->Auth->user("id");
		if (!empty($this->data)){
			$this->data["User"]["id"]=$id;
			if ($this->User->saveAll($this->data,array("validate"=>false))) {
				$this->Session->setFlash(__('Usuario modificado', true));

				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser modificado. Por favor, intÃ©ntelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function getCreditos(){
		$this->User->recursive=-1;
		$user=$this->User->read(null,$this->Auth->user("id"));
		if(!empty($this->params['requested'])){
			return $user["User"]["creditos"];
		}
		if($this->RequestHandler->isAjax()){
			echo $user["User"]["creditos"];
			Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);
		}
	}

	function getBonos(){
		$this->User->recursive=-1;
		$user=$this->User->read(null,$this->Auth->user("id"));
		if(!empty($this->params['requested'])){
			return $user["User"]["bonos"];
		}
		if($this->RequestHandler->isAjax()){
			echo $user["User"]["bonos"];
			Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);
		}
	}
	
	function __abonarCreditosPorRecomendacion($email = null, $email_usuario = null){
		if ($email) {
			$user = $this->User->find('first', array('conditions' => array('User.email' => $email)));
			debug($user);
			if($user) {
				$this->User->read(null, $user['User']['id']);
				$this->User->set('bonos', $user['User']['bonos'] + $this->requestAction('/configs/creditosPorRecomendacion'));
				$this->User->save();
				$this->__enviarCorreoAbonoPorRecomendar($email, $email_usuario);
			}
		}
	}
	
	function __obtenerCorreoReferente($encryptedID = null){
		// Encontrar el total de usuarios registrados
		//
		$totalUsuarios = $this->User->find('count', array('conditions' => array('User.id >' => 0)));
		$usuario = null;
		for ($id = 1; $id < $totalUsuarios; $id++) {
			if ($encryptedID == crypt($id, "23()23*$%g4F^aN!^^%")) {
				// Las ID son iguales, abonar por recomendacion
				//
				$usuario = $this->User->read(null, $id);
				break;
			} else {
				// Seguir buscando
				//
			}
		}
		return $usuario['User']['email'];
	}

	function checkEmail(){
		$checkMail=$this->User->findByEmail($_GET["data"]["User"]["email"]);
		$checUserName=$this->User->findByEmail($_GET["data"]["User"]["username"]);
		$devolver;
		if($checkMail||$checUserName){
			if($checkMail)$devolver["data[User][email]"]="el email se encuentra registrado";
			if($checUserName)$devolver["data[User][username]"]="el nombre de usuario se encuentra registrado";
			//echo json_encode(array("data[User][email]"=>"el email se encuentra registrado"));
			echo json_encode($devolver);
			Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);

		}else{
			echo json_encode(true);
			Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);
		}
		Configure::write("debug",0);
		$this->autorender=false;
		exit(0);
	}
	
	function register(){
		if (!empty($this->data)) {
			$this->User->recursive = 0;
			$this->User->create();
			$this->data['User']['role_id'] = 2; // Is set as a Basic user for default
			$user_pass = $this->data['User']['password'];
			if ($this->User->save($this->data)) {
				$this->data['UserField']['user_id'] = $this->User->id;
				$this->User->UserField->save($this->data["UserField"]);
				if (isset($this->data['User']['referido_por'])) {
					$this->__abonarCreditosPorRecomendacion($this->data['User']['referido_por'], $this->data['User']['email']);
				}
				
				// Importar clases de Mad Mimi
				//
				App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'MadMimi.class.php'));
				App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'Spyc.class.php'));
				
				// Crear el objeto de Mad Mimi
				//
				$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));
				
				// Arreglo para añadir un usuario a Mad Mimi
				//
				$userMimi = array(
					'email' => $this->data['User']['email'],
					'firstName' => $this->data['User']['username'],
					'add_list' => 'cuentas-creadas'
				);
				
				// Añadir el usuario a Mad Mimi
				//
				$mailer->AddUser($userMimi);
				
				$this->Session->setFlash(__('Su registro ha sido exitoso', true));
				$this->Auth->login($this->data);
				$this->Cookie->write("registrado", true);
				
				// Opciones de configuracion para enviar un correo via Mad Mimi
				//
				$options = array(
					'promotion_name' => 'Welcome-Message',
					'recipients' => $this->data['User']['email'],
					'from' => 'no-reply@llevatelos.com'
				);
				
				// Opciones del cuerpo de mensaje de Mad Mimi
				//
				$body = array(
					'usuario' => $this->data['User']['username'],
					'contraseña' => $user_pass,
					'nombres' => $this->data['UserField']['nombres'],
					'apellidos' => $this->data['UserField']['apellidos']
				);
				
				// Enviar el mensaje via Mad Mimi
				//
				$mailer->SendMessage($options, $body);
				
				if($this->referer()=="/") {
					$this->redirect(array("controller"=>"subastas",'action' => 'index'));
				} else {
					$this->redirect(array("controller"=>"users",'action' => 'recomendar'));
				}
				
			} else {
				$this->Session->setFlash(__('No se pudo completar el registro. Por favor, intente de nuevo', true));
			}
		} else {
			if(!empty($this->params['pass'][0])){
				$this->set('email_referente', $this->__obtenerCorreoReferente($this->params['pass'][0]));
			}
		}
	}
	
	function checkPassword(){
		$this->User->recursive=0;
		$user=$this->User->read(null,$this->Auth->user("id"));
		if($user["User"]["password"]==$this->Auth->password($_GET["data"]["User"]["actualPassword"])){
			$user["User"]["password"]=$this->Auth->password($_GET["data"]["User"]["password"]);
			$this->User->save($user,array("validate"=>false));
			$this->Session->setFlash(__('Se ha modificado su contraseña', true));
			echo json_encode(true);
		}else{
			echo json_encode(array("data[User][actualPassword]"=>"Contraseña actual no valida"));
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
	
	function changePassword(){
		if(!empty($this->data)){
				
		}
	}

	function menu(){
		if(!$this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'menu')){
			$this->Session->setFlash(__($this->Auth->authError, true));
			$this->redirect($this->referer());
		}
	}

	function admin_menu(){
		if(!$this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'admin_menu')){
			$this->Session->setFlash(__($this->Auth->authError, true));
			$this->redirect($this->referer());
		}
	}

	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$aro =& $this->Acl->Aro;
				$elaro=$aro->find("first",array("conditions"=>array("Model"=>"Role","foreign_key"=>$this->data["User"]["role_id"])));
				$newAro=array(
					"alias"=>$this->data["User"]["username"],
					"parent_id"=>$elaro["Aro"]["id"],
					"foreign_key"=>$this->User->id,
					"model"=>"User",
				);
				$aro->create();
				$aro->save($newAro);
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	function admin_edit($id = null) {

		//$foto['user']['foto'] = $this->User->find("first", array('fields'=>'foto','conditions'=>array('User.id'=>'$id')));

		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data))
		{
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}

		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	//LOGIN USER
	function login(){
				
		if (!empty($this->data) && !empty($this->Auth->data['User']['username']) && !empty($this->Auth->data['User']['password'])) {

			$user =
				$this->User->find(
					'first',
					array(
						'conditions' => array(
											'username' => $this->Auth->data['User']['username'],
											'password' => $this->Auth->data['User']['password']
										),
						'recursive' => -1
					)
				);
		
			if (!$user) {
				$user =
					$this->User->find(
						'first',
						array(
							'conditions' => array(
												'email' => $this->Auth->data['User']['username'],
												'password' => $this->Auth->data['User']['password']
											),
							'recursive' => -1
						)
					);
			}
			
			if (!empty($user) && $this->Auth->login($user)) {

				$userId = $this->Auth->user('id');
				$this->set("login", true);

				if ($this->Auth->autoRedirect) {
					$this->redirect($this->Auth->redirect());
				}

			} else {
				$this->Session->setFlash("Por favor ingrese la direcciÃ³n de correo electrÃ³nico con la que te registraste");
			}

		} else {
			//$this->Session->setFlash("Ingrese su usuario/correo y contraseÃ±a");
		}

	}

	function admin_login(){
		$this->set("login",true);
	}

	//LOGOUT USER
	function logout() {
		$this->redirect($this->Auth->logout());
	}

	function admin_logout() {
		$this->redirect($this->Auth->logout());
	}

	//Recordar email
	//Recordar email
	function generarPassword(){
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<8;$i++) {
			$cad .= substr($str,rand(0,62),1);
		}
		return $cad;
	}
	
	function rememberPassword(){
		if (!empty($this->data)) {
			$this->User->recursive=0;
			$datos=$this->User->find("first", array(
									'conditions'=>array('User.email'=>trim($this->data['User']['email']))));
				
			$newPassword=$this->generarPassword();
			//debug($newPassword);
			$datos["User"]["password"]=$this->Auth->password($newPassword);
			//debug($datos);
			if($datos['User']['email']){
				$para      = $datos['User']['email'];
				$asunto    = 'Recuperacion de contraseÃ±a';
				$mensaje   = 'Sus datos para ingresar al portal llevatelos.com son los siguientes: <br /> Nombre de usuario: '.$datos['User']['email'].
							 ' <br /> ContraseÃ±a: '.$newPassword;
					
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Cabeceras adicionales
				$cabeceras .= "To:< ".$datos['User']['email'].">" . "\r\n";
				$cabeceras .= 'From: llevatelos.com <info@llevatelos.com>' . "\r\n";

				if(mail($para, $asunto, $mensaje, $cabeceras)){
					$this->User->save($datos,array("validate"=>false));
					$this->set("mensaje",'Datos enviados a su correo');
				} else {
					$this->set("mensaje",'Datos no enviados a su correo, por favor intenta mas tarde');
				}
				return;
			} else {
				$this->set("mensaje",'No existe ningun usuario registrado con ese email');
				return;
			}
		}
	}

	function reponerCreditos($userID = null, $creditosAReponer = null, $bonosAReponer = null){
		$usuario = $this->User->read(null, $userID);
		$creditos = $usuario['User']['creditos'];
		$bonos = $usuario['User']['bonos'];
		$this->User->set('creditos', $creditos + $creditosAReponer);
		$this->User->set('bonos', $bonos + $bonosAReponer);
		$this->User->save();
	}

	function creditosUsuario($userID = null){
		$usuario = $this->User->read(null, $userID);
		return $usuario['User']['creditos'];
	}

	function creditosSuficientes($userID = null, $cantidadAVerificar = null, $minimoDeCreditos = null){
		$usuario = $this->User->read(null, $userID);
		if(($usuario['User']['creditos'] + $usuario['User']['bonos']) >= $cantidadAVerificar){
			if(!$minimoDeCreditos){
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

	function descontarCreditos ( $subastaID = null, $userID = null, $creditosADescontar = null ) {
		$user = $this->User->read(null, $userID);
		$creditosDescontados = 0;
		$bonosDescontados = 0;
		
		// Ver si el usuario tiene o no bonos
		//
		if($user['User']['bonos'] > 0) {
			// El usuario tiene bonos; hay que descontar de estos primero
			//
			// Verificar si la cantidad de bonos disponible es mayor o igual
			// que la cantidad de creditos a descontar
			//
			if($user['User']['bonos'] >= $creditosADescontar) {
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
		
		if($this->User->save($user)) {
			// Cargar el modelo Subasta
			//
			$this->loadModel('Subasta');
			
			// Aumentar la duracion de la subasta
			//
			$subasta = $this->Subasta->read(null, $subastaID);
			$fecha_de_venta = date($subasta['Subasta']['fecha_de_venta']);
			$fecha_de_venta = strtotime(date("Y-m-d H:i:s", strtotime($fecha_de_venta)) . " +" . $subasta['Subasta']['aumento_duracion'] . " seconds");
			$fecha_de_venta = date("Y-m-d H:i:s", $fecha_de_venta);
			$fecha_de_venta = new DateTime($fecha_de_venta);
			$fecha_de_venta = $fecha_de_venta->format('Y-m-d H:i:s');
			$subasta['Subasta']['fecha_de_venta'] = $fecha_de_venta;
			$this->Subasta->save($subasta);
			
			// Crear la oferta para finalizar el proceso
			//
			return $this->requestAction('ofertas/crearOferta/' . $userID. '/' . $subastaID . '/' . $creditosDescontados . '/' . $bonosDescontados);
		} else {
			return false;
		}
	}

	function redimirCreditos () {
		if(!empty($this->data)){
			if($user = $this->User->read(null, $this->data['User']['user_id'])){
				$creditos = $this->requestAction('/codes/redimirCodigo/' . $this->data['User']['codigo_a_redimir']);
				if ($creditos == 0) {
					$this->Session->setFlash(__('CÃ³digo no vÃ¡lido.', true));
				} else {
					$this->User->set('creditos', $user['User']['creditos'] + $creditos);
					$this->User->save();
					$this->Session->setFlash(__('Se redimiÃ³ el cÃ³digo', true));
				}
			} else {
				$this->Session->setFlash(__('No hay un usuario con esa ID', true));
			}
		}
	}

	function recomendar() {
		if(!empty($this->data)){
			// Proceder a enviar correos
			//
			if(!$this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['correo_recomendado_1'])))) {
				$this->__enviarCorreoRecomendado($this->data['User']['user_id'], $this->data['User']['correo_recomendado_1']);
			}
			if(!$this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['correo_recomendado_2'])))) {
				$this->__enviarCorreoRecomendado($this->data['User']['user_id'], $this->data['User']['correo_recomendado_2']);
			}
			if(!$this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['correo_recomendado_3'])))) {
				$this->__enviarCorreoRecomendado($this->data['User']['user_id'], $this->data['User']['correo_recomendado_3']);
			}
			if(!$this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['correo_recomendado_4'])))) {
				$this->__enviarCorreoRecomendado($this->data['User']['user_id'], $this->data['User']['correo_recomendado_4']);
			}
			if(!$this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['correo_recomendado_5'])))) {
				$this->__enviarCorreoRecomendado($this->data['User']['user_id'], $this->data['User']['correo_recomendado_5']);
			}
		}
	}

	function getUsuario($userID = null) {
		if ($userID) {
			return $this->User->find('first', array('conditions'=>array('User.id'=>$userID)));
		} else {
			return null;
		}
	}

	function comprarCreditos(){
		$id=$this->Auth->user("id");
		$this->loadModel('Paquete');
		$paquetes = $this->Paquete->find('all');
		$this->set('paquetes', $paquetes);
		$this->set('user_id', $id);
	}

	function __enviarCorreoAbonoPorRecomendar($correoDestino = null, $email_usuario = null){
		// Encriptar el ID de quien envÃ­a la recomendacion
		//
		if ($correoDestino) {
			$para = $correoDestino;
			$asunto = 'Â¡Alguien se inscribiÃ³ luego de que lo recomendaras!';
			$mensaje = "Saludos, se te han abonado creditos por haber recomendado nuestra pÃ¡gina a $email_usuario." .
					"\n Registrate usando este link para llevarte un beneficio de creditos.";

			$cabeceras = 'From: webmaster@example.com' .
					"\r\n" . 
					'Reply-To: webmaster@example.com' . "\r\n" . 
					'X-Mailer: PHP/' . phpversion();

			if(mail($para, $asunto, $mensaje, $cabeceras)) {
				$this->Session->setFlash(__('Datos enviados a su correo', true));
			} else {
				$this->Session->setFlash(__('Datos no enviados a su correo, por favor intenta mas tarde', true));
			}
				
			return;
		} else {
			// TODO: Algun error con el correo destino
		}
	}
	
	function __enviarCorreoRecomendado($userID = null, $correoDestino = null){
		// Encriptar el ID de quien envÃ­a la recomendacion
		//
		if ($userID) {
			$IDEncriptada = crypt($userID, "23()23*$%g4F^aN!^^%");
			
			// TODO : Enviar el correo a $correoDestino con el enlace y la $IDEncriptada
			//

			if ($correoDestino) {
				$para = $correoDestino;
				$asunto = 'Te han recomendado la pÃ¡gina LLEVATELOS.COM';
				$mensaje = 'Hola, te han recomendado en nuestra pÃ¡gina.' .
						'\n Registrate usando este link para llevarte un beneficio de creditos.' . 
						'\n http://www.llevatelos.com/users/register/' . $IDEncriptada;

				$cabeceras = 'From: webmaster@example.com' .
						"\r\n" . 
						'Reply-To: webmaster@example.com' . "\r\n" . 
						'X-Mailer: PHP/' . phpversion();

				if(mail($para, $asunto, $mensaje, $cabeceras)) {
					$this->Session->setFlash(__('Datos enviados a su correo', true));
				} else {
					$this->Session->setFlash(__('Datos no enviados a su correo, por favor intenta mas tarde', true));
				}
					
				return;
			} else {
				// TODO : El correo destino no es valido
			}
		} else {
			// TODO : La ID de usuario no es valida
		}
	}

}
?>