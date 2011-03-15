<?php
class OfertasController extends AppController {

	var $name = 'Ofertas';

	function index() {
		$this->Oferta->recursive = 0;
		$this->set('ofertas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('oferta', $this->Oferta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Oferta->create();
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		$subastas = $this->Oferta->Subastum->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Oferta->read(null, $id);
		}
		$subastas = $this->Oferta->Subastum->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for oferta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Oferta->delete($id)) {
			$this->Session->setFlash(__('Oferta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Oferta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Oferta->recursive = 0;
		$this->set('ofertas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('oferta', $this->Oferta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Oferta->create();
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		$subastas = $this->Oferta->Subastum->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Oferta->read(null, $id);
		}
		$subastas = $this->Oferta->Subastum->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for oferta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Oferta->delete($id)) {
			$this->Session->setFlash(__('Oferta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Oferta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>