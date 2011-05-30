<?php

class AppController extends Controller {

	var $components = array(
							"Auth" => array(
											'authorize' => 'controller'
										),
							"Session",
							"Acl",
							"Email",
							"Cookie",
							"RequestHandler"
						);
	var $uses = array("Config");
	
	public function isAuthorized() {
		return true;
	}

	function beforeFilter(){
		$this->Auth->allow("*");
		// Este comando de fields no enviaba la contraseña encriptada!!!!
		// Por eso lo comente -> Julio
		//$this->Auth->fields = array('username' => 'email', 'password' => 'password');
		$this->Auth->loginAction = array('controller'=>'users','action'=>'login');
		$this->Auth->loginRedirect= array('controller'=>'users','action'=>'index');
		$this->Auth->logoutRedirect= array('controller'=>'subastas','action'=>'index',"admin"=>false);
		$this->Auth->loginError = "Usuario o Password no válido";
		$this->Auth->authError = "No tiene permiso para ingresar a la cuenta.";
		$this->Auth->actionPath = 'controllers/';
		if(isset($this->params["prefix"]) && $this->params["prefix"]=="admin"){
			$this->layout="admin";
		}
		$this->Cookie->name = 'Llevatelos';
		$this->Cookie->time = '10 Days'; // or '1 hour'
		$this->Cookie->path = '/';
		   // $this->Cookie->domain = 'priceshoes.com';
		$this->Cookie->domain = 'localhost/subastas';
		$this->Cookie->secure = false; //i.e. only sent if using secure HTTPS
		$this->Cookie->key = 'qSI232qs*&sXOw!';
		
	}

	function beforeRender(){
		$PAGE_TITLE="llevatelos.com";
		$this->set(compact("PAGE_TITLE"));
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
	}

}
