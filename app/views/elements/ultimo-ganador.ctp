<div class="ultimo-ganador estilo-borde">
	<h1 class="titulo-amarillo">Último ganador</h1>
	<?php $proximaOferta = $this->requestAction('/ofertas/ultimoGanador'); ?>
	<?php if (!empty($proximaOferta)){?>
		 <?php $i=0;?>
		 <?php foreach ($proximaOferta as $oferta):?>
		 <?php echo $this->Html->image($oferta['Oferta']['Subasta']['imagen_path'],array("width"=>"170"))?>
		 <?php echo $this->Html->para("nombre",$oferta['Oferta']["Subasta"]["nombre"]) ?>
		 <?php echo $this->Html->para("pvp","PVP $".number_format($oferta['Oferta']["Subasta"]['valor'], 0, ' ', '.')) ?>
		 <p class="precio">00<p>
		 <p class="usuario">user<p>
		 <?php 
		 endforeach; ?>
	 <div style="clear:both"></div>
	<?php } else{
		 echo $this->Html->para("mensaje","No hay ganadores por ahora");
		}?>
</div>

