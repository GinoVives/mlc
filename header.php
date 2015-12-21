<?php
session_start();
?>
<html>
<head>
<title>Pagina de prueba para ML</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
<p align="right">
<?php
if ($_SESSION['nickname']):
	$session_nickname = $_SESSION['nickname'];
	if (strlen($session_nickname) > 0):
		echo 'Hola '.$session_nickname.'. <a href="logout.php">Salir</a>';
	endif;
else:
	echo 'Bienvenido. <a href="login.php">Entrar</a>';
endif;
echo ' <a href="index.php">Inicio</a>';
?>

