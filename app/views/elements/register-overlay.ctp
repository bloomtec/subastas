<div class="overlay" id="register-overlay">
	<div style="position:relative; height:100%;">

		<div class="registrate">
		<form action='https://madmimi.com/signups/subscribe/35608' method='post' id="madmimi">
		<div>
		<label for='signup_name'>Nombre</label>
		<input id='signup_name' name='name' type='text' />
		<br />
		<br />
		<label for='signup_email'>Email</label>
		<input id='signup_email' name='email' type='text' />
		<br />
		<input name='commit' class='button' type='submit' value=' ' /></div>
		</form>
		</div>
	</div>
 </div>
<script type="text/javascript">
	$(function(){
		$("#madmimi").submit(function(e){
			e.preventDefault();
			var datos=$(this).serialize();
		jQuery.ajax({
			url:"users/registerMadMimi",
			type: "POST",
			cache: false,
			dataType:"json",
			data:datos,
			success: function(registrado) {
			console.log(registrado);
				if(registrado){
					setCookie("mailing",true,90);
					$("#register-overlay").overlay().close();
				}
			}
		});
		});
	});
</script>