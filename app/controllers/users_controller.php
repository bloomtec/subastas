<?php
class UsersController extends AppController {

	var $name = 'Users';

	private $directorioFoto="";
	private $administradorRolId=1;
	private $clienteRolId=2;
	private $registradoRolId =2;

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('*'));

	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function abonarCreditosPorRecomendacion($encryptedID = null){
		// Encontrar el total de usuarios registrados
		//
		$totalUsuarios = $this->User->find('count', array('conditions' => array('User.id >' => 0)));
		for ($id = 1; $id < $totalUsuarios; $id++) {
			if ($encryptedID == crypt($id, "23()23*$%g4F^aN!^^%")) {
				// Las ID son iguales, abonar por recomendacion
				// 
				$this->User->read(null, $id);
				$this->User->set('creditos', $this->User->creditos + $this->requestAction('/configs/creditosPorRecomendacion'));
				$this->User->save();
				break;
			} else {
				// Seguir buscando
				//
			}
		}
	}

	function checkEmail(){
		$checkMail=$this->User->findByEmail($_GET["data"]["User"]["email"]);
			if($checkMail){
				echo json_encode(array("data[User][email]"=>"el email se encuentra registrado"));
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
			$this->data["User"]["role_id"]=2;// Is set as a Basic user for default
		  if ($this->User->saveAll($this->data)) 
			{
				if (isset($this->data['Recomendado'])) {
                    $this->abonarCreditosPorRecomendacion($this->data['Recomendado']['id']);
                }
		        $para      = $this->data['User']['email'];
				$asunto    = 'Bienvenido a Tecnocenter';
				$mensaje   = 'Bienvenido, sus datos de ingreso al portal Tecnocenter son los siguientes:<br> Nombre de usuario (email) :'.$this->data['User']['email'].
							 '<br>Contraseña: '.$this->data['User']['password'];
				 
				$cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Cabeceras adicionales
				$cabeceras .= 'From: Tecnocenter <info@llevatelo.com>' . "\r\n";

				/*if(mail($para, $asunto, $mensaje, $cabeceras))
				{
					$this->Session->setFlash(__('Bienvenido', true));
				}else 
				{
						$this->Session->setFlash(__('Bienvenido', true));
					//$this->Session->setFlash(__('Datos de logueo no enviados a su correo, por favor intenta mas tarde', true));
				}*/
			
				//$rol=$this->Session->read("Auth.User.role_id");
				$this->Session->setFlash(__('Su registro ha sido éxitoso', true));
				$this->Auth->login($this->data);
				$this->redirect(array("controller"=>"users",'action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo completar el registro. Por favor, intente de nuevo', true));
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
			echo json_encode(array("data[User][actualPassword]"=>"Contraseña Actual no valida"));
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
  	function changePassword(){
  		if(!empty($this->data)){
  			
  		}
  	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
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
		$this->set("login",true);
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
	function rememberPassword(){
		if (!empty($this->data)) {
			$datos=$this->User->find("first", array('fields'=>array('email','username','password'),
									'conditions'=>array('User.email'=>trim($this->data['User']['email']))));

			if($datos['User']['email'])	{
				$para      = $datos['User']['email'];
				$asunto    = 'Recuperación de datos logueo';
				$mensaje   = 'Hola, sus datos de logueo son :<br> Nombre de usuario :'.$datos['User']['username'].
							 '<br>Contraseña: '.$datos['User']['password'];
					
				$cabeceras = 'From: webmaster@example.com' . "\r\n" .
				    		 'Reply-To: webmaster@example.com' . "\r\n" .
				    		 'X-Mailer: PHP/' . phpversion();

				if(mail($para, $asunto, $mensaje, $cabeceras)) {
					$this->Session->setFlash(__('Datos enviados a su correo', true));
				} else {
					$this->Session->setFlash(__('Datos no enviados a su correo, por favor intenta mas tarde', true));
				}
				return;
			} else {
				$this->Session->setFlash(__('No existe ningun usuario registrado con ese email', true));
				return;
			}
		}
	}

	
	function reponerCreditos($userID = null, $creditosAReponer){
		$usuario = $this->User->read(null, $userID);
		$creditos = $usuario['User']['creditos'];
		$this->User->set('creditos', $creditos + $creditosAReponer);
		$this->User->save();
	}

	function creditosUsuario($userID = null){
		$usuario = $this->User->read(null, $userID);
		return $usuario['User']['creditos'];
	}

	function creditosSuficientes($userID = null, $cantidadAVerificar = null){
		$usuario = $this->User->read(null, $userID);
		if($usuario['User']['creditos'] >= $cantidadAVerificar){
			return true;
		} else {
			return false;
		}
	}

	function descontarCreditos ( $userID = null, $creditosADescontar = null ) {
		$user = $this->User->read(null, $userID);
		$this->User->read(null, $userID);
		$this->User->set('creditos', $user['User']['creditos'] - $creditosADescontar);
		$this->User->save();
	}

	function redimirCreditos () {
		if(!empty($this->data)){
			if($user = $this->User->read(null, $this->data['User']['user_id'])){
				$creditos = $this->requestAction('/codes/redimirCodigo/' . $this->data['User']['codigo_a_redimir']);
				if ($creditos == 0) {
					$this->Session->setFlash(__('Código no válido.', true));
				} else {
					$this->User->set('creditos', $user['User']['creditos'] + $creditos);
					$this->User->save();
					$this->Session->setFlash(__('Se redimió el código', true));
				}
			} else {
				$this->Session->setFlash(__('No hay un usuario con esa ID', true));
			}
		}
	}

	function recomendar() {
		if(!empty($this->data)){
			debug($this->data);
			// Proceder a enviar correos
			//
			$this->__enviarCorreoRecomendado($this->data['User']['id'], $this->data['User']['correo_amigo_1']);
			$this->__enviarCorreoRecomendado($this->data['User']['id'], $this->data['User']['correo_amigo_2']);
			$this->__enviarCorreoRecomendado($this->data['User']['id'], $this->data['User']['correo_amigo_3']);
			$this->__enviarCorreoRecomendado($this->data['User']['id'], $this->data['User']['correo_amigo_4']);
			$this->__enviarCorreoRecomendado($this->data['User']['id'], $this->data['User']['correo_amigo_5']);
		} else {
			$this->Session->setFlash(__('Error al leer los datos ingresados', true));
		}
	}

	function enviarCorreoRecomendado($userID = null, $correoDestino = null){
		// Encriptar el ID de quien envía la recomendacion
		//
		$IDEncriptada = crypt($userID, "23()23*$%g4F^aN!^^%");

		// TODO : Enviar el correo a $correoDestino con el enlace y la $IDEncriptada
		//

		/**
		 if (!empty($this->data)) {
		 $asunto="Nuevo Mensaje de la Página Web";
		 $from=$this->data["Page"]["nombre_completo"]."<".$this->data["Page"]["email"].">";
		 $nombreDestinatario=$this->data["Page"]["nombre_completo"];
		 $asunto=$this->data["Page"]["asunto"]." - Enviado desde la página web";
		 $telefono=$this->data["Page"]["telefono"];
		 $texto=$this->data["Page"]["asunto"];
		 $cadena="Enviado por ".$nombreDestinatario." <".$from."> \n\n".$texto;
		 $to      = 'carolina.lugo@narujoyeriadeautor.com';
		 $headers = 'From: '.$from . "\r\n" .
		 'Reply-To: '.$from . "\r\n" .
		 'X-Mailer: PHP/' . phpversion();

		 mail($to, $asunto, $cadena, $headers);
			}
			$this->set("title","Contacto");
		 */

	}

}
?>