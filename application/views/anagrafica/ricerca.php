<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? //var_dump($lista); ?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->
<?php echo_breadcrumbs($breadcrumbs)?>
    <div class="uk-section"> <!-- sezione -->
        <div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Ricerca in anagrafica</span>
            </h3>

<!-- barra azioni -->
<button class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal_aggiungi" type="button" >Aggiungi</button>
<button id="btn_modifica" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal_aggiungi" type="button" disabled>Modifica</button>
<button id="btn_elimina" class="uk-button uk-button-primary uk-button-small" disabled>Elimina</button>
<div class="uk-form-custom uk-search uk-search-default">
	<a href="#" id="a_search" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon=""></a>
	<input id="input_search" class="uk-search-input" type="search" name="text_search" value="" placeholder="Cerca...">
</div>

<div id="app">
  <p>{{ origin}}</p>
</div>

<script src='https://cdn.jsdelivr.net/npm/vue@2.5.22/dist/vue.js'></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
<script src="<?php echo base_url('assets/js/main.js') ?>"></script>



<!-- Finestra modal aggiungi -->
<div id="modal_aggiungi" class="uk-modal-container" uk-modal='{"bg-close":false}'>
    <div class="uk-modal-dialog" uk-overflow-auto>
		<!-- header -->
		<div class="uk-modal-header">
        	<h2 class="uk-modal-title">Aggiungi persona/socio</h2>
			<span class="uk-text-danger">Richiesto *</span>
		</div>
		<!-- body -->  
		<div class="uk-modal-body">
		
		<form id="form_aggiungi" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
						
						<?php //echo form_open_multipart ('Anagrafica/create_associato','class="uk-grid-small"');?>
						
						<!--div class="uk-width-auto">  
							<img id="preview" class="uk-border-circle" style="display:block" width="75" height="75" src="<?php echo base_url('assets/img/associati/default/avatar.png');?>">
						</div-->

						<div class="uk-width-1-6@m uk-form-custom">  
							<label class="uk-form-label">Immagine</label>
							<div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
							<input id="file"  class="uk-input" type="file" name="avatar" onchange="previewFile()" accept="image/*">
							<input id="filename" class="uk-input" type="text" placeholder="Scegli file <?php echo set_value('avatar'); ?>">
							<?php echo form_error('avatar'); ?>
							</div>
						</div>
						
				<legend class="uk-legend">Dati anagrafici</legend>
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Nome *</label>
							<input class="uk-input uk-form-small" type="text" name="nome" placeholder="Ugo" pattern="[A-Za-z]+" value="<?php echo set_value('nome'); ?>" required>
							<?php echo form_error('nome'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Cognome *</label>
							<input class="uk-input uk-form-small" class="uk-input" type="text" name="cognome" pattern="[A-Za-z]+" value="<?php echo set_value('cognome'); ?>" placeholder="Rossi">
							<?php echo form_error('cognome'); ?>
						</div>
					
					
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Data di nascita</label>
							<input class="uk-input uk-form-small" type="date" name="data_nascita" value="<?php echo set_value('data_nascita'); ?>" placeholder="01/07/1975">
							<?php echo form_error('data_nascita'); ?>
						</div>
								
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Provincia di nascita</label>
							<select class="uk-select uk-form-small" id="select_province_nascita">
						</select>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Comune di nascita *</label>
							<select class="uk-select uk-form-small" id="select_comuni_nascita" name="fk_comuni_nascita" value="<?php echo set_value('fk_comuni_nascita'); ?>">
							<option value="" selected>Scegli il comune</option>
							</select>
							<?php echo form_error('fk_comuni_nascita'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Codice fiscale</label>
							<input class="uk-input uk-form-small" type="text" name="codice_fiscale" pattern="[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]" value="<?php echo set_value('codice_fiscale'); ?>" placeholder="RSSMRA75L01H501A">
							<?php echo form_error('codice_fiscale'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Partita iva</label>
							<input class="uk-input uk-form-small" type="text" name="partita_iva" value="<?php echo set_value('partita_iva'); ?>" placeholder="12365421">
							<?php echo form_error('partita_iva'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Regione di residenza</label>
							<select class="uk-select uk-form-small" id="select_regioni" >
						</select>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Provincia di residenza</label>
							<select class="uk-select uk-form-small" id="select_province" >
								<option value="" selected>Scegli la provincia</option>
							</select>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Comune di residenza *</label>
							<select class="uk-select uk-form-small" id="select_comuni" name="fk_comuni" value="<?php echo set_value('fk_comuni'); ?>" >
								<option value="" selected>Scegli il comune</option>
							</select>
							<?php echo form_error('fk_comuni'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Indirizzo di residenza</label>
							<input class="uk-input uk-form-small" type="text" name="indirizzo" value="<?php echo set_value('indirizzo'); ?>" placeholder="Via Alle spezie, 8">
							<?php echo form_error('indirizzo'); ?>
						</div>

						<div class="uk-width-1-6@m uk-margin">
							<label class="uk-form-label">Consenso privacy</label>
							<input class="uk-checkbox" name="privacy" type="hidden" value="">
							<input class="uk-checkbox" name="privacy" type="checkbox" value="1">
						</div>
						
				<legend class="uk-legend">Contatti</legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Telefono</label>
							<input class="uk-input uk-form-small" type="text" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="0464598547">
							<?php echo form_error('telefono'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Telefono secondario</label>
							<input class="uk-input uk-form-small" type="text" name="telefono_ext" value="<?php echo set_value('telefono_ext'); ?>" placeholder="3219876543">
							<?php echo form_error('telefono_ext'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Indirizzo e-mail</label>
							<input class="uk-input uk-form-small" type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="ugo.rossi@gmail.com">
							<?php echo form_error('email'); ?>
						</div>
				
				<legend class="uk-legend">Varie</legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Sotto la responsabilità di ..</label>
							<select class="uk-select uk-form-small" name="fk_responsabile" id="select_responsabile">
						</select>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Iban</label>
							<input class="uk-input uk-form-small" type="text" name="iban" value="<?php echo set_value('iban'); ?>" placeholder="IT60X0542811101000000123456">
							<?php echo form_error('iban'); ?>
						</div>


						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Nome Banca</label>
							<input class="uk-input uk-form-small" type="text" name="banca" value="<?php echo set_value('banca'); ?>" placeholder="Cassa rurale">
							<?php echo form_error('banca'); ?>
						</div>


						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Note aggiuntive</label>
							<textarea class="uk-textarea uk-form-small" name="note" rows="2"><?php echo set_value('note'); ?></textarea>
							<?php echo form_error('note'); ?>
						</div>

				<legend id="socio_legend" class="uk-legend uk-text-muted">Dati iscrizione 
				<input id="socio_checkbox" class="uk-checkbox" type="checkbox" name="socio"> </legend> 

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Tipo associato *</label>
							<select class="uk-select uk-form-small" id="select_tipo" name="fk_soci_tipologie" value="<?php echo set_value('fk_soci_tipologie'); ?>" disabled>
								<option value="">*Tipo associato...</option>
							</select>
							<?php echo form_error('fk_soci_tipologie'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Richiesta iscrizione *</label>
							<input class="uk-input uk-form-small" type="date" name="richiesta_data" value="<?php echo set_value('richiesta_data'); ?>" placeholder="01/01/2019" disabled>
							<?php echo form_error('richiesta_data'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Approvazione iscrizione *</label>
							<input class="uk-input uk-form-small" type="date" name="approvazione_data" value="<?php echo set_value('approvazione_data'); ?>" placeholder="03/01/2019" disabled>
							<?php echo form_error('approvazione_data'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza iscrizione</label>
							<input class="uk-input uk-form-small" type="date" name="scadenza_data" value="<?php echo set_value('scadenza_data'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('scadenza_data'); ?>
						</div>

				<legend id="certificato_medico_legend" class="uk-legend uk-text-muted">Certificato medico </legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza certificato</label>
							<input class="uk-input uk-form-small" type="date" name="certificato_scadenza_al" value="<?php echo set_value('certificato_scadenza_al'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('certificato_scadenza_al'); ?>
						</div>

				<legend id="carica_direttivo_legend" class="uk-legend uk-text-muted"> Carica sociale 
				<input id="carica_direttivo_checkbox" class="uk-checkbox" name="carica_direttivo" type="checkbox" disabled> </legend>

						<div class="uk-width-1-6@m">  
							<label class="uk-form-label uk-text-danger">Carica *</label>
							<select class="uk-select uk-form-small" id="select_carica" name="fk_cariche_direttivo" value="<?php echo set_value('fk_cariche_direttivo'); ?>" disabled>
								<option value="">*Carica direttivo</option>
							</select>
							<?php echo form_error('fk_cariche_direttivo'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Inizio carica</label>
							<input class="uk-input uk-form-small" type="date" name="carica_direttivo_dal" value="<?php echo set_value('carica_direttivo_dal'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('carica_direttivo_dal'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Fine carica</label>
							<input class="uk-input uk-form-small" type="date" name="carica_direttivo_al" value="<?php echo set_value('carica_direttivo_al'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('carica_direttivo_al'); ?>
						</div>
								
				<legend id="tessere_legend" class="uk-legend uk-text-muted">Dati tesseramento 
				<input id="tessere_checkbox" class="uk-checkbox" name="tessere" type="checkbox" disabled> </legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Numero tessera *</label>
							<input class="uk-input uk-form-small" type="text" name="numero" value="<?php echo set_value('numero'); ?>" placeholder="formato libero" disabled>
							<?php echo form_error('numero'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Valida dal</label>
							<input class="uk-input uk-form-small" type="date" name="tessere_dal" value="<?php echo set_value('tessere_dal'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('tessere_dal'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza al</label>
							<input class="uk-input uk-form-small" type="date" name="tessere_al" value="<?php echo set_value('tessere_al'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('tessere_al'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Tipo tessera</label>
							<input class="uk-input uk-form-small" type="text" name="tessere_tipo" value="<?php echo set_value('tessere_tipo'); ?>" placeholder="formato libero" disabled>
							<?php echo form_error('tessere_tipo'); ?>
						</div>
		
		</div>
		<!-- footer -->
		<div class="uk-modal-footer">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Annulla</button>
         	<input class="uk-button uk-button-primary" type="submit" name="submit" value="Salva">
		</div>
		</form>
	</div>
</div>
<script>/*
<!-- Finestra modal modifica -->
<div id="modal_modifica" class="uk-modal-container" uk-modal='{"bg-close":false}'>
    <div class="uk-modal-dialog" uk-overflow-auto>
		<!-- header -->
		<div class="uk-modal-header">
        	<h2 class="uk-modal-title">Modifica persona/socio</h2>
			<span class="uk-text-danger">Richiesto *</span>
		</div>
		<!-- body -->  
		<div class="uk-modal-body">
		
		<form id="form_modifica" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
						
						<?php //echo form_open_multipart ('Anagrafica/create_associato','class="uk-grid-small"');?>
						
						<!--div class="uk-width-auto">  
							<img id="preview" class="uk-border-circle" style="display:block" width="75" height="75" src="<?php echo base_url('assets/img/associati/default/avatar.png');?>">
						</div-->

						<div class="uk-width-1-6@m uk-form-custom">  
							<label class="uk-form-label">Immagine</label>
							<div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
							<input id="file"  class="uk-input" type="file" name="avatar" onchange="previewFile()" accept="image/*">
							<input id="filename" class="uk-input" type="text" placeholder="Scegli file <?php echo set_value('avatar'); ?>">
							<?php echo form_error('avatar'); ?>
							</div>
						</div>
						
				<legend class="uk-legend">Dati anagrafici</legend>
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Nome *</label>
							<input class="uk-input uk-form-small" type="text" name="nome" placeholder="Ugo" pattern="[A-Za-z]+" value="<?php echo set_value('nome'); ?>" required>
							<?php echo form_error('nome'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Cognome *</label>
							<input class="uk-input uk-form-small" class="uk-input" type="text" name="cognome" pattern="[A-Za-z]+" value="<?php echo set_value('cognome'); ?>" placeholder="Rossi">
							<?php echo form_error('cognome'); ?>
						</div>
					
					
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Data di nascita</label>
							<input class="uk-input uk-form-small" type="date" name="data_nascita" value="<?php echo set_value('data_nascita'); ?>" placeholder="01/07/1975">
							<?php echo form_error('data_nascita'); ?>
						</div>
								
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Provincia di nascita</label>
							<select class="uk-select uk-form-small" id="select_province_nascita_mod">
						</select>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Comune di nascita *</label>
							<select class="uk-select uk-form-small" id="select_comuni_nascita_mod" name="fk_comuni_nascita" value="<?php echo set_value('fk_comuni_nascita'); ?>">
							<option value="" selected>Scegli il comune</option>
							</select>
							<?php echo form_error('fk_comuni_nascita'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Codice fiscale</label>
							<input class="uk-input uk-form-small" type="text" name="codice_fiscale" pattern="[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]" value="<?php echo set_value('codice_fiscale'); ?>" placeholder="RSSMRA75L01H501A">
							<?php echo form_error('codice_fiscale'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Partita iva</label>
							<input class="uk-input uk-form-small" type="text" name="partita_iva" value="<?php echo set_value('partita_iva'); ?>" placeholder="12365421">
							<?php echo form_error('partita_iva'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Regione di residenza</label>
							<select class="uk-select uk-form-small" id="select_regioni_mod" >
						</select>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Provincia di residenza</label>
							<select class="uk-select uk-form-small" id="select_province_mod" >
								<option value="" selected>Scegli la provincia</option>
							</select>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Comune di residenza *</label>
							<select class="uk-select uk-form-small" id="select_comuni_mod" name="fk_comuni" value="<?php echo set_value('fk_comuni'); ?>" >
								<option value="" selected>Scegli il comune</option>
							</select>
							<?php echo form_error('fk_comuni'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Indirizzo di residenza</label>
							<input class="uk-input uk-form-small" type="text" name="indirizzo" value="<?php echo set_value('indirizzo'); ?>" placeholder="Via Alle spezie, 8">
							<?php echo form_error('indirizzo'); ?>
						</div>

						<div class="uk-width-1-6@m uk-margin">
							<label class="uk-form-label">Consenso privacy</label>
							<input class="uk-checkbox" name="privacy" type="hidden" value="">
							<input class="uk-checkbox" name="privacy" type="checkbox" value="1">
						</div>
						
				<legend class="uk-legend">Contatti</legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Telefono</label>
							<input class="uk-input uk-form-small" type="text" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="0464598547">
							<?php echo form_error('telefono'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Telefono secondario</label>
							<input class="uk-input uk-form-small" type="text" name="telefono_ext" value="<?php echo set_value('telefono_ext'); ?>" placeholder="3219876543">
							<?php echo form_error('telefono_ext'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Indirizzo e-mail</label>
							<input class="uk-input uk-form-small" type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="ugo.rossi@gmail.com">
							<?php echo form_error('email'); ?>
						</div>
				
				<legend class="uk-legend">Varie</legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Sotto la responsabilità di ..</label>
							<select class="uk-select uk-form-small" name="fk_responsabile" id="select_responsabile_mod">
						</select>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Iban</label>
							<input class="uk-input uk-form-small" type="text" name="iban" value="<?php echo set_value('iban'); ?>" placeholder="IT60X0542811101000000123456">
							<?php echo form_error('iban'); ?>
						</div>


						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Nome Banca</label>
							<input class="uk-input uk-form-small" type="text" name="banca" value="<?php echo set_value('banca'); ?>" placeholder="Cassa rurale">
							<?php echo form_error('banca'); ?>
						</div>


						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Note aggiuntive</label>
							<textarea class="uk-textarea uk-form-small" name="note" rows="2"><?php echo set_value('note'); ?></textarea>
							<?php echo form_error('note'); ?>
						</div>

				<legend id="socio_legend" class="uk-legend uk-text-muted">Dati iscrizione 
				<input id="socio_checkbox" class="uk-checkbox" type="checkbox" name="socio"> </legend> 

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Tipo associato *</label>
							<select class="uk-select uk-form-small" id="select_tipo_mod" name="fk_soci_tipologie" value="<?php echo set_value('fk_soci_tipologie'); ?>" disabled>
								<option value="">*Tipo associato...</option>
							</select>
							<?php echo form_error('fk_soci_tipologie'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Richiesta iscrizione *</label>
							<input class="uk-input uk-form-small" type="date" name="richiesta_data" value="<?php echo set_value('richiesta_data'); ?>" placeholder="01/01/2019" disabled>
							<?php echo form_error('richiesta_data'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Approvazione iscrizione *</label>
							<input class="uk-input uk-form-small" type="date" name="approvazione_data" value="<?php echo set_value('approvazione_data'); ?>" placeholder="03/01/2019" disabled>
							<?php echo form_error('approvazione_data'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza iscrizione</label>
							<input class="uk-input uk-form-small" type="date" name="scadenza_data" value="<?php echo set_value('scadenza_data'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('scadenza_data'); ?>
						</div>

				<legend id="certificato_medico_legend" class="uk-legend uk-text-muted">Certificato medico </legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza certificato</label>
							<input class="uk-input uk-form-small" type="date" name="certificato_scadenza_al" value="<?php echo set_value('certificato_scadenza_al'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('certificato_scadenza_al'); ?>
						</div>

				<legend id="carica_direttivo_legend" class="uk-legend uk-text-muted"> Carica sociale 
				<input id="carica_direttivo_checkbox" class="uk-checkbox" name="carica_direttivo" type="checkbox" disabled> </legend>

						<div class="uk-width-1-6@m">  
							<label class="uk-form-label uk-text-danger">Carica *</label>
							<select class="uk-select uk-form-small" id="select_carica_mod" name="fk_cariche_direttivo" value="<?php echo set_value('fk_cariche_direttivo'); ?>" disabled>
								<option value="">*Carica direttivo</option>
							</select>
							<?php echo form_error('fk_cariche_direttivo'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Inizio carica</label>
							<input class="uk-input uk-form-small" type="date" name="carica_direttivo_dal" value="<?php echo set_value('carica_direttivo_dal'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('carica_direttivo_dal'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Fine carica</label>
							<input class="uk-input uk-form-small" type="date" name="carica_direttivo_al" value="<?php echo set_value('carica_direttivo_al'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('carica_direttivo_al'); ?>
						</div>
								
				<legend id="tessere_legend" class="uk-legend uk-text-muted">Dati tesseramento 
				<input id="tessere_checkbox" class="uk-checkbox" name="tessere" type="checkbox" disabled> </legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Numero tessera *</label>
							<input class="uk-input uk-form-small" type="text" name="numero" value="<?php echo set_value('numero'); ?>" placeholder="formato libero" disabled>
							<?php echo form_error('numero'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Valida dal</label>
							<input class="uk-input uk-form-small" type="date" name="tessere_dal" value="<?php echo set_value('tessere_dal'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('tessere_dal'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza al</label>
							<input class="uk-input uk-form-small" type="date" name="tessere_al" value="<?php echo set_value('tessere_al'); ?>" placeholder="13/01/2020" disabled>
							<?php echo form_error('tessere_al'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Tipo tessera</label>
							<input class="uk-input uk-form-small" type="text" name="tessere_tipo" value="<?php echo set_value('tessere_tipo'); ?>" placeholder="formato libero" disabled>
							<?php echo form_error('tessere_tipo'); ?>
						</div>
		
		</div>
		<!-- footer -->
		<div class="uk-modal-footer">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Annulla</button>
         	<input class="uk-button uk-button-primary" type="submit" name="submit" value="Aggiorna">
		</div>
		</form>
	</div>
</div>*/
</script>

<!-- tabella-->
<div id="table"></div>

<script>




//al cambio nella select filtro i dati in tabella
$('#select_type').on('change', function() {
	if(this.value!="T")
	{ table.setFilter("type","=",this.value);}
	else{
	  table.clearFilter();
	}
});

//al click su cerca
var last_value_search;
$('#a_search').on('click', function() {
	if(typeof last_value_search !== 'undefined')
	{
		table.removeFilter("name", "=", last_value_search);
	}
	table.addFilter("name","like",$('#input_search').val());
	last_value_search = $('#input_search').val();
});


//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	create_table();
	//setto le impostazioni ajax comuni
	$.ajaxSetup({
		type: 'POST',
		cache: false,  
		//dataType: 'text', //Tipo di dato che si riceve di ritorno
        //contentType : 'application/json', //tipo di contenuto inviato al serve
	});
	//popolo il select regioni con tutte
	get_regioni('#select_regioni');
	//popolo il select province di nascita con tutte
	get_province(null,'#select_province_nascita');
	//popolo il select tipo associato
	get_soci_tipologie('#select_tipo');
	//popolo il select carica direttivo
	get_cariche_direttivo('#select_carica');
	//popolo il select responsabile
	get_responsabili('#select_responsabile');
	
});
// ---- FUNZIONI ----
var table;
var row_selected_id;

function create_table(){
//definisco la tabella
 table = new Tabulator("#table", {
	layout:"fitColumns", //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
	responsiveLayout:"collapse", //le colonne si impilano quando non c'è abb spazio
	placeholder:"No Data Available", //quando non ci sono dati
	pagination:"local", //imposto la paginazione
	paginationSize:10, //per ogni pagina mostro n righe
	selectable:1, //righe selezionabili
	rowSelected:row_selected, //callback riga selezionata
	rowDeselected:row_deselected, //callback riga deselezionata
	rowSelectionChanged: row_selection_changed, //callback al cambio selezione riga
	tooltips:true,
 	columns:[ //definisco le colonne
		//title = titolo , field = chiave array
		{ title:"#", formatter:"rownum"},
		{ title:"Azioni", width:110, resizable:false },
		{	//creo gruppo persona
			title: 'Persona',
			columns:[
			{ title:"Nome", field:"nome"},
			{ title:"Cognome", field:"cognome"},
			{ title:"Comune nascita", field:"comune_nascita"},
			{ title:"Comune residenza", field:"comune_residenza"},
			{ title:"Data nascita", field:"data_nascita"},
			],
		},
		{ title:"Tipo socio", field:"soci_tipologia"},
		{ title:"Carica direttivo", field:"carica_direttivo"},
		{ title:"Tessera n°", field:"tessera_numero"},
		{ title:"Certificato scadenza", field:"certificato_scadenza_al"},
		{ title:"Approvato", field:"approvazione_data"},
		{ title:"Quota scadenza", field:"quota_scadenza"}]
});
//carico i dati in tabella
//table.setData(<? //echo(json_encode($lista));?>);
table.setData(controller_url+"get_list");
}


//---- EVENTI -----
//alla selezione di un riga
function row_selected(row)
{
	//recupero l'id (del database)
	row_selected_id = row.getData()['id'];
	if(row_selected_id != null)
	{	//abilito i pulsanti
		$('#btn_modifica').attr('disabled',false);
		$('#btn_elimina').attr('disabled',false);
	}
};
// alla deselezione metto a null l'id precedente
function row_deselected(row){
	row_selected_id = null;
	//disabilito i pulsanti
	$('#btn_modifica').attr('disabled',true);
	$('#btn_elimina').attr('disabled',true);
}
function row_selection_changed(data, rows)
{
	if(data.length > 0)
	{
		row_selected_id = data[0].id;
		//abilito i pulsanti
		$('#btn_modifica').attr('disabled',false);
		$('#btn_elimina').attr('disabled',false);
	}
}
$('#socio_checkbox').on('click',function(){
	if(this.checked) //se checkbox socio è abilitato
	{
		console.log('socio_abilitato');
		//abilito i legend di socio
		$('#socio_legend').removeClass("uk-text-muted");
		$('#certificato_medico_legend').removeClass("uk-text-muted");

		//abilito i checkbox di carica direttivo e tessere
		$('#carica_direttivo_checkbox').attr('disabled',false);
		$('#tessere_checkbox').attr('disabled',false);

		//abilito gli input di soci
		$( "select[name='fk_soci_tipologie']" ).attr('disabled',false);
		$( "input[name='richiesta_data']" ).attr('disabled',false);
		$( "input[name='approvazione_data']" ).attr('disabled',false);
		$( "input[name='scadenza_data']" ).attr('disabled',false);
		$( "input[name='certificato_scadenza_al']" ).attr('disabled',false);
	}
	else{
		//disabilito i legend di socio
		$('#socio_legend').addClass("uk-text-muted");
		$('#certificato_medico_legend').addClass("uk-text-muted");
		
		//se carica direttivo e tessere sono abilitati li disabilito
		if($('#carica_direttivo_checkbox')[0].checked)
		{$('#carica_direttivo_checkbox').trigger('click');} //simulo il click
		if($('#tessere_checkbox')[0].checked)
		{$('#tessere_checkbox').trigger('click');}
		
		//disabilito i checkbox di carica direttivo e tessere
		$('#carica_direttivo_checkbox').attr('disabled',true);
		$('#tessere_checkbox').attr('disabled',true);
		
		//disabilito gli input di soci e faccio clear dei valori
		$( "select[name='fk_soci_tipologie']" ).attr('disabled',true);
		$( "select[name='fk_soci_tipologie']" ).val('');
		$( "input[name='richiesta_data']" ).attr('disabled',true);
		$( "input[name='richiesta_data']" ).val('');
		$( "input[name='approvazione_data']" ).attr('disabled',true);
		$( "input[name='approvazione_data']" ).val('');
		$( "input[name='scadenza_data']" ).attr('disabled',true);
		$( "input[name='scadenza_data']" ).val('');
		$( "input[name='certificato_scadenza_al']" ).attr('disabled',true);
		$( "input[name='certificato_scadenza_al']" ).val('');
	}
});
$('#carica_direttivo_checkbox').on('click',function(){
	if(this.checked) //se checkbox carica direttivo è abilitato
	{
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_al']" ).attr('disabled',false);
	}
	else{
		//disabilito gli input di carica direttivo e faccio clear dei valori
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',true);
		$( "select[name='fk_cariche_direttivo']" ).val('');
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_dal']" ).val('');
		$( "input[name='carica_direttivo_al']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_al']" ).val('');
	}
});
$('#tessere_checkbox').on('click',function(){
if(this.checked)//se checkbox tessere è abilitato
{
	//abilito gli input di tessere
	$( "input[name='numero']" ).attr('disabled',false);
	$( "input[name='tessere_dal']" ).attr('disabled',false);
	$( "input[name='tessere_al']" ).attr('disabled',false);
	$( "input[name='tessere_tipo']" ).attr('disabled',false);
}
else{
	//disabilito gli input di tessere e faccio clear dei valori
	$( "input[name='numero']" ).attr('disabled',true);
	$( "input[name='numero']" ).val('');
	$( "input[name='tessere_dal']" ).attr('disabled',true);
	$( "input[name='tessere_dal']" ).val('');
	$( "input[name='tessere_al']" ).attr('disabled',true);
	$( "input[name='tessere_al']" ).val('');
	$( "input[name='tessere_tipo']" ).attr('disabled',true);
	$( "input[name='tessere_tipo']" ).val('');
}
});

$('#btn_modifica').on('click',function()
{
	//popolo il select regioni con tutte
	get_regioni('#select_regioni_mod');
	//popolo il select province di nascita con tutte
	get_province(null,'#select_province_nascita_mod');
	//popolo il select tipo associato
	get_soci_tipologie('#select_tipo_mod');
	//popolo il select carica direttivo
	get_cariche_direttivo('#select_carica_mod');
	//popolo il select responsabile
	get_responsabili('#select_responsabile_mod');
	//popolo il select tipo associato
	get_persona(row_selected_id);
});

//all submit del form aggiungi
$('#form_aggiungi').on('submit',function(e){
	e.preventDefault();
	submit_aggiungi();
})
//all submit del form modifica
$('#form_modifica').on('submit',function(e){
	e.preventDefault();
	submit_modifica();
})
//alla selezione della provincia di nascita carico i corrispondenti comuni
$('#select_province_nascita').on('change',function(){
	get_comuni(this.value,'#select_comuni_nascita');
});
//alla selezione della provincia di residenza carico i corrispondenti comuni
$('#select_province').on('change',function(){
	get_comuni(this.value,'#select_comuni');
});
//alla selezione della regione di residenza carico le corrispondenti province
$('#select_regioni').on('change',function(){
	get_province(this.value,'#select_province');
	$('#select_comuni').html('<option value="" disabled selected>Scegli il comune</option>');
});

//-- CHIAMATE AJAX ------

//chiamata ajax per popolare il select delle regioni
function get_regioni(id_element) {
    $.ajax({
        url: controller_url+"get_regioni",
        data: '',
        success: function(data){
          $(id_element).html(data);
        },
        error: function(data) { 
             alert(" Luoghi.js: Errore nella chiamata ajax!");
        }
   });
}
//chiamata ajax per popolare il select delle provincie
function get_province(id_select,id_element) {
          $.ajax({
             url: controller_url+'get_province',
              data: {"region_select" : id_select},
              success: function(data){
                  //popolo le province
                  $(id_element).html(data);
                  //riabilito il select
                 /* $('#select_province').attr('disabled',false);
                  //disabilito il select dei comuni
                  $('#select_comuni').html('');
                  $('#select_comuni').attr('disabled',true);*/
              },
              error: function(data) { 
                alert("Luoghi.js: Errore nella chiamata ajax!");
              }
         });
}
 //chiamata ajax per popolare il select dei comuni
function get_comuni(id_select,id_element){
            $.ajax({
                url: controller_url+'get_comuni',
                data: {"provincia_select" : id_select},
                success: function(data){
                    //popolo i comuni
                    $(id_element).html(data);
                    //riabilito il select
                    //$('#select_comuni').attr('disabled',false);
                },
                error: function(data) { 
                    alert("Luoghi.js: Errore nella chiamata ajax!");
                }
           });
}
//chiamata ajax per popolare il select tipo
function get_soci_tipologie(id_element){
	$.ajax({
                type: 'POST',
                url: controller_url+"get_tipi_associato",
                data: '',
                success: function(data){
                  $(id_element).html(data);
                },
                error: function(data) { 
                     alert("Tipi.js: Errore nella chiamata ajax!");
                }
           });
}
//chiamata ajax per popolare il select carica direttivo
function get_cariche_direttivo(id_element) {
         $.ajax({
             type: 'POST',
             url: controller_url+"get_cariche_direttivo",
             data: '',
             success: function(data){
              $(id_element).html(data);
             },
             error: function(data) { 
                  alert("Tipi.js: Errore nella chiamata ajax!");
             }
        });
}
//chiamata ajax per popolare il select responsabile
function get_responsabili(id_element) {
         $.ajax({
             type: 'POST',
             url: controller_url+"get_responsabili",
             data: '',
             success: function(data){
              $(id_element).html(data);
             },
             error: function(data) { 
                  alert("Tipi.js: Errore nella chiamata ajax!");
             }
        });
}
//chiamata ajax per popolare il modifica
function get_persona(id)
{
	$.ajax({
             type: 'POST',
             url: controller_url+"get_person",
             data: {"id" : id},
             success: function(data){
			  console.log(data);
			  persona = JSON.parse(data)[0];
			  $('input[name=nome]').val(persona.nome);
			  $('input[name=cognome]').val(persona.cognome);
			  $('input[name=data_nascita]').val(persona.data_nascita);
			  $('input[name=codice_fiscale]').val(persona.codice_fiscale);
			  $('input[name=partita_iva]').val(persona.partita_iva);
			  $('input[name=indirizzo]').val(persona.indirizzo);
			  //$('input[name=nome]').val(persona.nome);
			  $('input[name=telefono]').val(persona.telefono);
			  $('input[name=telefono_ext]').val(persona.telefono_ext);
			  $('input[name=email]').val(persona.email);
			  $('input[name=iban]').val(persona.iban);
			  $('input[name=banca]').val(persona.banca);
			  $('input[textarea=note]').val(persona.note);
			  $('input[name=numero]').val(persona.numero);
			  $('input[name=tessere_tipo]').val(persona.tessere_tipo);
			  
			},
             error: function(data) { 
                  alert("get_persona: Errore nella chiamata ajax!");
             }
        });
}

//chiamata ajax per l'invio del form aggiungi
function submit_aggiungi()
{
	//recupero i valori del form
	var data = $('#form_aggiungi').serialize();
	//console.log(data); //x debug
   $.ajax({
			 url: "<? echo site_url('anagrafica/create_associato') ?>",
			 data: data,
             success: function(data){
				var obj = JSON.parse(data);
				if(obj.status != "success")
				  {UIkit.notification({
					message: obj.message,
					status: obj.status,
					pos: 'bottom-center',
					timeout: 3000
					});
				  }else{ 
					UIkit.notification({
					message: obj.message,
					status: obj.status,
					pos: 'bottom-center',
					timeout: 2000
					});
					setTimeout(() => {
						UIkit.modal($('#modal')).hide();
						table.setData();
					}, 2000);
				  }
			 },
             error: function(data) { 
                  alert("Errore nella chiamata ajax! dettagli: " + data);
             }
		});
}

</script>

 </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<script>
function conferma(){
    
    var r = confirm("Confermi l'eliminazione?");
    if(r==false)
    {
        event.preventDefault();
    }
}
</script>

