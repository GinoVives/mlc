<?php
// Se asume session_start
if (strlen($_SESSION['nickname']) > 0):
	// si esta logeado, podríamos confirmar si el token sigue valido, pero bueno...
	;
else:
	// el usuario no debería estar aca
	echo '<script type="text/javascript">';
	echo 'alert("Debes logearte para acceder a esta pagina");';
	echo 'location.replace("login.php");';
	echo '</script>';
	die();
endif;
?>
