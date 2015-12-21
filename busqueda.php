<?php
require 'header.php';
?>

<h2>Sitio para realizar busquedas basicas.</h2>
<p>Ingrese el texto a buscar: <input type="text" id="query_text" size="20"/></p>
<p><input type="button" value="Buscar" id="buscar"/></p>
<div id="resultado" style="width:800px; margin:0 auto;">
<p>Aca se mostrara el resultado
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#buscar").click(function() {
			var query_text = jQuery("#query_text").val();
			performSearch(query_text);
		});
	});

	function performSearch(query_text) {
		var query = "https://api.mercadolibre.com/sites/MLC/search?q=" + query_text;
		jQuery.get(query).done(function (data) {
			printResultado(jQuery("#resultado"), data.results); 
		}).error(function (error_payload) {
			alert(error_payload);
		});
	}

	function printResultado(div_obj, data) {
		if (div_obj.hasClass("ui-accordion"))
			div_obj.accordion("destroy");
		div_obj.text("");
		jQuery.each(data, function(i, val) {
			// Titulo
			var element = document.createElement("H3");
			var content = document.createTextNode(val.title);
			element.appendChild(content);
			div_obj.append(element);
			// Contenido
			
			// Header
			element = document.createElement("DIV");
			var paragraph = document.createElement("P");
			content = document.createTextNode(val.available_quantity + " unidades, a " + val.currency_id + "$ " + val.price);
			paragraph.appendChild(content);
			element.appendChild(paragraph);
			div_obj.append(element);

			// Extras
			paragraph = document.createElement("P");
			var link = document.createElement("A");
			link.setAttribute('href', val.permalink);
			link.setAttribute('target', "new");
			link.appendChild(document.createTextNode("Ver item"));
			paragraph.appendChild(link);
			element.appendChild(paragraph);
			div_obj.append(element);

		});
		div_obj.accordion();
	}
</script>
<?php
require 'footer.php';
?>
