<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? //var_dump($lista); ?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

    <div class="uk-section"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Ricerca in anagrafica</span>
            </h3>

<div class="uk-margin">

    <?php echo form_open ('anagrafica/ricerca','class="uk-grid-small uk-grid-collapse" uk-grid');?>
            <!-- categorie -->   
            <div class="uk-form-controls">
            <?php //var_dump($pre_filter);?>
                <select name="pre_filter" class="uk-select uk-form-width-small">
                    <?php //ciclo per selezionare la option corretta
                    $options = array
                    (
                    array("Tutti",""),
                    array("Solo associati",'1'),
                    array("Solo collaboratori",'2')
                    ); 
                    $output = '';
                    for ($i=0; $i < count($options); $i++) { 
                        $output.="<option value='"
                                .$options[$i][1]."' "
                                .( $pre_filter == $options[$i][1] ? "selected" : "" )
                                .">"
                                .$options[$i][0]."</option>";
                    }
                    echo $output;
                    ?>
                </select>
            </div>
            <!-- casella di ricerca -->
            <div class="uk-form-custom uk-search uk-search-default">
                <a href="#" onclick='this.parentNode.parentNode.submit(); return false;' class="uk-search-icon-flip" uk-search-icon></a>
                <input class="uk-search-input" type="search" name="text_search" value="" placeholder="Cerca...">
            </div>
    </form>
 
                    <?php //se c'è una ricerca
                        if($this->session->has_userdata('text_search'))
			            {	
                            echo "<hr>";
                            echo "Testo ricercato: ".'<b>"'.$this->session->userdata('text_search').'"</b>';
                            //pulsante x reset ricerca
                            echo '<a href="'.site_url("anagrafica/ricerca?reset=1").'" class="uk-close-large uk-padding-small" type="button" uk-close></a>';
                            echo "<hr>";
                        }
                    ?>
                    
           
</div>

<div class="uk-overflow-auto"> <!-- x responsivita tabella -->
                <table class="uk-table uk-table-small uk-table-striped uk-table-hover uk-table-responsive uk-table-hover">

                <h3 class="uk-text-center"></h3>
            
                <thead>
                    <tr>
                            <th class="uk-width-auto">#</th>
                            <th class="uk-width-auto">Nome</th>
                            <th class="uk-width-auto">Cognome</th>
                            <th class="uk-width-auto">Tel</th>
                            <th class="uk-width-auto">Tel.Extra</th>
                            <th class="uk-width-auto">E-mail</th>
                            <th class="uk-width-auto">Indirizzo</th>
                            <th class="uk-width-auto">Comune</th>
                            <th class="uk-width-auto">Prov.</th>
                            <th class="uk-width-auto">Data di nascita</th>

                    </tr>
                </thead>
                
                <tbody class="uk-text-small">
                
                    <?php 
                    if(empty($lista)){echo "<b> Nessun risultato, prova ad utilizzare un termine più generico. </b>";}
                    $i=1;
                    foreach ($lista as $array): ?> 
                    <tr>
                            <?php  //per ogni riga
                            echo "<td>".$i++."</td>"; 
                            foreach ($array as $item):?>
                                <td><?php echo $item;?></td>
                            <?php endforeach;?>    
                    </tr>
                    <?php endforeach;?>
                </tbody>
                </table>
                
                <?php 
                echo $links ?>
            </div> <!-- x responsivita tabella -->


 </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->