<?php
require 'header.php';
?>
<h2>Pagina Principal</h2>
<p>Desde aca puedes acceder a varios mini aplicaciones, divididas principalmente entre publicas y privadas (requieren login).
<ul>
	<li>Publicas</li>
		<ul>
			<li><a href="busqueda.php">Busqueda</a></li>
			<li><a href="infoUsuario.php">Usuarios</a></li>
		</ul>
	<li>Privadas</li>
		<ul>
			<li><a href="misItems.php">Mis Items</a></li>
			<li><a href="misDatos.php">Mis Datos</a></li>
		</ul>
</ul>
<?php
require 'footer.php';
?>

