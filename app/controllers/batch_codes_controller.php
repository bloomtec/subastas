<?php
class BatchCodesController extends AppController {

	var $name = 'BatchCodes';

	function index() {
		$this->BatchCode->recursive = 0;
		$this->set('batchCodes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('batchCode', $this->BatchCode->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->BatchCode->create();
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BatchCode->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for batch code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BatchCode->delete($id)) {
			$this->Session->setFlash(__('Batch code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Batch code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->BatchCode->recursive = 0;
		$this->set('batchCodes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('batchCode', $this->BatchCode->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->BatchCode->create();
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BatchCode->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for batch code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BatchCode->delete($id)) {
			$this->Session->setFlash(__('Batch code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Batch code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>