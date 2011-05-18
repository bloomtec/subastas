<?php
class SubastasController extends AppController {

	var $name = 'Subastas';
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow("index","subastasFinalizadas");
	}
	
	/**
	 * Devuelve todas las subastas activas
	 * en la que este usuario ha participado
	 */
	function subastasActivas(){
		$this->autoRender=false;
		$userID = $this->Auth->user("id");
		
		//Encontrar las subastas con estado activo
		// y que se encuentren en sus 'fecha_de_venta'
		//
		$gmt = 3600*-5; // GMT -5 para hora colombiana
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt); // Generar la fecha actual formateada para comparar con la fecha de mysql
		$query = 
			"SELECT DISTINCT Subasta.id, Subasta.nombre, Subasta.valor, Subasta.precio, Subasta.imagen_path, Subasta.fecha_de_venta, Subasta.aumento_creditos
			FROM subastas as Subasta, users as User, ofertas as Oferta
			WHERE User.id = $userID
			AND Oferta.user_id = User.id
			AND Subasta.id = Oferta.subasta_id
			AND Subasta.estados_subasta_id = '2'
			AND Subasta.fecha_de_venta > '$fechaActual'";
		$subastas = $this->Subasta->query($query);
		return $subastas;
	}
	
	/**
	 * Devuelve todas las subastas finalizadas
	 * en la que este usuario ha participado
	 */
	function finalizadas(){
		$userID = $this->Auth->user("id");
		$query = 
			"SELECT DISTINCT Subasta.id, Subasta.nombre, Subasta.valor, Subasta.precio, Subasta.imagen_path, Subasta.fecha_de_venta, Subasta.aumento_creditos
			FROM subastas as Subasta, users as User, ofertas as Oferta
			WHERE User.id = $userID
			AND Oferta.user_id = User.id
			AND Subasta.id = Oferta.subasta_id
			AND Subasta.estados_subasta_id > '2'";
		$subastas = $this->Subasta->query($query);
		$this->set(compact("subastas"));
	}
	function subastasFinalizadas(){
		$subastas=$this->Subasta->find("all",array("conditions"=>array("estados_subasta_id >"=>2)));
		$this->set(compact("subastas"));
	}
	function ofertar($subastaID = null) {
		if($this->RequestHandler->isAjax()){
			$subastaID=$_GET["subasta_id"];
			$subasta=$this->Subasta->read(null, $subastaID);
			if ($subasta["Subasta"]["estados_subasta_id"] != 2) {
				Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);
			} else {
				echo json_encode($this->__ofertar($subastaID));
			}
			Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);	
		}
		
		if (!$subastaID) {
			$this->Session->setFlash(__('ID no valida para la subasta', true));
			$this->redirect(array('action'=>'index'));
		} else {
			$subasta=$this->Subasta->read(null, $subastaID);
			if ($subasta["Subasta"]["estados_subasta_id"] != 2) {
				$this->Session->setFlash(__('La subasta por la que oferto no esta activa', true));
				$this->redirect(array('action'=>'index'));
			} else {
				if (($laOferta=$this->__ofertar($subastaID))) {
					$this->Session->setFlash(__('Se oferto por la subasta exitosamente', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('No se pudo ofertar por la subasta, verifique si dispone de créditos suficientes.', true));
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	
	function __ofertar($subastaID = null) {
		// Obtener la informacion de la subasta
		//
		$subasta = $this->Subasta->read(null, $subastaID);
		
		// Validar que el usuario tenga suficientes creditos para ofertar
		//
		if($this->requestAction('/users/creditosSuficientes/' . $this->Session->read('Auth.User.id') . '/' . $subasta['Subasta']['cantidad_creditos_puja'])) {
			// Como el usuario tiene suficientes creditos proceder a descontar los creditos
			//
			$this->requestAction('/users/descontarCreditos/' . $this->Session->read('Auth.User.id') . '/' . $subasta['Subasta']['cantidad_creditos_puja']);
			
			// Crear la oferta para finalizar el proceso
			//
			return $this->requestAction('ofertas/crearOferta/' . $this->Session->read('Auth.User.id') . '/' . $subasta['Subasta']['id'] . '/' . $subasta['Subasta']['cantidad_creditos_puja']);

		} else {
			return array("success"=>false,"mensaje"=>"No tiene suficiente credito, Por favor compra mas creditos para poder ofertar","code"=>"1");
		}
	}

	function index() {
		$this->Subasta->recursive = 0;
		$config=$this->Config->read(null,1);
		$gmt = 3600*-5; 
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt); 
		if (!empty($this->params['requested'])) {
			return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola <="=>$config["Config"]["tamano_cola"],
			 		"Subasta.fecha_de_venta >"=>"$fechaActual"
			)
			));
		} else {
			$subastas=$this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola <="=>$config["Config"]["tamano_cola"],
			 		"Subasta.fecha_de_venta >"=>"$fechaActual"
			)));
			$this->set('subastas',$subastas);
			$this->set("registrado",$this->Cookie->read("registrado"));
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
	 $config=$this->Config->read(null,1);	
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
	function proximaSubasta(){
	 $config=$this->Config->read(null,1);	
	 if (!empty($this->params['requested'])) {
	 	$subastas=$this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
	 	)
	 	));
	 	if(isset($subastas[0])){
	 		return $subastas[0];
	 	}else{
	 		return null;
	 	}
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
				$this->__sincronizarPosiciones();
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

	function __sincronizarPosiciones(){
		// << Sacar la subasta de la cola si su estado no es "Activa" >>
		//
		$subastasNoActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id <>' => '2', 'Subasta.posicion_en_cola >' => '0')));

		foreach($subastasNoActivas as $subastaNoActiva) {
			$this->Subasta->read(null, $subastaNoActiva["Subasta"]["id"]);
			$this->Subasta->set('posicion_en_cola', -1);
			$this->Subasta->save();
		}

		// << Reasignar numeros a las subastas con estado "Activa" >>
		//

		$subastasActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2'), 'order' => array('Subasta.id')));

		$posicion_en_cola = 1;

		foreach($subastasActivas as $subastasActiva) {
			$this->Subasta->read(null, $subastasActiva["Subasta"]["id"]);
			$this->Subasta->set('posicion_en_cola', $posicion_en_cola);
			$this->Subasta->save();
			$posicion_en_cola++;
		}

	}

	/**
	 * Metodo para actualizar el estado de una subasta
	 * @param unknown_type $subastaID		ID de la subasta a actualizar
	 * @param unknown_type $nuevoEstadoID	ID del nuevo estado para la subasta
	 */
	function actualizarEstadoSubasta($id = null, $estados_subasta_id = null){

		$this->Subasta->read(null, $id);
		$this->Subasta->set('estados_subasta_id', $estados_subasta_id);
		$this->Subasta->save();

		// Si el nuevo estado es diferente a "Activa" verificar
		// las posiciones en cola asignadas para garantizar el
		// orden numerico.
		//
		if ($estados_subasta_id != 2) {
			$this->__sincronizarPosiciones();
		} else {
			//
		}

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
				/**
				 * Se cerro la subasta
				 */
			case 6:
				$this->__cerrar($id);
				break;
		}
		
	}

	function __cerrar($id = null){
		// TODO
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

		$this->Subasta->id = $id;
		$this->Subasta->saveField('posicion_en_cola', $cantidadSubastasActivas);

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

	function admin_cerrar($id = null) {
		if(!$id){
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->actualizarEstadoSubasta($id, 6)){
			$this->Session->setFlash(__('Se cerro la subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo cerrar la subasta', true));
		$this->redirect(array('action' => 'index'));
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

	function __cancel($id = null){
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

	function diasEspera($subastaID = null) {
		$unaSubasta = $this->Subasta->read(null, $subastaID);
		return $unaSubasta['Subasta']['dias_espera'];
	}

	function enviarCorreoGanador($subastaID = null) {
		$this->autoRender = false;

		if (!empty($subastaID)) {
			$subasta = $this->Subasta->read(null, $subastaID);
			$userID = $this->requestAction('/ofertas/obtenerUsuarioGanadorSubasta/' . $subastaID);
			$usuario = $this->requestAction('/users/getUsuario/' . $userID);
			
			if($usuario['User']['email']) {
				$para = $usuario['User']['email'];
				$asunto = 'Te has llevado un articulo!!!';
				$mensaje = 'Hola, te has llevado un articulo: ' . 
					'<br>Nombre de la subasta: ' . $subasta['Subasta']['nombre'];
			
				$cabeceras = 'From: webmaster@example.com' . 
					"\r\n" . 
					'Reply-To: webmaster@example.com' . "\r\n" . 
					'X-Mailer: PHP/' . phpversion();
			
				if(mail($para, $asunto, $mensaje, $cabeceras)) {
					$this->Session->setFlash(__('Datos enviados a su correo', true));
				} else {
					$this->Session->setFlash(__('Datos no enviados a su correo, por favor intenta mas tarde', true));
				}
				
				return;
			} else {
				$this->Session->setFlash(__('No existe ningun usuario registrado con ese email', true));
				return;
			}
		} 
	}

}
?>