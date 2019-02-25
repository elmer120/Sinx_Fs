<div class="uk-grid-small" uk-grid> <!-- inizio griglia small gutter-->

    <div class="uk-width-1-2"> 
        <div class="uk-container uk-position-large uk-position-top-center">
            
            <div class="uk-card uk-card-default "> <!-- card -->
                
                <div class="uk-card-media-top">
                    <img class="uk-height-small uk-height-max-small uk-position-relative uk-position-bottom-center" src="<? echo base_url("assets/img/logo.png");?>" alt="Sinx"/>
                </div>

                <div class="uk-card-body">
                    <h3 class="uk-card-title uk-text-success">Operazione avvenuta con successo!<span uk-icon="icon: check; ratio: 2"></span></h3>
                    <p class="uk-text-center uk-text-primary">Aggiornamento e redirect in corso...</p>
                    <div class="uk-position-relative uk-position-bottom-center"><div uk-spinner></div></div>
                </div>

                <div class="uk-card-footer">
                    <p class="uk-text-meta">Se la pagina non dovesse eseguire il redirect, <?php echo anchor($previous_page, 'premi qui');?></p>
                </div>
                <script>
                   setTimeout(function(){ window.location.href = '<?php echo $previous_page; ?>';}, 3000);
                </script>
            </div>
            
        </div>
    </div>
</div> <!--fine griglia -->

</body>
</html>