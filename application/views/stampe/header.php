<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php //var_dump($_SESSION['association'])?>

        <div class="uk-card uk-card-small">
            <div class="uk-text-center uk-card-body">
            <img class="uk-border-circle" width="50" height="50" src="<?php echo base_url('assets/img/associazione/logo/').$_SESSION['association']['logo'];?>">
            <strong class="uk-text-capitalize"><? echo $_SESSION['association']['nome'];?></strong><br>
            <? echo $_SESSION['association']['indirizzo'].' - '.$_SESSION['association']['cap'].' - '.$_SESSION['association']['c_nome'].', '.$_SESSION['association']['p_nome'];?> <br>
            <? echo 'Tel: '.$_SESSION['association']['telefono'].' - E-mail: '.$_SESSION['association']['email'];?> <br>
            <? echo 'Cf: '.$_SESSION['association']['codice_fiscale'].' - Pi: '.$_SESSION['association']['partita_iva'];?>
            </div>
        </div>
<hr>
