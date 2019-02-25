<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->
<?php echo_breadcrumbs($breadcrumbs)?>
<div class="uk-section uk-section-muted uk-padding-small"> <!-- sezione -->
<div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Link rapidi</span>
            </h3>


<?php echo form_open_multipart ('gestione/update_link_rapidi','class="uk-form-horizontal"');
$links=quick_links();
//pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$"-->        
?>


<fieldset class="uk-fieldset"> <!-- si occupa del padding nel form necessario per il form "orizzontali" -->

<label class="uk-form-label"><?php echo lang('sito_web'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
        <span class="uk-form-icon" uk-icon="icon: world"></span>
        <input class="uk-input uk-form-width-large" class="uk-input" type="text" name="link_website"  
            placeholder="https://www.associazione.it" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_website'];?>"
        >
        <?php echo form_error('link_website'); ?>
        </div>
      </div>
    </div>
  
<label class="uk-form-label"><?php echo lang('web_mail'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: mail"></span>
        <input class="uk-input uk-form-width-large" type="text" name="link_webmail" 
          placeholder="https://www.webmail.it" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_webmail'];?>"
          >
      <?php echo form_error('web_mail'); ?>
        </div>
      </div>
    </div>

<label class="uk-form-label"><?php echo lang('web_mail_pec'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: mail"></span>
          <input class="uk-input uk-form-width-large" type="text" name="link_webmail_pec" 
          placeholder="https://www.webmail.pec.it" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_webmail_pec'];?>"
          >
      <?php echo form_error('web_mail_pec'); ?>
      </div>
      </div>
    </div>
    
<label class="uk-form-label"><?php echo lang('facebook'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: facebook"></span>
          <input class="uk-input uk-form-width-large" type="text" name="link_facebook" 
          placeholder="https://www.facebook.com/associazione" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_facebook'];?>"
          >
      <?php echo form_error('facebook'); ?>
        </div>
      </div>
    </div>
  
<label class="uk-form-label"><?php echo lang('instagram'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: instagram"></span>
          <input class="uk-input uk-form-width-large" type="text" name="link_instagram" 
          placeholder="https://www.instagram.com/" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_instagram'];?>"
          >
      <?php echo form_error('instagram'); ?>
        </div>
      </div>
    </div>

<label class="uk-form-label"><?php echo lang('youtube'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: youtube"></span>
          <input class="uk-input uk-form-width-large" type="text" name="link_youtube" 
          placeholder="https://www.youtube.com/associazione" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_youtube'];?>"
          >
      <?php echo form_error('youtube'); ?>
        </div>
      </div>
    </div>
  
<label class="uk-form-label"><?php echo lang('twitter'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: twitter"></span>
          <input class="uk-input uk-form-width-large" type="text" name="link_twitter" 
          placeholder="https://twitter.com/associazione" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_twitter'];?>"
          >
      <?php echo form_error('twitter'); ?>
        </div>
      </div>
    </div>
  
<label class="uk-form-label"><?php echo lang('home_banking'); ?></label>
    <div class="uk-form-controls">
      <div class="uk-margin">
        <div class="uk-inline">
          <span class="uk-form-icon" uk-icon="icon: home"></span>
          <input class="uk-input uk-form-width-large" type="text" name="link_home_banking" 
          placeholder="https://www.inbank.it" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-ZäöüÄÖÜ0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$" value="<? echo $links['link_home_banking']?>"
          >
      <?php echo form_error('home_banking'); ?>
        </div>
      </div>
    </div>

    <button class="uk-button uk-button-default" type="submit" onclick="set_enable()">Invia</button>
    </fieldset>
    <?php //mostro il risultato dell'invio del form 
    echo $this->session->flashdata('result'); ?>
</form>

        </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->


