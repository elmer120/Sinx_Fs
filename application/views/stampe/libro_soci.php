<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/*echo '<pre>'; 
var_dump($lista); 
echo '</pre>';*/?>


    <table class="uk-table uk-table-small uk-table-striped uk-table-hover uk-table-justify uk-table-middle">

        <h3  class="uk-text-center">Libro Soci</h3>

		x generare stampe http://tabulator.info/docs/4.1/download#pdf

        dati necessari:  luogo(comune) e data di nascita, indirizzo residenza - data di assunzione a socio
		x visualizzazione tabella usare tabulator

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
		{ title:"Tessera n°", field:"tessera_numero", align:"left"},
	 	{ title:"Nome", field:"nome", align:"left"},
		{ title:"Cognome", field:"cognome"},
		{ title:"Data Nascita", field:"data_nascita"},
		{ title:"Comune Nascita", field:"comune_nascita"},
		{ title:"Indirizzo", field:"indirizzo"},
		{ title:"Cap", field:"cap"},
		{ title:"Comune", field:"comune"},
		{ title:"Provincia", field:"provincia"},
		{ title:"Codice fiscale", field:"codice_fiscale"},
		{ title:"Tel", field:"telefono", sorter:"date", align:"center"},
		{ title:"Email", field:"email"},
		{ title:"Tipo", field:"tipo_socio"},
		{ title:"Carica", field:"carica_direttivo"}
	 ],
});

//carico i dati
table.setData(<? echo(json_encode($lista));?>);
</script>


