<div class="ultimo-ganador estilo-borde">
	<h1 class="titulo-amarillo">Último ganador</h1>
	<?php $ultimoGanador = $this->requestAction('/ventas/ultimoGanador'); ?>
	<?php 
		if (!empty($ultimoGanador)){
			$i=0;
		 	echo $this->Html->image($ultimoGanador['Subasta']['imagen_path'],array("width"=>"170"));
		 	echo $this->Html->para("nombre",$ultimoGanador["Subasta"]["nombre"]);
		 	echo $this->Html->para("pvp","PVP $".number_format($ultimoGanador["Subasta"]['valor'], 0, ' ', '.'));
	?>
	<p class="precio"><?php echo $ultimoGanador['Subasta']['precio']; ?><p>
	<p class="usuario"><?php echo $ultimoGanador['User']['username']; ?><p>
 	<div style="clear:both"></div>
	<?php 
		} else {
			echo $this->Html->para("mensaje","No hay ganadores por ahora");
		}
	?>
</div>

