<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->
<?php echo_breadcrumbs($breadcrumbs)?>
    <div class="uk-section uk-section-muted uk-padding-small"> <!-- sezione -->
	<div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->

            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                <span>Libro Soci</span>
            </h3>

			<pre>												
																Art. 15 
														Libri sociali obbligatori
														
			1. Oltre le scritture prescritte negli articoli 13, 14 e 17, comma 1, gli enti del Terzo settore devono tenere: 
				a) il libro degli associati o aderenti; 
				b) il libro delle adunanze e delle deliberazioni delle assemblee, in cui devono essere trascritti anche i verbali redatti per atto pubblico; 
				c) il libro delle adunanze e delle deliberazioni dell'organo di amministrazione, dell'organo di controllo, e di eventuali altri organi sociali. 
			2. I libri di cui alle lettere a) e b) del comma 1, sono tenuti a cura dell'organo di amministrazione. 
				I libri di cui alla lettera c) del comma 1, sono tenuti a cura dell'organo cui si riferiscono. 
			3. Gli associati o gli aderenti hanno diritto di esaminare i libri sociali, secondo le modalita' previste dall'atto costitutivo o dallo statuto. 
			4. Il comma 3 non si applica agli enti di cui all'articolo 4, comma 3.</pre>

            <?php echo form_open_multipart ('Stampa/libro_soci','target="_blank"','class="uk-form-horizontal"');?>

            <fieldset class="uk-fieldset">

            <legend class="uk-legend">Associati</legend> <!-- titolo -->

            <label class="uk-form-label">Ordinamento</label>
            <div class="uk-form-controls uk-margin">
                    <label><input class="uk-radio" type="radio" name="ordinamento" value="persone.nome" checked> Per nome</label><br>
                    <label><input class="uk-radio" type="radio" name="ordinamento" value="tessere.numero"> Per numero tessera</label>
            </div>
            <button class="uk-button uk-button-default" type="submit">Stampa</button>

            </fieldset>
            </form>

        </div> <!-- fine container -->

    </div> <!-- fine sezione -->

</div> <!--fine colonna -->
