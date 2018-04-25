<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--colonna menu mobile (mostrata < 960px)-->
<div class="uk-width-auto uk-hidden@m"> 
    <!-- icona hamburger per aperture menu mobile -->
    <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="" uk-toggle="target: #menu_mobile"></a>
    <div id="menu_mobile" uk-offcanvas>
        <div class="uk-offcanvas-bar">
            <!-- dati utente -->
        <? $user = unserialize($_SESSION['user']);?>
            <ul class="uk-list">
                <li>
                    <span uk-icon="user"></span>
                    <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $user['name'];?></span>
                </li>
                <li>
                    <span uk-icon="bolt"></span>
                    <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $user['level']; ?></span>
                </li>
            </ul>
            <ul class="uk-nav uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
            <li class="uk-parent">
                    <!--Associazione-->
                    <a href="#"> 
                        <span class="uk-margin-small-right" uk-icon="bookmark"></span> <!-- icona -->
                        <?php echo lang('associazione'); ?>
                    </a>
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='<? echo site_url("associazione/dati_associazione") ?>' title="Per gestire l'Associazione"><span>A--- -<? echo lang('dati_associazione'); ?></span></a></li>
                        </ul>
                </li>

                <li class="uk-parent"> 
                    <!-- anagrafica -->
                    <a href="#"><?php echo lang('anagrafica'); ?></a>
                    <ul class="uk-nav-sub">
                        <li><a class="item" href='<? echo site_url("anagrafica/associati") ?>'>Axxx -<?php echo lang('associati'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/collaboratori")?>'>Axxx -<?php echo lang('altri'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/csv")?>'>Axxx -<?php echo lang('importa_csv'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/ricerca")?>'>Aox- -<?php echo lang('cerca'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/rubrica")?>'>Aola -<?php echo lang('rubrica'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/libro_soci")?>'>Aola -<?php echo lang('libro_soci'); ?></a></li>     
                    </ul>
                </li>
                    

                <li class="uk-parent"> 
                <!--contabilità-->
                <a href="#"><?php echo lang('contabilita'); ?></a>
                    
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='./InsPrimanota.php'>Aoxx -<?php echo lang('prima_nota'); ?></a></li>
                            <li><a class="item" href='./InsRicFisc.php'>Aoxx -<?php echo lang('ricevuta'); ?></a></li>
                            <li><a class="item" href='./InsFattura.php'>Aoxx -<?php echo lang('fattura'); ?></a></li>
                            <li><a class="item" href='./InsContoEconomico.php'>Aox- -<?php echo lang('conto_economico'); ?></a></li>
                            <li><a class="item" href='./InsStatoPatrimoniale.php'>Aox- -<?php echo lang('stato_patrimoniale'); ?></a></li>
                            <li><a class="item" href='./Rendiconto.php'>Aox- -<?php echo lang('rendiconto'); ?></a></li>
                            <li><a class="item" href='./Nuovo_Anno_soc.php'>Axxx -<?php echo lang('nuovo_anno_sociale'); ?></a></li> 
                        </ul>
                    </li>
                    

                <li class="uk-parent"> 
                <!--gestione-->
                <a href="#"><?php echo lang('gestione'); ?></a>         
                        
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='./CompModuli.php'>Aoxa -<?php echo lang('moduli'); ?></a></li>
                            <li><a class="item" href='./Calendario2.php'>Aox- -<?php echo lang('calendario'); ?></a></li>
                            <li><a class="item" href='./InsNotepad.php'>Ao-a - <?php echo lang('blocco_note'); ?></a></li>
                            <li><a class="item" href='./Comp_email.php'>Aox- -<?php echo lang('e_mail');?></a></li>
                            <li><a class="item" href='./InsUtente.php'>Aola -<?php echo lang('utenti'); ?></a></li>
                            <li><a class="item" href='./Files.php'>Axx- -<?php echo lang('files_immagiini'); ?></a></li>
                            <li><a class="item" href='./Log.php'>Axxx -<?php echo lang('log'); ?></a></li>
                            <li><a class="item" href='./Rip_database.php'>Axxx - <?php lang('backup'); ?></a></li>        
                        </ul>
                </li>

                <li class="uk-parent"> 
                <!--specifiche-->
                <a href="#"><?php  echo lang('specifiche'); ?></a>
                        
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='./Scheda_regioni.php'>A-x- -Regioni Province e Comuni</a></li>
                            <li><a class="item" href='./nclasse.php'>A-x- -<?php echo lang('funzioni_associati'); ?></a></li>
                            <li><a class="item" href='./nmateria.php'>A-x- -<?php echo lang('tipologia_associati'); ?></a></li>
                            <li><a class="item" href='./Licenza.php'>Aola -<? echo lang('licenza'); ?></a></li>        
                        </ul>
                </li>

                <li><a class="item" href='./Manuale.php'><?php echo lang('manuale'); ?></a></li>

                <li><a class="item"href='./logout.php'><?php echo lang('uscita'); ?></a></li>
                
            </ul>
            <!--dati associazione-->    
            <?php $info=info_association();?>
                <ul class="uk-list">
                    <li>
                        <span uk-icon="info"></span>
                        <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $info['name'];?></span>
                    </li>
                    <li>
                        <span uk-icon="location"></span>
                        <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $info['address'].' - '.$info['cap'].' - '.$info['c_name'].' - '.$info['p_name'].' - '.$info['r_name']; ?></span>
                    </li>
                </ul>
        </div>
    </div>
</div>

<!--colonna menu desktop (mostrata > 960px)-->
<div class="uk-width-1-6@m uk-visible@m">   <!-- inizio colonna 1/6 -->
    <div class="uk-card uk-card-default uk-card-small uk-card-hover">
        <div class="uk-card-header">
            <!-- dati utente -->
            <? $user = unserialize($_SESSION['user']);?>
            <ul class="uk-list">
                <li>
                    <span uk-icon="user"></span>
                    <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $user['name'];?></span>
                </li>
                <li>
                    <span uk-icon="bolt"></span>
                    <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $user['level']; ?></span>
                </li>
            </ul>
        </div>
        <div class="uk-card-body uk-link-reset">
            <ul class="uk-nav uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
                <li class="uk-parent">
                    <!--Associazione-->
                    <a href="#"> 
                        <span class="uk-margin-small-right" uk-icon="bookmark"></span> <!-- icona -->
                        <?php echo lang('associazione'); ?>
                    </a>
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='<? echo site_url("associazione/dati_associazione") ?>' title="Per gestire l'Associazione"><span>A--- -<? echo lang('dati_associazione'); ?></span></a></li>
                        </ul>
                </li>

                <li class="uk-parent"> 
                    <!-- anagrafica -->
                    <a href="#">
                        <span class="uk-margin-small-right" uk-icon="users"></span> <!-- icona -->
                        <?php echo lang('anagrafica'); ?>
                    </a>
                    <ul class="uk-nav-sub">
                        <li><a class="item" href='<? echo site_url("anagrafica/associati")?>'>Axxx -<?php echo lang('associati'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/collaboratori")?>'>Axxx -<?php echo lang('altri'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/csv")?>'>Axxx -<?php echo lang('importa_csv'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/ricerca")?>'>Aox- -<?php echo lang('cerca'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/rubrica")?>'>Aola -<?php echo lang('rubrica'); ?></a></li>
                        <li><a class="item" href='<? echo site_url("anagrafica/libro_soci")?>'>Aola -<?php echo lang('libro_soci'); ?></a></li>     
                    </ul>
                </li>
                    

                <li class="uk-parent"> 
                <!--contabilità-->
                <a href="#">
                    <span class="uk-margin-small-right" uk-icon="album"></span> <!-- icona -->
                    <?php echo lang('contabilita'); ?>
                </a>
                    
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='./InsPrimanota.php'>Aoxx -<?php echo lang('prima_nota'); ?></a></li>
                            <li><a class="item" href='./InsRicFisc.php'>Aoxx -<?php echo lang('ricevuta'); ?></a></li>
                            <li><a class="item" href='./InsFattura.php'>Aoxx -<?php echo lang('fattura'); ?></a></li>
                            <li><a class="item" href='./InsContoEconomico.php'>Aox- -<?php echo lang('conto_economico'); ?></a></li>
                            <li><a class="item" href='./InsStatoPatrimoniale.php'>Aox- -<?php echo lang('stato_patrimoniale'); ?></a></li>
                            <li><a class="item" href='./Rendiconto.php'>Aox- -<?php echo lang('rendiconto'); ?></a></li>
                            <li><a class="item" href='./Nuovo_Anno_soc.php'>Axxx -<?php echo lang('nuovo_anno_sociale'); ?></a></li> 
                        </ul>
                    </li>
                    

                <li class="uk-parent"> 
                <!--gestione-->
                <a href="#">
                    <span class="uk-margin-small-right" uk-icon="cog"></span> <!-- icona -->
                    <?php echo lang('gestione'); ?>
                </a>         
                        
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='./CompModuli.php'>Aoxa -<?php echo lang('moduli'); ?></a></li>
                            <li><a class="item" href='./Calendario2.php'>Aox- -<?php echo lang('calendario'); ?></a></li>
                            <li><a class="item" href='./InsNotepad.php'>Ao-a - <?php echo lang('blocco_note'); ?></a></li>
                            <li><a class="item" href='./Comp_email.php'>Aox- -<?php echo lang('e_mail');?></a></li>
                            <li><a class="item" href='./InsUtente.php'>Aola -<?php echo lang('utenti'); ?></a></li>
                            <li><a class="item" href='./Files.php'>Axx- -<?php echo lang('files_immagiini'); ?></a></li>
                            <li><a class="item" href='./Log.php'>Axxx -<?php echo lang('log'); ?></a></li>
                            <li><a class="item" href='./Rip_database.php'>Axxx - <?php lang('backup'); ?></a></li>        
                        </ul>
                    </li>

                <li class="uk-parent"> 
                <!--specifiche-->
                <a href="#">
                    <span class="uk-margin-small-right" uk-icon="info"></span> <!-- icona -->
                    <?php  echo lang('specifiche'); ?>
                </a>
                        
                        <ul class="uk-nav-sub">
                            <li><a class="item" href='./Scheda_regioni.php'>A-x- -Regioni Province e Comuni</a></li>
                            <li><a class="item" href='./nclasse.php'>A-x- -<?php echo lang('funzioni_associati'); ?></a></li>
                            <li><a class="item" href='./nmateria.php'>A-x- -<?php echo lang('tipologia_associati'); ?></a></li>
                            <li><a class="item" href='./Licenza.php'>Aola -<? echo lang('licenza'); ?></a></li>        
                        </ul>
                    </li>

                    <li>
                        <a class="item" href='./Manuale.php'>
                        <span class="uk-margin-small-right" uk-icon="question"></span> <!-- icona -->
                        <?php echo lang('manuale'); ?>
                        </a>
                    </li>

                    <li>
                        <a class="item"href='./logout.php'>
                        <span class="uk-margin-small-right" uk-icon="sign-out"></span> <!-- icona -->
                        <?php echo lang('uscita'); ?>
                        </a>
                    </li>

            </ul>
        </div>
        <div class="uk-card-footer">
            <!--dati associazione-->
            <?php $info=info_association(); ?>
                <ul class="uk-list">
                    <li>
                        <span uk-icon="info"></span>
                        <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $info['name'];?></span>
                    </li>
                    <li>
                        <span uk-icon="location"></span>
                        <span class="uk-text-small uk-text-meta uk-text-capitalize"><? echo $info['address'].' - '.$info['cap'].' - '.$info['c_name'].' - '.$info['p_name']; ?></span>
                    </li>
                </ul>
            <!-- link rapidi ai siti attinenti all'associazione -->
            <?  $links=quick_links(); ?>
            <h6 class="uk-heading-line uk-text-center"><span>Link rapidi</span></h6>
            <ul class="uk-iconnav">
            <li uk-tooltip="title:<? echo lang('sito_web'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_website']))? $links['link_website'] : '' ?>" target="_blank" uk-icon="icon: world"></a></li>
            <li uk-tooltip="title:<? echo lang('web_mail'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_webmail'])) ? $links['link_webmail'] : '' ?>" target="_blank" uk-icon="icon: mail"></a></li>
            <li uk-tooltip="title:<? echo lang('web_mail_pec'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_webmail_pec'])) ? $links['link_webmail_pec'] : '' ?>" target="_blank" uk-icon="icon: mail"></a></li>
            <li uk-tooltip="title:<? echo lang('facebook'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_facebook'])) ? $links['link_facebook'] : '' ?>" target="_blank" uk-icon="icon: facebook"></a></li>
            <li uk-tooltip="title:<? echo lang('instagram'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_instagram'])) ? $links['link_instagram'] : '' ?>" target="_blank" uk-icon="icon: instagram"></a></li>
            <li uk-tooltip="title:<? echo lang('youtube'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_youtube'])) ? $links['link_youtube'] : '' ?>" target="_blank" uk-icon="icon: youtube"></a></li>
            <li uk-tooltip="title:<? echo lang('twitter'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_twitter'])) ? $links['link_twitter'] : '' ?>" target="_blank" uk-icon="icon: twitter"></a></li>
            <li uk-tooltip="title:<? echo lang('home_banking'); ?>; pos: bottom"><a href="<?php echo(isset($links['link_home_banking'])) ? $links['link_home_banking'] : "#" ?>" target="_blank" uk-icon="icon: home"></a></li>
            </ul>
        </div>
    </div>
<script>
/**
Rimuove l'attributo target dai link vuoti
Usata nei link rapidi del menu
 */
$(document).ready(function() {
    $("a[href='']").removeAttr('target');
});
</script>


</div> <!--fine colonna -->


