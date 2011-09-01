<div class="seguridad estilo-borde">
	<h1 class="titulo-verde">Créditos GRATIS!!!</h1>
	<div class="slider">
		<?php echo $html -> image('slide-referidos/1.png', array('alt' => 'compra seguro', "width" => 200));?>
		<?php echo $html -> image('slide-referidos/2.png', array('alt' => 'compra seguro', "width" => 200));?>
		<?php echo $html -> image('slide-referidos/3.png', array('alt' => 'compra seguro', "width" => 200));?>
		<?php echo $html -> image('slide-referidos/4.png', array('alt' => 'compra seguro', "width" => 200));?>
	</div>
	<br />
	<br />
</div>
<script type="text/javascript">
$(function(){
	var numFotos=4;
	var fotos=[];
	var j=0;

		$.each($(".slider img"), function(i,val) {
			fotos[i]=val;
			$(val).hide();
		});
		setInterval( function() {
			$(".slider img").fadeOut();
			$(fotos[j]).fadeIn();
			j++;
			if(j==fotos.length) j=0;
		},2500);
		

	});
</script>