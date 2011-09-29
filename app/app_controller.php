<?php

class AppController extends Controller {

	var $components = array(
		"Auth",
		"Session",
		"Acl",
		"Email",
		"Cookie",
	);
	var $uses = array("Config","User");
	var $cacheAction = true;

	function beforeFilter() {
		 if ($this->action == 'login' && !empty($this->data['User']['username'])) {
		      $user =
				$this->User->find(
					'first',
					array(
						'conditions' => array(
											'username' => $this->data['User']['username'],
											'password' => $this->Auth->password($this->data['User']['password'])
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
												'email' => $this->data['User']['username'],
												'password' => $this->Auth->password($this->data['User']['password'])
											),
							'recursive' => -1
						)
					);
			}
			
				
			if($user){
				if(!$user["User"]["email_validado"]){// SI NO HA VERIFICADO EL MAIL NO LO DEJA LOGUEAR
				
					$this->redirect(array('action' => 'confirmRegister'));
				}   
			}
			    
		}
		$this->Auth->allow("*");
		$this->Auth->loginRedirect = array('controller'=>'users', 'action'=>'index');
		$this->Auth->logoutRedirect = array('controller'=>'subastas', 'action' => 'index', "admin" => false);
		$this->Auth->loginError = "Usuario o contraseña no válidos";
		$this->Auth->authError = "No tiene permiso para ingresar a esta sección.";
		$this->Auth->userScope = array('User.email_validado' => true);
		if(isset($this->params["prefix"]) && $this->params["prefix"]=="admin"){
			$this->layout="admin";
			$this->Auth->deny($this->action);
		}
		$this->Cookie->name = 'Llevatelos';
		$this->Cookie->time = '10 Days'; // or '1 hour'
		$this->Cookie->path = '/';
		$this->Cookie->domain = 'localhost';
		$this->Cookie->secure = false; //i.e. only sent if using secure HTTPS
		$this->Cookie->key = 'sfWQAFggasdj5231sXOw!';
		
		if($this->Auth->user("id")) {
			setcookie("_data", $this->Auth->user("id"), time() + 3600, "/");
		}
	}

	function beforeRender() {
		$PAGE_TITLE="Llévatelos :: ";
		$this->set(compact("PAGE_TITLE"));
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
		
	}

}
