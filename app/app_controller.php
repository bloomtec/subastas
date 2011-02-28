<?php

class AppController extends Controller {
	var $components=array("Acl","Session", "Auth");	
	
	function beforeFilter()
	{
		if(isset($this->params["prefix"])&&$this->params["prefix"]=="admin") $this->layout="admin";
		$this->Auth->loginAction = array('controller'=>'users','action'=>'login');
		$this->Auth->allow('*');
		$this->Auth->loginRedirect  = array('controller'=>'users','action'=>'menu');

	}
	function beforeRender(){
		$PAGE_TITLE="Titulo de la pagina";
		$this->set(compact("PAGE_TITLE"));
	}


}
