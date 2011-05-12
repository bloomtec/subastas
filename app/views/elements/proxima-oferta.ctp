<div class="proxima-oferta estilo-borde">
	<h1 class="titulo-amarillo">Próxima oferta</h1>
<?php $proximaOferta = $this->requestAction('/ofertas/proximaOferta'); ?>
<?php if (!empty($proximaOferta)){?>
		 <?php $i=0;?>
		 <?php foreach ($proximaOferta as $oferta):?>
		 <?php echo $this->Html->image($oferta['Oferta']['Subasta']['imagen_path'],array("width"=>"170"))?>
		 <?php echo $this->Html->para("nombre",$oferta['Oferta']["Subasta"]["nombre"]) ?>
		 <?php echo $this->Html->para("pvp","PVP $".number_format($oferta['Oferta']["Subasta"]['valor'], 0, ' ', '.')) ?>
		 <p class="fecha">00<p>
		 <?php 
		 endforeach; ?>
 <div style="clear:both"></div>
<?php } else{
	 echo $this->Html->para("mensaje","No hay ofertas por ahora");
	}?>
</div>