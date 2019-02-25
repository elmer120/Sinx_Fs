<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($persona);
?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

<?php echo_breadcrumbs($breadcrumbs)?>

<div class="uk-section uk-section-muted uk-padding-small"> <!-- sezione -->
<div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->
            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Visualizza associato</span>
            </h3>

<?php echo form_open_multipart ('','class="uk-form-horizontal" onsubmit="set_enable()"');?>
    
    <fieldset class="uk-fieldset"> <!-- si occupa del padding nel form necessario per il form "orizzontali" -->

    <label class="uk-form-label">Immagine</label>
    <div class="uk-form-controls uk-margin">  
        <div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
        <img id="preview" class="uk-border-circle" width="150" height="150" src="<?php echo base_url('assets/img/associati/default/avatar.png');?>">
          <input id="file" type="file" name="avatar" onchange="previewFile()" accept="image/*"  disabled>
          <input id="filename" class="uk-input uk-form-width-medium" type="text" placeholder="Scegli file"  disabled>
          <?php echo form_error('avatar'); ?>
        </div>
    </div>

<!-- variabili globali javascript per la pagina -->
<script>
<?php 
    echo "var regione_sel='".$persona->regione."';"; 
    echo "var tipo_sel='".$persona->tipo_associato."';";
    echo "var carica_sel='".$persona->carica."';";
?>
</script>
<input type="hidden" name="fk_associato"  value="<?php echo $persona->fk_associato;?>">
      <label class="uk-form-label">Nome</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="name" placeholder="Mario" pattern="[A-Za-z]+"  value="<?php echo $persona->name?>" required disabled>
      <?php echo form_error('name'); ?>
    </div>
  
      <label class="uk-form-label">Cognome</label>
    <div class="uk-form-controls">
        <input class="uk-input uk-form-width-medium" class="uk-input" type="text" name="surname" pattern="[A-Za-z]+" placeholder="Last Name"  value="<?php echo $persona->surname?>" disabled>
        <?php echo form_error('surname'); ?>
    </div>
  
    <label class="uk-form-label">Data di nascita</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="date" name="datebirth" placeholder="01/07/1975" value="<?php echo $persona->datebirth?>" disabled>
      <?php echo form_error('datebirth'); ?>
    </div>

      <label class="uk-form-label">Codice fiscale</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="fiscal_code" pattern="[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]" placeholder="RSSMRA75L01H501A"  value="<?php echo $persona->fiscal_code ?>" disabled>
      <?php echo form_error('fiscal_code'); ?>
    </div>
  
    <label class="uk-form-label">Regione di residenza</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_regioni" required disabled>
       <!--selezionata da jquery-->
      </select>
    </div>

    <label class="uk-form-label">Provincia di residenza</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_province" required disabled>
      <option value="<?php echo $persona->p_id; ?>" selected><?php echo $persona->provincia; ?></option>
      </select>
    </div>

    <label class="uk-form-label">Comune di residenza</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_comuni" name="fk_comune" required disabled>
      <option value="<?php echo $persona->c_id; ?>" selected><?php echo $persona->comune; ?></option>
      </select>
      <?php echo form_error('fk_comune'); ?>
    </div>

      <label class="uk-form-label">Indirizzo di residenza</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="address" placeholder="Via Alle spezie, 8"  value="<?php echo $persona->address?>" disabled>
      <?php echo form_error('address'); ?>
    </div>
  
      <label class="uk-form-label">Telefono</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone" placeholder="0123987654"  value="<?php echo $persona->phone ?>" disabled>
      <?php echo form_error('phone'); ?>
    </div>
  
      <label class="uk-form-label">Telefono secondario</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone_ext" placeholder="3219876543"  value="<?php echo $persona->phone_ext ?>" disabled>
      <?php echo form_error('phone_ext'); ?>
    </div>
  
      <label class="uk-form-label">Indirizzo e-mail</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="email" name="email" placeholder="mario.rossi@gmail.com"  value="<?php echo $persona->email ?>" disabled>
      <?php echo form_error('email'); ?>
    </div>
  
      <label class="uk-form-label">Numero tessera</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="n_card" placeholder="formato libero"  value="<?php echo $persona->n_card ?>" required disabled>
      <?php echo form_error('n_card'); ?>
    </div>

      <label class="uk-form-label">Consenso privacy</label>
    <div class="uk-form-controls">
      <input class="uk-checkbox" name="privacy" type="hidden" value="0" >
      <input class="uk-checkbox" name="privacy" type="checkbox" value="1" <?php echo $persona->privacy ? "checked" : "" ?>  disabled>
    </div>
  <br>
      <label class="uk-form-label">Associato attivo</label>
    <div class="uk-form-controls">
      <input class="uk-checkbox" name="active" type="hidden" value="0">
      <input class="uk-checkbox" name="active" type="checkbox" value="1" <?php echo $persona->active ? "checked" : "" ?>  disabled>
    </div>
  <br>

    <label class="uk-form-label">Tipo associato</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_tipo" name="fk_tipo_associato" required disabled>
      </select>
      <?php echo form_error('fk_tipo_associato'); ?>
    </div>
    
    <label class="uk-form-label">Carica</label>
    <div class="uk-form-controls">  
      <select class="uk-select uk-form-width-medium" id="select_carica" name="fk_cariche_direttivo" required disabled>
      </select>
      <?php echo form_error('fk_cariche_direttivo'); ?>
    </div>

    <label class="uk-form-label">Note aggiuntive</label>
    <div class="uk-form-controls">
      <textarea class="uk-textarea uk-form-width-medium" name="note" rows="2"  disabled><?php echo $persona->note ?></textarea>
      <?php echo form_error('note'); ?>
    </div>


    </fieldset>

</form>

        </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<!-- chiamate ajax -->
<script src="<?php echo base_url('assets/js/luoghi.js');?>"></script>
<script src="<?php echo base_url('assets/js/tipi.js');?>"></script>
<!-- script di pagina -->
<script src="<?php echo base_url('assets/js/option_select.js');?>"></script>
<script src="<?php //echo base_url('assets/js/img_preview.js');?>"></script>
