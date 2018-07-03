<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<? //var_dump($lista); ?>

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

    <div class="uk-section"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Ricerca in anagrafica</span>
            </h3>

<div class="uk-margin">
    <form class="uk-search uk-search-default">
        <a href="" class="uk-search-icon-flip" uk-search-icon></a>
        <input class="uk-search-input" type="search" placeholder="Search...">
    </form>
</div>

<div class="uk-overflow-auto"> <!-- x responsivita tabella -->
                <table class="uk-table uk-table-small uk-table-striped uk-table-hover uk-table-responsive">

                <h3  class="uk-text-center"></h3>
            
                <thead>
                    <tr>
                            <th class="uk-table-shrink">Nome</th>
                            <th class="uk-table-shrink">Cognome</th>
                            <th class="uk-table-shrink">Tel</th>
                            <th class="uk-table-shrink">Tel.Extra</th>
                            <th class="uk-table-shrink">E-mail</th>
                            <th class="uk-table-shrink">Indirizzo</th>
                            <th class="uk-table-shrink">Comune</th>
                            <th class="uk-table-shrink">Prov.</th>
                            <th class="uk-table-shrink">Data di nascita</th>

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
            </div> <!-- x responsivita tabella -->


 </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->