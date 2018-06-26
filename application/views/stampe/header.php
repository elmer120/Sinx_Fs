<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php //var_dump($_SESSION['association'])?>

        <div class="uk-card uk-card-small">
            <div class="uk-text-center uk-card-body">
            <img class="uk-border-circle" width="50" height="50" src="<?php echo base_url('assets/img/associazione/logo/').$_SESSION['association']['logo'];?>">
            <strong class="uk-text-capitalize"><? echo $_SESSION['association']['name'];?></strong><br>
            <? echo $_SESSION['association']['address'].' - '.$_SESSION['association']['cap'].' - '.$_SESSION['association']['c_name'].', '.$_SESSION['association']['p_name'];?> <br>
            <? echo 'Tel: '.$_SESSION['association']['phone'].' - Fax: '.$_SESSION['association']['fax'].' - E-mail: '.$_SESSION['association']['email'];?> <br>
            <? echo 'Cf: '.$_SESSION['association']['fiscal_code'].' - Pi: '.$_SESSION['association']['fiscal_code'];?>
            </div>
        </div>
<hr>