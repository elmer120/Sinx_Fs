<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sinx</title>
        <!--carico uikit.css e jquery--> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/uikit/css/uikit.min.css');?>" />
        <script src="<?php echo base_url('assets/uikit/js/uikit.min.js');?>"></script>
        <script src="<?php echo base_url('assets/uikit/js/uikit-icons.min.js');?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
        <!-- jsCalendar style -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/jsCalendar/source/jsCalendar.css');?>">
        <!-- jsCalendar script -->
        <script type="text/javascript" src="<?php echo base_url('assets/jsCalendar/source/jsCalendar.js');?>"></script>
        <!-- jsCalendar Italian language -->
        <script type="text/javascript" src="<?php echo base_url('assets/jsCalendar/source/jsCalendar.lang.it.js');?>"></script>
        <!-- variabili globali javascript -->
        <script> <?php echo "controller_url='".site_url($this->uri->segment(1).'/')."';";?> </script>
				<!-- tabulator -->
				<script type="text/javascript" src="<?php echo base_url('assets/tabulator/ext/moments.min.js');?>"></script> <!-- estensione per date --> 
				<script type="text/javascript" src="<?php echo base_url('assets/tabulator/tabulator.min.js');?>"></script>
				<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tabulator/tabulator_semantic-ui.css');?>"> <!-- tema -->
</head>
<body>
