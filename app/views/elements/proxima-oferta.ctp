<div class="proxima-oferta estilo-borde">
	<h1 class="titulo-amarillo">Próxima oferta</h1>
<?php $subasta = $this->requestAction('/subastas/proximaSubasta'); ?>

<?php if (!empty($subasta)){?>
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"170"))?>
		 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
		 <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		

 <div style="clear:both"></div>
<?php } else{
	 echo $this->Html->para("mensaje","No hay ofertas por ahora");
	}?>
</div>