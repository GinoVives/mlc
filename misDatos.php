<?php
require 'header.php';
require 'perfilPrivado.php';

### Definimos funcion a usar en el parseo de JSON
function printHTMLfromJSON($key, $value) {
	if (is_object($value) && get_class($value) === "stdClass") :
		echo '<li>'.$key;
		echo '<ul>';
		foreach ($value as $_key => $_value) {
			printHTMLfromJSON($_key,$_value);
		}
		echo '</ul>';
		echo '</li>';
	elseif (is_array($value)) :
		echo '<li>'.$key;
		echo '<ul>';
		foreach($value as $arrayItem) {
			echo '<li>'.$arrayItem.'</li>';
		}
		echo '</ul>';
		echo '</li>';
	else :
		echo '<li>'.$key.' => '.$value.'</li>';
	endif;
}


### Obtenemos los datos del usuario actual
$curl = curl_init();
$url = 'https://api.mercadolibre.com/users/me?access_token=' . $_SESSION['access_token'];
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $url,
));
$response = curl_exec($curl);
curl_close($curl);
$json_user = json_decode($response);

### Armamos la pagina base
?>
<p>Mis Datos:
<p> Url: <?=$url?>;
<hr>
<p> json:
<p><?=var_dump($json_user)?>
<hr>
<?php
### Mostramos el usuario desglozado
echo '<ul id="menu">';
foreach ($json_user as $key => $value) {
	printHTMLfromJSON($key, $value);
}
echo '</ul>';

### Agregamos un poquito de UI
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#menu").menu();
		});
</script>
<style>
	.ui-menu { width : 525px; }
</style>
<?php
require 'footer.php';
?>
