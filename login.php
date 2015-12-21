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

// scripting
echo '<script type="text/javascript">';
echo '  jQuery(document).ready(function() {';
echo '          jQuery("#login").click(function() {';
echo '                  var form_token = jQuery("#manual_token").val();';
echo '                  alert("Token is: " + form_token);';
echo '                  jQuery.post("performLogin.php", {token: form_token}).done(function(){window.location.href = "index.php"});';
echo '          });';
echo '  });';
echo '</script>';


require 'footer.php';
?>

