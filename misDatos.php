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
		echo '<li>'.$key.' => '.$value.HTMLEditable($key,$value).'</li>';
	endif;
}

# Definimos las variables de usuario editables:
$editables = array (
	"first_name",
	"last_name",
);

function HTMLEditable($key, $value) {
	global $editables;
	if (is_null($value)) :
		return "";
	elseif (in_array($key, $editables)) :
		return '<button class="editButton"></button>';
	else :
		return "";
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
<div id="dialog-form" title="Actualizar Datos">
	<form>
		<label for="value">TBD</label>
		<input type="text" name="value" value="TBV">
		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	</form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var dialog, form;
		dialog = jQuery("#dialog-form").dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Guardar": guardarCambio,
				"Cancelar": function() { dialog.dialog("close");}
			},
			close: function() { form[0].reset(); }
		});

		form = dialog.find("form").on("submit", function(event) {
			event.preventDefault();
			guardarCambio();
		});

		jQuery(".editButton").button({
			icons : {
				primary: "ui-icon-pencil"
			},
			text: false
		});
		jQuery("#menu").menu();


		jQuery("button.editButton").click(function() {
			var parentElement = jQuery(this).parent();
			var elementText = parentElement.text();
			var pos = elementText.indexOf("=");
			var key = elementText.substring(0,pos-1);
			var value = elementText.substring(pos+3);
			form.children("label").text(key);
			form.children("input[name=value]").val(value);
			dialog.dialog("open");
		});

	});

	function guardarCambio() {
		alert('Guardando...');
		dialog.dialog("close");
		}
</script>
<style>
	.ui-menu { width : 525px; }
	.editButton { font-size : 10px !important; float : right ;}
</style>
<?php
require 'footer.php';
?>
