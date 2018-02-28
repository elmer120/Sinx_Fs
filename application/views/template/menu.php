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
                    <?php echo $Lutente ?><?php echo $nutente ?>
                </div>
                <div class="item">
                    <?php echo $Llivello ?><b><?php echo $user ?></b> 
                </div>
            </div>
        </a>
            
        <a href="dati_Associaz.php" class="item"> <!--dati associazione-->    
            <div class="ui bullet list">
                <i class="users large icon"></i>
                <div class="item">
                    <?php echo $row['nome'] ?>
                </div>
                <div class="item">
                    <sub> <?php echo $row['indirizzo'] ?>, <?php echo $row['numero'] ?> - <?php echo $row['cap'] ?> <?php echo $row['citta'] ?> - <?php echo $row['provincia']?></sub>
                </div>
            </div>
        </a>
        <div class="ui dropdown item ">  <!--Associazione-->
            <?php echo $Lassociazione; ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
            <a class="item" href='./dati_Associaz.php' title="Per gestire l'Associazione"><span>A--- - <?php echo $Ldatiassociazione; ?></span></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['sito'])) ? $row['sito'] : "dati_Associaz.php"?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $Lsito; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['webmail']))? $row['webmail'] : "dati_Associaz.php"?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $Lmail; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['webPEC']))? $row['webPEC'] : "dati_Associaz.php"?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $Lmailpec; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['facebook']))? $row['facebook'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $Lfacebook; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['instagram']))? $row['instagram'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $Linstagram; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['youtube']))? $row['youtube'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $Lyoutube; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['twitter']))? $row['twitter'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser">Aola -<?php echo $Ltwitter; ?></a>
            <a class="item" target="_blank" href='<?php echo(isset($row['HomeBanking']))? $row['HomeBanking'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser">Aola - <?php echo $LHomeBanking; ?></a>
            </div>
        </div>

        <div class="ui dropdown item "> <!-- anagrafica -->
            <?php echo $Lanagrafica; ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./InsAnagrStud.php'>Axxx -<?php echo $Lfondatori; ?></a>
                <a class="item" href='./InsAnagrIns.php'>Axxx -<?php echo $Lassociati; ?></a>
                <a class="item" href='./InsAnagrExtra.php'>Axxx -<?php echo $Laltri; ?></a>
                <a class="item" href='./InsAnagrFile.php'>Axxx -<?php echo $Limporta; ?></a>
                <a class="item" href='./ricerca.php'>Aox- -<?php echo $Lcerca; ?></a>
                <a class="item" href='./Rubrica.php'>Aola -<?php echo $Lrubrica; ?></a>
                <a class="item" href='./pre_stampa_soci.php'>Aola -<?php echo $Llibrosoci; ?></a>        
            </div>
        </div>

        <div class="ui dropdown item "> <!--contabilità-->
            <?php echo $Lcontabilita; ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./InsPrimanota.php'>Aoxx -<?php echo $Lprimanota; ?></a>
                <a class="item" href='./InsRicFisc.php'>Aoxx -<?php echo $Lquietanza; ?></a>
                <a class="item" href='./InsFattura.php'>Aoxx -<?php echo $Lfattura; ?></a>
                <a class="item" href='./InsContoEconomico.php'>Aox- -<?php echo $Lcontoec; ?></a>
                <a class="item" href='./InsStatoPatrimoniale.php'>Aox- -<?php echo $Lstatopat; ?></a>
                <a class="item" href='./Rendiconto.php'>Aox- -<?php echo $Lrendiconto; ?></a>
                <a class="item" href='./Nuovo_Anno_soc.php'>Axxx -<?php echo $Lnuovoannosociale; ?></a>        
            </div>
        </div>

        <div class="ui dropdown item "> <!--gestione-->
            <?php echo $Lgestione; ?>         
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./CompModuli.php'>Aoxa -<?php echo $Lmoduli; ?></a>
                <a class="item" href='./Calendario2.php'>Aox- -<?php echo $Lcalendario; ?></a>
                <a class="item" href='./InsNotepad.php'>Ao-a - <?php echo $Lblocconote; ?></a>
                <a class="item" href='./Comp_email.php'>Aox- - E-Mail</a>
                <a class="item" href='./InsUtente.php'>Aola -<?php echo $Lutenti; ?></a>
                <a class="item" href='./Files.php'>Axx- -<?php echo $Lfileseimmagini; ?></a>
                <a class="item" href='./Log.php'>Axxx -<?php echo $Llog; ?></a>
                <a class="item" href='./Rip_database.php'>Axxx - Backup</a>        
            </div>
        </div>

        <div class="ui dropdown item "> <!--specifiche-->
            <?php  echo $Lspecifiche; ?>
            <i class="dropdown icon"></i>  
            <div class="menu">
                <a class="item" href='./Scheda_regioni.php'>A-x- -Regioni Province e Comuni</a>
                <a class="item" href='./nclasse.php'>A-x- -<?php echo $Lfunzioniassociati; ?></a>
                <a class="item" href='./nmateria.php'>A-x- -php echo $Ltipoassociati; ?></a>
                <a class="item" href='./Licenza.php'>Aola -<? echo $Llicenza; ?></a>        
            </div>
        </div>

        <a class="item" href='./Manuale.php'><?php echo $Lmanuale; ?></a>

        <a class="item"href='./logout.php'><?php echo $Luscita; ?></a>

    </div>