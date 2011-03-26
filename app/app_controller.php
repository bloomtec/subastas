<?php

class AppController extends Controller {

	var $components=array("Acl","Session", "Auth","Config");

	function beforeFilter(){
		$this->Auth->actionPath = 'controllers/';
		if(isset($this->params["prefix"]) && $this->params["prefix"]=="admin"){
			$this->layout="admin";
		}
		$this->Auth->loginAction = array('controller'=>'users','action'=>'login');
		$this->Auth->loginRedirect = array('controller'=>'users','action'=>'menu');
		$this->Auth->allow('*');
	}

	function beforeRender(){
		$PAGE_TITLE="Titulo de la pagina";
		$this->set(compact("PAGE_TITLE"));
	}

}
