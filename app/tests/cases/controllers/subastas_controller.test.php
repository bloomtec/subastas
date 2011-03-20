<?php
/* Subastas Test cases generated on: 2011-03-02 15:03:15 : 1299097575*/
App::import('Controller', 'Subastas');

class TestSubastasController extends SubastasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SubastasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.subasta', 'app.tipo_subasta', 'app.venta', 'app.oferta');

	function startTest() {
		$this->Subastas =& new TestSubastasController();
		$this->Subastas->constructClasses();
	}

	function endTest() {
		unset($this->Subastas);
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