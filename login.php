<?php

require 'header.php';

if($_SESSION['nickname']):
	echo '<p>Usuario '.$_SESSION['nickname'].' loggeado. Redireccionando';
	header('Refresh: 10; URL=index.php');
	exit;
else:
	echo '<p>Hacer log in manual <a href="http://developers.mercadolibre.com/first-step/#try" target="new">aqui</a> usando <b>6804179974595472</b> y copie el Access Token aca:';
	echo '<input id="manual_token" type="text" size="20" value="Please copy token here!"/>';
	echo '<input id="login" type="button" value="Login"/>';
endif;
?>
<!-- scripting --!>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#login").click(function() {
			var form_token = jQuery("#manual_token").val();
			jQuery.post("performLogin.php", {token: form_token}).done(function(){
				window.location.href = "index.php"
			});
		});
		jQuery("#manual_token").focusin(function() {
			jQuery("#manual_token").val("");
		});
	});
</script>
<?php

require 'footer.php';
?>

