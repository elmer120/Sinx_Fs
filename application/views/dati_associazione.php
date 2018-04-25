<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

<div class="uk-section uk-section-muted"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Dati Associazione</span>
            </h3>


<?php echo form_open_multipart ('Anagrafica/create_associato','class="uk-form-horizontal"');
$info=info_association();
var_dump($info);
?>
    
    <fieldset class="uk-fieldset"> <!-- si occupa del padding nel form necessario per il form "orizzontali" -->

      <label class="uk-form-label">Name</label>
    <div class="uk-form-controls uk-margin">
      <input class="uk-input uk-form-width-medium" type="text" name="name" placeholder="First Name" value="<?echo $info['name'];?>"required>
      <?php echo form_error('name'); ?>
    </div>
  
    <div uk-form-custom>
      <input class="uk-input uk-form-width-medium" type="file" name="logo" placeholder="Logo..">
      <button type="button">Logo</button>
      <?php echo form_error('logo'); ?>
    </div>

      <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_regioni" required>
      <option value="">Regione...</option>
      <option value="<?php echo $info['r_id'];?>" selected><?php echo $info['r_name'];?></option>
      </select>
    </div>

    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_province" required>
      <option value="">Provincia</option>
      <option value="<?php echo $info['p_id'];?>" selected><?php echo $info['p_name'];?></option>
      </select>
    </div>

    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_comuni" name="fk_comune" required>
      <option value="">Comune</option>
      <option value="<?php echo $info['c_id'];?>" selected><?php echo $info['c_name'];?></option>
      </select>
    </div>

      <label class="uk-form-label">Via</label>
    <div class="uk-form-controls">
        <input class="uk-input uk-form-width-medium" class="uk-input" type="text" name="address" placeholder="Via Dante, 8" value="<?echo $info['address'];?>">
        <?php echo form_error('address'); ?>
    </div>
  
    <label class="uk-form-label">Telefono</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="phone" placeholder="3331234567" value="<?echo $info['phone'];?>">
      <?php echo form_error('phone'); ?>
    </div>
    
      <label class="uk-form-label">Fax</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="fax" placeholder="0462458135" value="<?echo $info['fax'];?>">
      <?php echo form_error('fax'); ?>
    </div>
  
    <label class="uk-form-label">Codice Fiscale</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="fiscal_code" placeholder="fiscal_code" value="<?echo $info['fiscal_code'];?>">
      <?php echo form_error('fiscal_code'); ?>
    </div>

    <label class="uk-form-label">email</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="email" placeholder="info@mail.it" value="<?echo $info['email'];?>">
      <?php echo form_error('email'); ?>
    </div>
  
      <label class="uk-form-label">pec</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="pec" placeholder="???" value="<?echo $info['pec'];?>">
      <?php echo form_error('pec'); ?>
    </div>
  
      <label class="uk-form-label">iban</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="iban" placeholder="????" value="<?echo $info['iban'];?>">
      <?php echo form_error('iban'); ?>
    </div>

    <label class="uk-form-label">bic</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="bic" placeholder="????" value="<?echo $info['bic'];?>">
      <?php echo form_error('bic'); ?>
    </div>
  
    <label class="uk-form-label">iscrizione (odv/aps)</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="iscrizione_odv_aps" placeholder="????" required value="<?echo $info['iscrizione_odv_aps'];?>">
      <?php echo form_error('iscrizione_odv_aps'); ?>
    </div>    
  
    <button class="uk-button uk-button-default" type="submit">Submit</button>
    </fieldset>
</form>

        </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<!-- passo array dati associazione a javascript -->
<script type="text/javascript">
    var array_dati_associazione = <?php echo json_encode($info); ?>;
</script>
<!-- chiamate ajax -->
<script src="<?php echo base_url('assets/js/luoghi.js');?>"></script>
<script src="<?php //echo base_url('assets/js/select.js');?>"></script>
