<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- script x orologio -->
<script src="<?php echo base_url('assets/js/get_time.js');?>"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/calendario.css');?>">
<div class="uk-width-1-6@m">   <!-- inizio colonna 1/6 -->
	<div class="uk-inline">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
			<div class="uk-position-relative uk-position-top-center uk-box-shadow-medium"> <!-- orologio -->
				<span class="uk-margin-small-right" uk-icon="clock"  style="font-family: 'Orbitron', sans-serif;"></span> <!-- icona -->
				<span id="clock" class="uk-text-bold"></span>
			</div>
			<!-- Wrapper -->
			<div class="uk-position-relative" id="wrapper">
				<!-- elementi del calendario -->
				<div id="events-calendar"></div>
				<!-- appuntamenti -->
				<div id="events"></div>
				<!-- Clear -->
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<script src="<?php echo base_url('assets/js/calendario.js');?>"></script> 
	</div>

</div> <!-- fine colonna -->



