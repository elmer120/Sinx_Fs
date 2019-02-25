<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/*echo '<pre>'; 
var_dump($lista);
echo '</pre>';*/
?>
<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->
<?php echo_breadcrumbs($breadcrumbs)?>
    <div class="uk-section"> <!-- sezione -->
		<div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->
            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Rubrica soci</span>
			</h3>
			
			<div id="table"></div>

<script>
//definisco la tabella
var table = new Tabulator("#table", {
	layout:"fitDataFill", //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
	responsiveLayout:"collapse", //le colonne si impilano quando non c'è abb spazio
	placeholder:"No Data Available", //quando non ci sono dati
	tooltips:true,
 	columns:[ //definisco le colonne
		//title = titolo , field = chiave array
		{ title:"id", field:"id", visible: false},
		{ title:"Tessera n°", field:"tessera_numero"},
		{ title:"Scadenza", field:"tessera_scadenza"},
	 	{ title:"Nome", field:"nome"},
		{ title:"Cognome", field:"cognome"},
		{ title:"Indirizzo", field:"indirizzo"},
		{ title:"Comune", field: "comune"},
		{ title:"Provincia", field:"provincia"},
	 	{ title:"Telefono", field:"telefono"},
		{ title:"Telefono", field:"telefono_ext"},
		{ title:"Email", field:"email"},
		{ title:"Data Nascita", field:"data_nascita"},
	 ],
});

//carico i dati
table.setData(<? echo(json_encode($lista));?>);
</script>

		</div>
    </div> <!-- fine sezione -->

</div> <!--fine colonna -->
