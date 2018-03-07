<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="ten wide column"> 

//tb persone id	name	surname	address	phone	phone_ext	datebirth	email	avatar	fk_comune	fk_associato	fk_collaboratore
//tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_cariche_direttivo
<?php echo form_open_multipart ('Anagrafica/create_associato','class="ui form"');?>
<form class="ui form">
  <div class="field">
    <label>Name</label>
    <input type="text" name="name" placeholder="First Name">
  </div>
  <div class="field">
    <label>Surname</label>
    <input type="text" name="surname" placeholder="Last Name">
  </div>
  <div class="field">
    <label>fiscal_code</label>
    <input type="text" name="fiscal_code" placeholder="fiscal_code">
  </div>
  <div class="field">
    <label>address</label>
    <input type="text" name="address" placeholder="address">
  </div>
  <div class="field">
    <label>phone</label>
    <input type="text" name="phone" placeholder="phone">
  </div>
  <div class="field">
    <label>phone_ext</label>
    <input type="text" name="phone_ext" placeholder="phone_ext">
  </div>
  <div class="field">
    <label>datebirth</label>
    <input type="date" name="datebirth" placeholder="datebirth">
  </div>
  <div class="field">
    <label>email</label>
    <input type="text" name="email" placeholder="email">
  </div>
  <div class="field">
    <div class="ui action input">
        <input type="file" name="avatar" placeholder="file..">
    </div>
    <div class="field">
        <select id="select_regioni" class="ui search dropdown">
        <option value="">Regione...</option>
        </select>
    </div>
    <div class="field">
        <select id="select_province" class="ui search dropdown">
        <option value="">Provincia</option>
        </select>
    </div>
    
    <div class="field">
        <select id="select_comuni" name="fk_comune" class="ui search dropdown">
        <option value="">Comune</option>
        </select>
    </div>
  </div>
  <div class="field">
    <label>n_card</label>
    <input type="text" name="n_card" placeholder="n_card">
  </div>
  <div class="field">
    <div class="ui toggle checkbox">
        <input name="privacy" type="hidden" value="0">
        <input name="privacy" type="checkbox" class="hidden" value="1">
      <label>privacy</label>
    </div>
  </div>
  <div class="field">
    <div class="ui toggle checkbox">
        <input name='active' type='hidden' value='0'>
        <input name="active" type="checkbox" class="hidden" value="1">
      <label>active</label>
    </div>
  </div>
  <div class="field">
    <label>note...</label>
    <textarea name="note" rows="2" style="margin-top: 0px; margin-bottom: 0px; height: 79px;"></textarea>
  </div>
  <button class="ui button" type="submit">Submit</button>
</form>
<script>
$('.ui.checkbox')
  .checkbox();
</script>