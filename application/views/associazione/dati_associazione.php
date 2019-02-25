<?php
defined('BASEPATH') OR exit('No direct script access allowed');
var_dump($_SESSION['association']);
?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->
<?php echo_breadcrumbs($breadcrumbs)?>
<div class="uk-section uk-section-muted uk-padding-small"> <!-- sezione -->
<div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Dati Associazione</span>
            </h3>


<?php echo form_open_multipart ('Associazione/update_dati_associazione','class="uk-form-horizontal"');

//var_dump($_SESSION['association']);
?>
<!-- variabili globali javascript per la pagina -->
<script>
<?php echo "var regione_sel='".$_SESSION['association']['r_nome']."';"; ?>
</script>
    
<fieldset class="uk-fieldset"> <!-- si occupa del padding nel form necessario per il form "orizzontali" -->

<!--label class="uk-form-label">Logo</label>
    <div class="uk-form-controls uk-margin">  
    <img class="uk-border-circle" width="150" height="150" src="<?php echo base_url('assets/img/associazione/logo/').$_SESSION['association']['logo'];?>">
        <div class="js-upload" uk-form-custom>
          <input type="file"  name="logo" multiple>
          <button class="uk-button uk-button-default" type="button" tabindex="-1">Cambia logo</button>
          <?php echo form_error('logo'); ?>
        </div>
    </div-->

     <label class="uk-form-label">Logo</label>
    <div class="uk-form-controls uk-margin">  
        <div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
        <img id="preview" width="150" height="150" src="<?php echo base_url('assets/img/associazione/logo/').$_SESSION['association']['logo'];?>">
          <input id="file" type="file" name="logo" onchange="previewFile()" accept="image/*">
          <input id="filename" class="uk-input uk-form-width-medium" type="text" placeholder="Cambia logo">
          <?php echo form_error('logo'); ?>
        </div>
    </div>

<label class="uk-form-label">Nome</label>
    <div class="uk-form-controls uk-margin">
      <input class="uk-input uk-form-width-medium" type="text" name="nome" placeholder="Nome associazione" pattern="[A-Za-z\s]+" value="<?echo $_SESSION['association']['nome'];?>" required>
      <?php echo form_error('name'); ?>
    </div>

<label class="uk-form-label">Tipologia</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="tipo" placeholder="asd" value="<?echo $_SESSION['association']['tipo'];?>">
      <?php echo form_error('tipo'); ?>
    </div>
  
<label class="uk-form-label">Anno fondazione</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="anno_fondazione" placeholder="1950" value="<?echo $_SESSION['association']['anno_fondazione'];?>">
      <?php echo form_error('anno_fondazione'); ?>
    </div>

<label class="uk-form-label">Regione</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_regioni">
		<option value="<?php echo $_SESSION['association']['r_id'];?>" selected><?php echo $_SESSION['association']['r_nome'];?></option>
      </select>
    </div>

<label class="uk-form-label">Provincia</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_province" required disabled>
        <option value="<?php echo $_SESSION['association']['p_id'];?>" selected><?php echo $_SESSION['association']['p_nome'];?></option>
      </select>
    </div>

<label class="uk-form-label">Comune</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_comuni" name="fk_comuni" required disabled>
        <option value="<?php echo $_SESSION['association']['c_id'];?>" selected><?php echo $_SESSION['association']['c_nome'];?></option>
      </select>
      <?php echo form_error('fk_comuni'); ?>
    </div>

<label class="uk-form-label">Indirizzo</label>
    <div class="uk-form-controls">
        <input class="uk-input uk-form-width-medium" class="uk-input" type="text" name="indirizzo" placeholder="Via Dante, 8" value="<?echo $_SESSION['association']['indirizzo'];?>">
        <?php echo form_error('indirizzo'); ?>
    </div>
  
	<label class="uk-form-label">Codice Fiscale</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="codice_fiscale" placeholder="codice_fiscale" value="<?echo $_SESSION['association']['codice_fiscale'];?>">
      <?php echo form_error('codice_fiscale'); ?>
	</div>
	
	<label class="uk-form-label">VAT</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="vat" placeholder="22%" value="<?echo $_SESSION['association']['vat'];?>">
      <?php echo form_error('codice_fiscale'); ?>
    </div>

<label class="uk-form-label">Telefono</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="telefono" placeholder="0462458135" value="<?echo $_SESSION['association']['telefono'];?>">
      <?php echo form_error('telefono'); ?>
    </div>
    
<label class="uk-form-label">Cellulare</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="telefono_ext" placeholder="3331234567" value="<?echo $_SESSION['association']['telefono_ext'];?>">
      <?php echo form_error('telefono_ext'); ?>
    </div>


<label class="uk-form-label">Indirizzo e-mail</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="email" name="email" placeholder="info@mail.it" value="<?echo $_SESSION['association']['email'];?>">
      <?php echo form_error('email'); ?>
    </div>
  
<label class="uk-form-label">Indirizzo e-mail(PEC)</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="email" name="email_pec" placeholder="info@mailPec.it" value="<?echo $_SESSION['association']['email_pec'];?>">
      <?php echo form_error('email_pec'); ?>
    </div>
  
<label class="uk-form-label">Iscrizione (odv/aps)</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="registration" placeholder="" value="<?echo $_SESSION['association']['registration'];?>">
      <?php echo form_error('registration'); ?>
    </div>    

    <button class="uk-button uk-button-default" type="submit" onclick="set_enable()">Invia</button>
    </fieldset>
    <?php //mostro il risultato dell'invio del form 
    echo $this->session->flashdata('result'); ?>
</form>

        </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<!-- chiamate ajax -->
<script src="<?php echo base_url('assets/js/luoghi.js');?>"></script>
<!-- script di pagina -->
<script src="<?php echo base_url('assets/js/option_select.js');?>"></script>
<script src="<?php echo base_url('assets/js/img_preview.js');?>"></script>
