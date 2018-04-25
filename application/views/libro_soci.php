<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

    <div class="uk-section uk-section-muted"> <!-- sezione -->
        <div class="uk-container"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Libro Soci</span>
            </h3>

            <?php echo form_open_multipart ('Stampa/libro_soci','target="_blank"','class="uk-form-horizontal"');?>

            <fieldset class="uk-fieldset">

            <legend class="uk-legend">Associati</legend> <!-- titolo -->

            <label class="uk-form-label">Ordinamento</label>
            <div class="uk-form-controls uk-margin">
                    <label><input class="uk-radio" type="radio" name="ordinamento" checked> Per nome</label><br>
                    <label><input class="uk-radio" type="radio" name="ordinamento"> Per numero tessera</label>
            </div>
            <button class="uk-button uk-button-default" type="submit">Stampa</button>

            </fieldset>
            </form>

        </div> <!-- fine container -->

    </div> <!-- fine sezione -->

</div> <!--fine colonna -->