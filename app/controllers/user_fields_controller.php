<?php
class UserFieldsController extends AppController {

	var $name = 'UserFields';

	function index() {
		$this->UserField->recursive = 0;
		$this->set('userFields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userField', $this->UserField->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserField->create();
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserField->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserField->read(null, $id);
		}
		$users = $this->UserField->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserField->delete($id)) {
			$this->Session->setFlash(__('User field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->UserField->recursive = 0;
		$this->set('userFields', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userField', $this->UserField->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UserField->create();
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserField->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserField->save($this->data)) {
				$this->Session->setFlash(__('The user field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserField->read(null, $id);
		}
		$users = $this->UserField->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserField->delete($id)) {
			$this->Session->setFlash(__('User field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>