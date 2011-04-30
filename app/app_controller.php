<?php

class AppController extends Controller {

	var $components=array("Acl","Session", "Auth", "Email");
	var $uses=array("Config");

	function beforeFilter(){
		$this->Auth->allow("*");
		$this->Auth->fields = array(
		'username' => 'email',
		'password' => 'password'
		);
		$this->Auth->loginAction = array('controller'=>'users','action'=>'login');
		$this->Auth->loginRedirect= array('controller'=>'users','action'=>'index');
		$this->Auth->logoutRedirect= array('controller'=>'subastas','action'=>'index',"admin"=>false);
		$this->Auth->loginError = "Usuario o Password no válido";
		$this->Auth->authError = "No tiene permiso para ingresar a la cuenta.";
		$this->Auth->actionPath = 'controllers/';
		if(isset($this->params["prefix"]) && $this->params["prefix"]=="admin"){
			$this->layout="admin";
		}
		
	}

	function beforeRender(){
		$PAGE_TITLE="Titulo de la pagina";
		$this->set(compact("PAGE_TITLE"));
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
	}

}
