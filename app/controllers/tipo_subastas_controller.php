<?php
class TipoSubastasController extends AppController {

	var $name = 'TipoSubastas';

	function index() {
		$this->TipoSubasta->recursive = 0;
		$this->set('tipoSubastas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tipo subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoSubasta', $this->TipoSubasta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TipoSubasta->create();
			if ($this->TipoSubasta->save($this->data)) {
				$this->Session->setFlash(__('The tipo subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo subasta could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tipo subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TipoSubasta->save($this->data)) {
				$this->Session->setFlash(__('The tipo subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo subasta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TipoSubasta->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tipo subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoSubasta->delete($id)) {
			$this->Session->setFlash(__('Tipo subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipo subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->TipoSubasta->recursive = 0;
		$this->set('tipoSubastas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tipo subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoSubasta', $this->TipoSubasta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->TipoSubasta->create();
			if ($this->TipoSubasta->save($this->data)) {
				$this->Session->setFlash(__('The tipo subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo subasta could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tipo subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TipoSubasta->save($this->data)) {
				$this->Session->setFlash(__('The tipo subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo subasta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TipoSubasta->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tipo subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoSubasta->delete($id)) {
			$this->Session->setFlash(__('Tipo subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipo subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>