<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="ui grid container">
   <div class="row">
    <div class="three wide column"> 
    <div class="ui vertical menu">
        <a href="InsUtente.php" class="item"> <!--dati utente-->
            <div class="ui bullet list">
                <i class="user large outline icon"></i>
                <div class="item">  
                    <?php  ?><?php echo lang('utente') ?>
                </div>
                <div class="item">
                    <?php  ?><b><?php echo lang('livello') ?></b> 
                </div>
            </div>
        </a>
            
        <a href="dati_Associaz.php" class="item"> <!--dati associazione-->    
            <div class="ui bullet list">
                <i class="users large icon"></i>
                <div class="item">
                    <?php echo 'nome associazione'; ?>
                </div>
                <div class="item">
                    <sub> <?php echo 'indirizzo' ?>, <?php echo 'num' ?> - <?php echo 'cap' ?> <?php echo 'città' ?> - <?php echo 'prov' ?></sub>
                </div>
            </div>
        </a>
        <div class="ui dropdown item ">  <!--Associazione-->
            <?php echo lang('associazione'); ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
            <a class="item" href='./dati_Associaz.php' title="Per gestire l'Associazione"><span>A--- - <?php lang('dati_associazione'); ?></span></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('sito_web'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('web_mail'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('web_mail_pec'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('facebook'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('instagram'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('youtube'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola -<?php echo lang('twitter'); ?></a>
            <a class="item" target="_blank" href='<?php ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo lang('home_banking'); ?></a>
            </div>
        </div>

        <div class="ui dropdown item "> <!-- anagrafica -->
            <?php echo lang('anagrafica'); ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='<? echo site_url("anagrafica/associati")?>'>Axxx -<?php echo lang('associati'); ?></a>
                <a class="item" href='<? echo site_url("anagrafica/collaboratori")?>'>Axxx -<?php echo lang('altri'); ?></a>
                <a class="item" href='<? echo site_url("anagrafica/csv")?>'>Axxx -<?php echo lang('importa_csv'); ?></a>
                <a class="item" href='<? echo site_url("anagrafica/ricerca")?>'>Aox- -<?php echo lang('cerca'); ?></a>
                <a class="item" href='<? echo site_url("anagrafica/rubrica")?>'>Aola -<?php echo lang('rubrica'); ?></a>
                <a class="item" href='<? echo site_url("anagrafica/libro_soci")?>'>Aola -<?php echo lang('libro_soci'); ?></a>        
            </div>
        </div>

        <div class="ui dropdown item "> <!--contabilità-->
            <?php echo lang('contabilita'); ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./InsPrimanota.php'>Aoxx -<?php echo lang('prima_nota'); ?></a>
                <a class="item" href='./InsRicFisc.php'>Aoxx -<?php echo lang('ricevuta'); ?></a>
                <a class="item" href='./InsFattura.php'>Aoxx -<?php echo lang('fattura'); ?></a>
                <a class="item" href='./InsContoEconomico.php'>Aox- -<?php echo lang('conto_economico'); ?></a>
                <a class="item" href='./InsStatoPatrimoniale.php'>Aox- -<?php echo lang('stato_patrimoniale'); ?></a>
                <a class="item" href='./Rendiconto.php'>Aox- -<?php echo lang('rendiconto'); ?></a>
                <a class="item" href='./Nuovo_Anno_soc.php'>Axxx -<?php echo lang('nuovo_anno_sociale'); ?></a>        
            </div>
        </div>

        <div class="ui dropdown item "> <!--gestione-->
            <?php echo lang('gestione'); ?>         
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./CompModuli.php'>Aoxa -<?php echo lang('moduli'); ?></a>
                <a class="item" href='./Calendario2.php'>Aox- -<?php echo lang('calendario'); ?></a>
                <a class="item" href='./InsNotepad.php'>Ao-a - <?php echo lang('blocco_note'); ?></a>
                <a class="item" href='./Comp_email.php'>Aox- -<?php echo lang('e_mail');?></a>
                <a class="item" href='./InsUtente.php'>Aola -<?php echo lang('utenti'); ?></a>
                <a class="item" href='./Files.php'>Axx- -<?php echo lang('files_immagiini'); ?></a>
                <a class="item" href='./Log.php'>Axxx -<?php echo lang('log'); ?></a>
                <a class="item" href='./Rip_database.php'>Axxx - <?php lang('backup'); ?></a>        
            </div>
        </div>

        <div class="ui dropdown item "> <!--specifiche-->
            <?php  echo lang('specifiche'); ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./Scheda_regioni.php'>A-x- -Regioni Province e Comuni</a>
                <a class="item" href='./nclasse.php'>A-x- -<?php echo lang('funzioni_associati'); ?></a>
                <a class="item" href='./nmateria.php'>A-x- -<?php echo lang('tipologia_associati'); ?></a>
                <a class="item" href='./Licenza.php'>Aola -<? echo lang('licenza'); ?></a>        
            </div>
        </div>

        <a class="item" href='./Manuale.php'><?php echo lang('manuale'); ?></a>

        <a class="item"href='./logout.php'><?php echo lang('uscita'); ?></a>

    </div>
</div>
    <script>
    //Inizializzazione dropdown del menu
    $(document).ready(function(){
      $('.ui.dropdown')
          .dropdown();
      });
    </script>