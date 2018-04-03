<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

<div class="uk-section uk-section-muted"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Collaboratori</span>
            </h3>
<!-- 
name
surname
fiscal_code
address
phone
phone_ext
datebirth
email
avatar
create_date
fk_comune
fk_associato
fk_collaboratore

tb collaboratori id mansione note -->
<?php echo form_open_multipart ('Anagrafica/create_collaboratore','class="uk-form-horizontal"');?>

      <fieldset class="uk-fieldset">
        
      <label class="uk-form-label">Name</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="name" placeholder="First Name" required>
      <?php echo form_error('name'); ?>
    </div>
  
      <label class="uk-form-label">Surname</label>
    <div class="uk-form-controls">
        <input class="uk-input uk-form-width-medium" class="uk-input" type="text" name="surname" placeholder="Last Name">
        <?php echo form_error('surname'); ?>
    </div>
  
      <label class="uk-form-label">fiscal_code</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="fiscal_code" placeholder="fiscal_code">
      <?php echo form_error('fiscal_code'); ?>
    </div>
  
      <label class="uk-form-label">address</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="address" placeholder="address">
      <?php echo form_error('address'); ?>
    </div>
  
      <label class="uk-form-label">phone</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone" placeholder="phone">
      <?php echo form_error('phone'); ?>
    </div>
  
      <label class="uk-form-label">phone_ext</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone_ext" placeholder="phone_ext">
      <?php echo form_error('phone_ext'); ?>
    </div>
  
      <label class="uk-form-label">datebirth</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="date" name="datebirth" placeholder="datebirth">
      <?php echo form_error('datebirth'); ?>
    </div>
  
      <label class="uk-form-label">email</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="email" placeholder="email">
      <?php echo form_error('email'); ?>
    </div>

    <div uk-form-custom>
      <input class="uk-input uk-form-width-medium" type="file" name="avatar" placeholder="file..">
      <button type="button">File</button>
      <?php echo form_error('avatar'); ?>
    </div>
    
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_regioni" required>
      <option value="">*Regione...</option>
      </select>
    </div>

    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_province" required>
      <option value="">*Provincia</option>
      </select>
    </div>

    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_comuni" name="fk_comune" required>
      <option value="">*Comune</option>
      </select>
    </div>
  
      <label class="uk-form-label">mansione</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="mansione" placeholder="Mansione" required>
      <?php echo form_error('mansione'); ?>
    </div>

        <label class="uk-form-label">note...</label>
    <div class="uk-form-controls">
      <textarea class="uk-textarea uk-form-width-medium" name="note" rows="2" ></textarea>
      <?php echo form_error('note'); ?>
    </div>

    <button class="uk-button uk-button-default" type="submit">Submit</button>

</fieldset>
</form>

</div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<!-- chiamate ajax -->
<script src="<?php echo base_url('assets/js/luoghi.js');?>"></script>
<script src="<?php echo base_url('assets/js/tipi.js');?>"></script>