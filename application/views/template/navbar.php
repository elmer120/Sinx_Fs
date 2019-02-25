<div class="uk-grid-small" uk-grid> <!-- inizio griglia small gutter-->
  <div class="uk-width-1-1">         <!-- inizio colonna -->  

    <nav class="uk-background-primary" uk-navbar> <!-- navbar -->
        
				<div class="uk-navbar-left">
          <ul class="uk-navbar-nav">
            <li> <!-- logo -->
              <a href="<? echo site_url("index/index") ?>" class="uk-navbar-item uk-logo">
                <img class="" width="75" height="75" data-src="<? echo base_url("assets/img/logo.png"); ?>" alt="Sinx" uk-img>
              </a>
            </li>
            <li> <!-- versione -->
            <span class="uk-label uk-label-success uk-text-lowercase"> <?php echo lang('version'); ?></span>
            </li>
          </ul>
        </div>
        
				<div class="uk-navbar-center">
          <div class="uk-navbar-item">
            <!-- breve descrizione -->
                <div class="uk-light uk-text-small uk-visible@m"><?php echo lang('presentation_sw'); ?> </div>
          </div>
        </div>
        
				<div class="uk-navbar-right">
          <div class="uk-navbar-item"> <!-- logout -->
            <a uk-toggle="target: #logout" class="uk-button uk-button-secondary"><?php echo lang('logout'); ?></a>
          </div>
        </div>
        
				<!-- Finestra conferma logout-->
        <div id="logout" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Conferma logout</h2>
              <p>Sei sicuro di uscire dall'applicazione?</p>
              <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="<? echo site_url("login/logout") ?>" uk-toggle="target: #logout" class="uk-button uk-button-primary">Ok</a>
        </p>
        </div>
</div>
    </nav>
  </div> <!--fine colonna -->
