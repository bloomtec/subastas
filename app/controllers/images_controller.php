<?php
class ImagesController extends AppController {

	var $name = 'Images';
  var $uses=array();
  var $wysiwygPath="wysiwyg";

	function index() {
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Image->create();
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Image->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Image->delete($id)) {
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Image->create();
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Image->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Image->delete($id)) {
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
  function admin_wysiwyg(){//ESTA FUNCION MUESTRA EL LISTADO DE LAS IMAGENES SUBIDAS POR EL WYSIWYG
    $this->layout="file_browser";
    App::import("Folder");
    $folder= new Folder(WWW_ROOT.$this->wysiwygPath);
    $this->set("folder",$folder->read());
    $this->set("folderPath","/".$this->wysiwygPath);
  }
    function uploadfy_add(){
    if($_POST["name"]&&$_POST["folder"]){
      $devolver=true;
      $this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/360x360",$_POST["name"],360,360);
      $this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/200x200",$_POST["name"],200,200);
      $this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/100x100",$_POST["name"],100,100);
      if(isset($_POST["galeriaId"])){
        $imagen["Image"]["gallery_id"]=$_POST["galeriaId"];
        $imagen["Image"]["path"]=$_POST["name"];
        $this->Image->create();
        $this->Image->save($imagen);

        $devolver=$this->Image->id;
        

      }
      echo $devolver;
    }else{
      echo false;
    }
    Configure::write("debug",0);
    $this->autoRender=false;
    exit(0);
  }
}
?>