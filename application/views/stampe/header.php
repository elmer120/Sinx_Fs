<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php $info=info_association();?>

        <div class="uk-card uk-card-small">
            <div class="uk-text-center uk-card-body">
            <img src="<? echo $info['logo'];?>" width="50" height="50"/>
            <strong class="uk-text-capitalize"><? echo $info['name'];?></strong><br>
            <? echo $info['address'].' - '.$info['cap'].' - '.$info['c_name'].', '.$info['p_name'];?> <br>
            <? echo 'Tel: '.$info['phone'].' - Fax: '.$info['fax'].' - E-mail: '.$info['email'];?> <br>
            <? echo 'Cf: '.$info['fiscal_code'].' - Pi: '.$info['fiscal_code'];?>
            </div>
        </div>
<hr>