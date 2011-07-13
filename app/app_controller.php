<?php

class AppController extends Controller {

	var $components = array(
		"Auth",
		"Session",
		"Acl",
		"Email",
		"Cookie",
	);
	var $uses = array("Config");
	var $cacheAction = true;

	function beforeFilter(){
		$this->Auth->allow("*");
		$this->Auth->loginRedirect = array('controller'=>'users', 'action'=>'index');
		$this->Auth->logoutRedirect = array('controller'=>'subastas', 'action' => 'index', "admin" => false);
		$this->Auth->loginError = "Usuario o contraseña no válidos";
		$this->Auth->authError = "No tiene permiso para ingresar a esta sección.";
		if(isset($this->params["prefix"]) && $this->params["prefix"]=="admin"){
			$this->layout="admin";
			$this->Auth->deny($this->action);
		}
		$this->Cookie->name = 'Llevatelos';
		$this->Cookie->time = '10 Days'; // or '1 hour'
		$this->Cookie->path = '/';
		$this->Cookie->domain = 'www.llevatelos.com';
		$this->Cookie->secure = false; //i.e. only sent if using secure HTTPS
		$this->Cookie->key = 'qSI232qs*&sXOw!';
	}

	function beforeRender(){
		$PAGE_TITLE="Llévatelos :: ";
		$this->set(compact("PAGE_TITLE"));
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
	}

}
