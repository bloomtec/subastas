<?php
class SubastasController extends AppController {

	var $name = 'Subastas';

	function index() {
		$this->Subasta->recursive = 0;
		$config=$this->Config->read(null,1);
		 if (!empty($this->params['requested'])) {
			 return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola <="=>$config["Config"]["tamano_cola"]
				)
				));
		 } else {
		 	$this->Paginate=array("Subasta",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
					"Subasta.posicion_en_cola <="=>$config["Config"]["tamano_cola"]
				)
				));
		 	$this->set('subastas', $this->paginate());
		 }
		
	}

	function ultimasSubastas(){
		if (!empty($this->params['requested'])) {
			 return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>7//vendida
				)
				));
		 } else {
		 	$this->Paginate=array("Subasta",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>7//vendida
				)
				));
		 	$this->set('subastas', $this->paginate());
		 }
	}
	function proximasSubastas(){
	 if (!empty($this->params['requested'])) {
			 return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
				)
				));
		 } else {
		 	$this->Paginate=array("Subasta",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
					"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
				)
				));
		 	$this->set('subastas', $this->paginate());
		 }	
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Subasta->create();
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('The subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subasta could not be saved. Please, try again.', true));
			}
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('The subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subasta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subasta->read(null, $id);
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subasta->delete($id)) {
			$this->Session->setFlash(__('Subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->Subasta->recursive = 0;
		$this->set('subastas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Subasta->create();
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('Se añadió la subasta.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo añadir. Por favor intente de nuevo.', true));
				debug($this->Subasta->invalidFields());
			}
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('Se ha modificado la subasta', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo modificar. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subasta->read(null, $id);
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subasta->delete($id)) {
			$this->Session->setFlash(__('Subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * << seccion de metodos no generados por cake >>
	 */

	/**
	 * Metodo para actualizar el estado de una subasta
	 * @param unknown_type $subastaID		ID de la subasta a actualizar
	 * @param unknown_type $nuevoEstadoID	ID del nuevo estado para la subasta
	 */
	function actualizarEstadoSubasta($id = null, $estados_subasta_id = null){

		$actualizo = false;

		try {
			$this->Subasta->read(null, $id);
			$this->Subasta->set('estados_subasta_id', $estados_subasta_id);
			$this->Subasta->save();
			$actualizo = true;
		} catch (Exception $e) {
			echo debug($e);
		}

		if($actualizo){

			// Tomar acciones acorde el nuevo estado de la subasta
			//
			switch($estados_subasta_id){
				/**
				 * Subasta Esperando Activacion
				 */
				case 1:
					// Por ahora no se daria este caso
					break;

					/**
					 * Subasta Activa
					 */
				case 2:
					$this->__subastaActiva($id);
					break;

					/**
					 * Subasta Pendiente De Pago
					 * Se crea una venta para proceder con el pago
					 */
				case 3:
					$this->__crearVenta($id);
					break;

					/**
					 * Subasta Vencida
					 */
				case 4:
					$this->__subastaVencida($id);
					break;
					/**
					 * Subasta cancelada
					 */
				case 5:
					$this->__cancel($id);
					break;
			}

		} else {
			//
		}

		return $actualizo;
	}

	function __subastaEsperandoActivacion($id = null){
		//por ahora no se llama este metodo
	}

	function __subastaActiva($id = null){
		//Encontrar la cantidad de subastas activas
		//
		$subastasActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2')));

		$cantidadSubastasActivas = 0;

		foreach($subastasActivas as $subastaActiva){
			$cantidadSubastasActivas++;
		}

		try {
			$this->Subasta->id = $id;
			// No se pone $cantidadSubastasActivas + 1
			// porque ya se activo la subasta actual y daria una de mas
			//
			$this->Subasta->saveField('posicion_en_cola', $cantidadSubastasActivas);
		} catch (Exception $e) {
			echo debug($e);
		}
	}

	function __crearVenta($id = null){
		/**
		 * Crea un regitros en la tabla ventas, user_id = usuarioGanador()
		 * y subasta_id = (parametro subasta_id) y estado="pendiente_de_pago"
		 */
		$this->requestAction('/ventas/crearVenta/'.$id.'/'.$this->requestAction('/ofertas/obtenerUsuarioGanadorSubasta/'.$id));
	}

	function __subastaVencida($id = null){
		// TODO : SUBASTA VENCIDA (Falta definicion del cliente)
	}

	function admin_cancel($id = null) {
		if(!$id){
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->actualizarEstadoSubasta($id, 5)){
			$this->Session->setFlash(__('Se cancelo la subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo cancelar la subasta', true));
		$this->redirect(array('action' => 'index'));
	}

	function __cancel(){
		/**
		 * Recorrer todas las ofertas de la subasta cancelada y a todos los
		 * usuarios que ofertaron se les devuelve el credito que habian
		 * pagado. Enviar correo de notificacion
		 */

		// Encontrar las ofertas correspondientes a una subasta
		//
		$ofertasHechas = $this->requestAction('/ofertas/obtenerOfertasSubasta/'.$id);

		// Recorrer las ofertas y devolver los creditos
		//
		foreach($ofertasHechas as $unaOfertaHecha) {
			// Reponer los creditos de la oferta
			//
			$creditosAReponer = $unaOfertaHecha['Oferta']['creditos_descontados'];
			$this->requestAction('/users/reponerCreditos/'.$unaOfertaHecha['User']['id'].'/'.$creditosAReponer);

			// Enviar notificacion
			//
			// TODO : Codigo para enviar las notificaciones
		}

		return true;
	}
	
	function creditosADescontar($subastaID = null){
		$unaSubasta = $this->Subasta->read(null, $subastaID);
		return $unaSubasta['Subasta']['cantidad_creditos_puja'];
	}

}
?>