<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- script x orologio -->
<script src="<?php echo base_url('assets/js/get_time.js');?>"></script> 
<div class="uk-width-1-6@m">   <!-- inizio colonna 1/6 -->

        <div class="uk-text-left"> <!-- orologio -->
            <span class="uk-margin-small-right" uk-icon="clock"></span> <!-- icona -->
            <span id="clock" class="uk-text-bold"></span>
        </div>

        <!-- Calendario - jsCalendar Default theme -->
        <div class="auto-jsCalendar" 
             data-month-format="month YYYY"
             data-language="it">
             
        </div>


</div> <!-- fine colonna -->