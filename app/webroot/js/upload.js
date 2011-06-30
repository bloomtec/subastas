$(document).ready(
		function() {
			var server = '/';

			$('#upload').uploadify({
				'uploader' : server + 'swf/uploadify.swf',
				'script' : server + 'uploadify.php',
				'folder' : server + 'app/webroot/img',
				'auto' : true,
				'cancelImg' : server + 'img/cancel.png',
				'onComplete' : function(a, b, c, d) {
				}
			});

			$('#single-upload').uploadify(
					{
						'uploader' : server + 'swf/uploadify.swf',
						'script' : server + 'uploadify.php',
						'folder' : server + 'app/webroot/img',
						'auto' : true,
						'cancelImg' : server + 'img/cancel.png',
						'onComplete' : function(a, b, c, d) {
							var name = c.name;
							$(".preview").html(
									'<img  src="' + server + 'img/' + name
											+ '" />');
							$("#single-field").val(name);

						}
					});
		});