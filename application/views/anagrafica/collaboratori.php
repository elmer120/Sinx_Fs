<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

<div class="uk-section uk-section-muted"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Collaboratori</span>
            </h3>

<?php echo form_open_multipart ('Anagrafica/create_collaboratore','class="uk-form-horizontal"');?>

      <fieldset class="uk-fieldset">
        
      <label class="uk-form-label">Immagine</label>
    <div class="uk-form-controls uk-margin">  
    <img class="uk-border-circle" width="150" height="150" src="<?php echo base_url('assets/img/collaboratori/default/avatar.png');?>">
        <div class="js-upload" uk-form-custom>
          <input type="file"  name="avatar" multiple>
          <button class="uk-button uk-button-default" type="button" tabindex="-1">File</button>
          <?php echo form_error('avatar'); ?>
        </div>
    </div>

      <label class="uk-form-label">Nome</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="name" placeholder="Mario" required>
      <?php echo form_error('name'); ?>
    </div>
  
      <label class="uk-form-label">Cognome</label>
    <div class="uk-form-controls">
        <input class="uk-input uk-form-width-medium" class="uk-input" type="text" name="surname" placeholder="Rossi">
        <?php echo form_error('surname'); ?>
    </div>

    <label class="uk-form-label">Data di nascita</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="date" name="datebirth" placeholder="01/07/1975">
      <?php echo form_error('datebirth'); ?>
    </div>

      <label class="uk-form-label">Codice fiscale</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="fiscal_code" placeholder="RSSMRA75L01H501A">
      <?php echo form_error('fiscal_code'); ?>
    </div>

    <label class="uk-form-label">Regione di residenza</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_regioni" required>
      </select>
    </div>

    <label class="uk-form-label">Provincia di residenza</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_province" required disabled>
      </select>
    </div>

    <label class="uk-form-label">Comune di residenza</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_comuni" name="fk_comune" required disabled>
      </select>
    </div>

      <label class="uk-form-label">Indirizzo di residenza</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="address" placeholder="Via Alle spezie, 8">
      <?php echo form_error('address'); ?>
    </div>
  
    <label class="uk-form-label">Telefono</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone" placeholder="0123987654">
      <?php echo form_error('phone'); ?>
    </div>
  
    <label class="uk-form-label">Telefono secondario</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone_ext" placeholder="3219876543">
      <?php echo form_error('phone_ext'); ?>
    </div>
  
    <label class="uk-form-label">Indirizzo e-mail</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="email" placeholder="mario.rossi@gmail.com">
      <?php echo form_error('email'); ?>
    </div>
  
      <label class="uk-form-label">Mansione</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="mansione" placeholder="Assicuratore" required>
      <?php echo form_error('mansione'); ?>
    </div>

        <label class="uk-form-label">Note aggiuntive</label>
    <div class="uk-form-controls">
      <textarea class="uk-textarea uk-form-width-medium" name="note" rows="2" ></textarea>
      <?php echo form_error('note'); ?>
    </div>

    <button class="uk-button uk-button-default" type="submit">Invia</button>

</fieldset>
    <?php //mostro il risultato dell'invio del form 
    echo $this->session->flashdata('result'); ?>
</form>

</div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<!-- chiamate ajax -->
<script src="<?php echo base_url('assets/js/luoghi.js');?>"></script>
