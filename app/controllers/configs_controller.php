<?php
class ConfigsController extends AppController {

	var $name = 'Configs';

	function config(){
		return  $this->Config->read(null, 1);
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid config', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Config->save($this->data)) {
				$this->Session->setFlash(__('The config has been saved', true));
			} else {
				$this->Session->setFlash(__('The config could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Config->read(null, $id);
		}
	}
	
	function congelar() {
		$this->Config->read(null, 1);
		$this->Config->set('congelado', 1);
					
		if ($this->Config->save()) {
			$this->requestAction('/subastas/congelar/');
		}
	}
	
	function descongelar() {
		$this->Config->read(null, 1);
		$this->Config->set('congelado', 0);
		$this->Config->save();
	}
	
	function isCongelado() {
		$config = $this->Config->read('congelado', 1);
		if ($config['Config']['congelado'] == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function tamanoCola() {
		$config = $this->Config->read(null, 1);
		return $config['Config']['tamano_cola'];
	}
	
	function creditosPorRecomendacion () {
		$config = $this->Config->read(null, 1);
		return $config['Config']['creditos_recomendados'];
	}
	
	function creditosIniciales() {
		$config = $this->Config->read(null, 1);
		return $config['Config']['creditos_iniciales'];
	}
	
}
?>