<?php if (!empty($subastas)):?>
 <ul class="subastas-activas">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($i%3==1) echo "class='centro'"?>> 
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
	     <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	     <p class="contador">00</p>
	     <p class="precio">00<p>
	     <p class="ultimo-usuarior">user<p>
	     <?php echo $this->Html->link("¡Oferte ya!",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton')) ?>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>


<?php $proximasSubastas = $this->requestAction('/subastas/proximasSubastas'); ?>
<?php if (!empty($proximasSubastas)):?>
	<ul class="proximas-subastas">
		 <h1 class="titulo-amarillo">Próximas subastas<h1>
		 <?php $i=0;?>
		 <?php foreach ($proximasSubastas as $subasta):?>
		 <li <?php if($i%3==1) echo "class='centro'"?>> 
			 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
			 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
		     <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		     <p class="contador">00</p>
		     <p class="precio">00<p>
		 </li>
		 <?php 
		 $i++;
		 endforeach; ?>
 	</ul>
 <div style="clear:both"></div>
<?php endif; ?>