<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Sinx</title>
        <!--carico semantic-ui e jquery-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/semantic.min.css');?>">
        <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
        <script src="<?php echo base_url('assets/semantic/semantic.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/luoghi.js');?>"></script>
        <script src="<?php echo base_url('assets/js/tipi.js');?>"></script>

</head>
<body>

<div class="ui inverted menu">
      <a href="#" class="header item">
        <img class="logo" src="<? echo site_url("assets/img/logo.png")?>"/>
        <div class="ui teal left pointing label">
          <?php echo lang('version');?>
        </div> 
      </a>
      
      <div class="item">
        <h5><?php  echo lang('presentation_sw'); ?> </h5>
      </div>
      
      <div class="item right">
      <a href="<? echo site_url("login/logout")?>">
      <button class="ui inverted red button">
      <i class="sign out icon"></i>
          <?php  echo lang('logout');?>
         
      </button>
      </a>
      </div>
</div>