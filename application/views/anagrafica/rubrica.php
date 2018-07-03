<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? //var_dump($lista); ?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

    <div class="uk-section"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Rubrica</span>
            </h3>

            <div class="uk-overflow-auto"> <!-- x responsivita tabella -->
                <table class="uk-table uk-table-small uk-table-justify uk-table-divider uk-table-striped">
<!-- uk-table-hover uk-table-responsive -->
                <h3  class="uk-text-center"></h3>
            
                <thead>
                    <tr>
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
                    <?php foreach ($lista as $array):?>
                    <tr>
                            <?php foreach ($array as $item):?>
                                <td><?php echo $item;?></td>
                            <?php endforeach;?>    
                    </tr>
                    <?php endforeach;?>
                </tbody>
                </table>
                <?php echo $links ?>
            </div> <!-- x responsivita tabella -->

        </div> <!-- fine container -->

    </div> <!-- fine sezione -->

</div> <!--fine colonna -->