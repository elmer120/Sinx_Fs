<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

    <div class="uk-section uk-section-muted"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Rubrica</span>
            </h3>

            <table class="uk-table uk-table-small uk-table-striped">

            <h3  class="uk-text-center">Libro Soci</h3>
           
            <thead>
                <tr>
                        <th class="uk-table-shrink">Codice Tessera</th>
                        <th class="uk-table-shrink">Nome</th>
                        <th class="uk-table-shrink">Cognome</th>
                        <th class="uk-table-shrink">Data nascita</th>
                        <th class="uk-table-shrink">Regione</th>
                        <th class="uk-table-shrink">Provincia</th>
                        <th class="uk-table-shrink">Comune</th>
                        <th class="uk-table-shrink">Cap</th>
                        <th class="uk-table-shrink">Indirizzo</th>
                        <th class="uk-table-shrink">Codice fiscale</th>
                        <th class="uk-table-shrink">Tipo associato</th>
                        <th class="uk-table-shrink">Carica direttivo</th>              
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($lista as $array):?>
                <tr>
                        <?php //foreach ($array as $item):?>
                            <td><?php //echo $item;?></td>
                        <?php //endforeach;?>    
                </tr>
                <?php //endforeach;?>
            </tbody>
            </table>

        </div> <!-- fine container -->

    </div> <!-- fine sezione -->

</div> <!--fine colonna -->