<?php
class EstadosSubastasController extends AppController {

	var $name = 'EstadosSubastas';

	function index() {
		$this->EstadosSubasta->recursive = 0;
		$this->set('estadosSubastas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid estados subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('estadosSubasta', $this->EstadosSubasta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EstadosSubasta->create();
			if ($this->EstadosSubasta->save($this->data)) {
				$this->Session->setFlash(__('The estados subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados subasta could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid estados subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EstadosSubasta->save($this->data)) {
				$this->Session->setFlash(__('The estados subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados subasta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EstadosSubasta->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for estados subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EstadosSubasta->delete($id)) {
			$this->Session->setFlash(__('Estados subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Estados subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->EstadosSubasta->recursive = 0;
		$this->set('estadosSubastas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid estados subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('estadosSubasta', $this->EstadosSubasta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->EstadosSubasta->create();
			if ($this->EstadosSubasta->save($this->data)) {
				$this->Session->setFlash(__('The estados subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados subasta could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid estados subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EstadosSubasta->save($this->data)) {
				$this->Session->setFlash(__('The estados subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados subasta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EstadosSubasta->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for estados subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EstadosSubasta->delete($id)) {
			$this->Session->setFlash(__('Estados subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Estados subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>