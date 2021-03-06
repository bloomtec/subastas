<?php
class FacturasController extends AppController {

	var $name = 'Facturas';
	
	function getFactura($codigo_factura = null) {
		if($codigo_factura) {
			$factura = $this -> Factura -> find(
				'first',
				array(
					'conditions' => array(
						'Factura.codigo_factura' => $codigo_factura
					)
				)
			);
			return $factura;
		}		
	}

	function generarCodigoFactura() {
		$max_codigo_factura = $this -> Factura -> find('first', array('fields' => array('MAX(Factura.codigo_factura) as max_code')));
		if(!empty($max_codigo_factura['0']['max_code'])) {
			return $max_codigo_factura['0']['max_code'] + 1;
		} else {
			return 1;
		}
	}

	function crearFactura($codigo_factura = null, $user_id = null, $tipo_compra = null, $dato_compra = null) {
		if ($codigo_factura && $user_id && $dato_compra) {
			$this -> Factura -> create();
			$this -> Factura -> set("codigo_factura", $codigo_factura);
			$this -> Factura -> set("user_id", $user_id);
			if($tipo_compra == 0) {
				$this -> Factura -> set("creditos", $dato_compra);
			} else {
				$this -> Factura -> set("venta_id", $dato_compra);
			}
			$this -> Factura -> save();
		}
	}
	
	function limpiarRegistros() {
		$this->autoRender=false;
		$facturas = $this -> Factura -> find('all');
		debug($facturas);
	}

	function obtenerIDFactura($codigo_factura = null) {
		if (isset($codigo_factura) && !empty($codigo_factura)) {
			$factura = $this -> Factura -> find('first', array('conditions' => array('Factura.codigo_factura' => $codigo_factura)));
			return $factura['Factura']['id'];
		}
	}

	function ingresarDatosConfirmacionPago(
		$codigo_factura = null, $transaccion_aprobada = null, $valor_factura = null, $tipo_moneda = null,
		$codigo_autorizacion = null, $numero_transaccion = null, $metodo_pago = null, $nombre_metodo_pago = null
	) {
		$this -> Factura -> read(null, $this -> obtenerIDFactura($codigo_factura));
		$this -> Factura -> set("transaccion_aprobada", $transaccion_aprobada);
		$this -> Factura -> set("valor", $valor_factura);
		$this -> Factura -> set("moneda", $tipo_moneda);
		$this -> Factura -> set("codigo_autorizacion", $codigo_autorizacion);
		$this -> Factura -> set("numero_transaccion", $numero_transaccion);
		$this -> Factura -> set("metodo_pago", $metodo_pago);
		$this -> Factura -> set("nombre_metodo_pago", $nombre_metodo_pago);
		$this -> Factura -> save();
	}

}
