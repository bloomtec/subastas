<?php
/* Configuraciones Test cases generated on: 2011-03-15 02:03:22 : 1300154002*/
App::import('Controller', 'Configuraciones');

class TestConfiguracionesController extends ConfiguracionesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ConfiguracionesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.configuracione');

	function startTest() {
		$this->Configuraciones =& new TestConfiguracionesController();
		$this->Configuraciones->constructClasses();
	}

	function endTest() {
		unset($this->Configuraciones);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>