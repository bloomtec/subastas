<?php
class CodesController extends AppController {

	var $name = 'Codes';

	function index() {
		$this->Code->recursive = 0;
		$this->set('codes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('code', $this->Code->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Code->create();
			if ($this->Code->save($this->data)) {
				$this->Session->setFlash(__('The code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The code could not be saved. Please, try again.', true));
			}
		}
		$batchCodes = $this->Code->BatchCode->find('list');
		$this->set(compact('batchCodes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Code->save($this->data)) {
				$this->Session->setFlash(__('The code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Code->read(null, $id);
		}
		$batchCodes = $this->Code->BatchCode->find('list');
		$this->set(compact('batchCodes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Code->delete($id)) {
			$this->Session->setFlash(__('Code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Code->recursive = 0;
		$this->set('codes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('code', $this->Code->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Code->create();
			if ($this->Code->save($this->data)) {
				$this->Session->setFlash(__('The code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The code could not be saved. Please, try again.', true));
			}
		}
		$batchCodes = $this->Code->BatchCode->find('list');
		$this->set(compact('batchCodes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Code->save($this->data)) {
				$this->Session->setFlash(__('The code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Code->read(null, $id);
		}
		$batchCodes = $this->Code->BatchCode->find('list');
		$this->set(compact('batchCodes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Code->delete($id)) {
			$this->Session->setFlash(__('Code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function generarCodigo($batchCodeID = 0, $creditos = 0, $dia = 0, $mes = 0, $año = 0){
		$length = 12;
		$string = "";
		$possible = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		for($i=0;$i < $length;$i++) {
			$char = $possible[mt_rand(0, strlen($possible)-1)];
			$string .= $char;
		}

		$this->Code->create();
		$this->Code->set('batch_code_id', $batchCodeID);
		$this->Code->set('codigo', $string);
		$this->Code->set('estado', 1);
		$this->Code->set('creditos', $creditos);
		$this->Code->set('fecha_expiracion', $año . '-' . $mes . '-' . $dia);

		if ($this->Code->save()) {
			return true;
		} else {
			return false;
		}
	}

	function redimirCodigo($codigo = null) {
		$elCodigo = $this->Code->find('first', array('conditions' => array('codigo' => $codigo)));
		if (isset($elCodigo)){
			// Validar que el codigo este activo
			//
			if ($elCodigo['Code']['estado'] == 1) {
				// Validar que el codigo no se haya expirado
				//
				$fecha_1 = date('Y-m-d', strtotime($elCodigo['Code']['fecha_experacion']));
				$fecha_2 = date('Y-m-d', time('now'));
				if ($fecha_1 >= $fecha_2) {
					$this->Code->read(null, $elCodigo['Code']['id']);
					$this->Code->set('estado', 0);
					$this->Code->save();
					return $elCodigo['Code']['creditos'];
				} else {
					return 0;
				}
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

}
?>