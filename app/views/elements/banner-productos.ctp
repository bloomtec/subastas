<a href="/users/register" class="banner-productos">
	<?php echo $html->image("slide-registro/1.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/2.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/3.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/4.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/5.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/6.png",array("width"=>200));?>
</a>
<script type="text/javascript">
$(function(){
	var numFotos2=4;
	var fotos2=[];
	var j2=0;

		$.each($(".banner-productos img"), function(i2,val2) {
			fotos2[i2]=val2;
			if(i2>0) $(val2).hide();
		});
		setInterval( function() {
			$(".banner-productos  img").fadeOut("slow");
			$(fotos2[j2]).fadeIn("slow");
			j2++;
			if(j2==fotos2.length) j2=0;
		},10000);
		
	});

</script>