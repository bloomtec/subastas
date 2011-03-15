<?php
class ListaCorreosController extends AppController {

	var $name = 'ListaCorreos';

	function index() {
		$this->ListaCorreo->recursive = 0;
		$this->set('listaCorreos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid lista correo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('listaCorreo', $this->ListaCorreo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ListaCorreo->create();
			if ($this->ListaCorreo->save($this->data)) {
				$this->Session->setFlash(__('The lista correo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lista correo could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid lista correo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ListaCorreo->save($this->data)) {
				$this->Session->setFlash(__('The lista correo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lista correo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ListaCorreo->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for lista correo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ListaCorreo->delete($id)) {
			$this->Session->setFlash(__('Lista correo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Lista correo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->ListaCorreo->recursive = 0;
		$this->set('listaCorreos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid lista correo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('listaCorreo', $this->ListaCorreo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ListaCorreo->create();
			if ($this->ListaCorreo->save($this->data)) {
				$this->Session->setFlash(__('The lista correo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lista correo could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid lista correo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ListaCorreo->save($this->data)) {
				$this->Session->setFlash(__('The lista correo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lista correo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ListaCorreo->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for lista correo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ListaCorreo->delete($id)) {
			$this->Session->setFlash(__('Lista correo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Lista correo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>