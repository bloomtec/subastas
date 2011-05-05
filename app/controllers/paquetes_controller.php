<?php
class PaquetesController extends AppController {

	var $name = 'Paquetes';

	function index() {
		$this->Paquete->recursive = 0;
		$this->set('paquetes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid paquete', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paquete', $this->Paquete->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Paquete->create();
			if ($this->Paquete->save($this->data)) {
				$this->Session->setFlash(__('The paquete has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paquete could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid paquete', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Paquete->save($this->data)) {
				$this->Session->setFlash(__('The paquete has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paquete could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Paquete->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for paquete', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Paquete->delete($id)) {
			$this->Session->setFlash(__('Paquete deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Paquete was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Paquete->recursive = 0;
		$this->set('paquetes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid paquete', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paquete', $this->Paquete->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Paquete->create();
			if ($this->Paquete->save($this->data)) {
				$this->Session->setFlash(__('The paquete has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paquete could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid paquete', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Paquete->save($this->data)) {
				$this->Session->setFlash(__('The paquete has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paquete could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Paquete->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for paquete', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Paquete->delete($id)) {
			$this->Session->setFlash(__('Paquete deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Paquete was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>