<div class="overlay" id="register-overlay">
	<div style="position:relative; height:100%;">

		<div class="registrate">
		<form action='https://madmimi.com/signups/subscribe/35608' method='post' id="madmimi">
		<div>
		<label for='signup_name' style="font-size:20px;margin-top:5px;">Nombre</label>
		<input id='signup_name' name='name' type='text' />
		<br />
		<br />
		<label for='signup_email' style="font-size:20px;margin-top:5px;">Email</label>
		<input id='signup_email' name='email' type='email' />
		<br />
		<h4 class="elerror" style="padding-left:70px;color:red; visibility :hidden;">email no valido</h4>
		<input name='commit' class='button' type='submit' value=' ' /></div>
		
		</form>
		</div>
	</div>
 </div>
<script type="text/javascript">
	$(function(){
		$("input").focus(function(){
			$(".elerror").css("visibility","hidden");
		});
		$("#madmimi").submit(function(e){
			e.preventDefault();
			if(valEmail($("#signup_email").val())){
				var datos=$(this).serialize();
				jQuery.ajax({
					url:"users/registerMadMimi",
					type: "POST",
					cache: false,
					dataType:"json",
					data:datos,
					success: function(registrado) {
						if(registrado){
							setCookie("mailing",true,60);
							$("#register-overlay").overlay().close();
						}
					}
				});	
			}else{
				$(".elerror").css("visibility","visible");
			}
			
			});
	});
	function valEmail(valor){
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(valor))    {
        return false;
    }else{
        return true;
    }
}

</script>