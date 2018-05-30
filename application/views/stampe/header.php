<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php $info=info_association();?>

        <div class="uk-card uk-card-small">
            <div class="uk-text-center uk-card-body">
            <img class="uk-border-circle" width="50" height="50" src="<?php echo base_url('assets/img/associazione/logo/').$info['logo'];?>">
            <strong class="uk-text-capitalize"><? echo $info['name'];?></strong><br>
            <? echo $info['address'].' - '.$info['cap'].' - '.$info['c_name'].', '.$info['p_name'];?> <br>
            <? echo 'Tel: '.$info['phone'].' - Fax: '.$info['fax'].' - E-mail: '.$info['email'];?> <br>
            <? echo 'Cf: '.$info['fiscal_code'].' - Pi: '.$info['fiscal_code'];?>
            </div>
        </div>
<hr>