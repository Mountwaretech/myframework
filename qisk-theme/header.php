<?php
    global $base_url,$qisk_db;
?>
<!DOCTYPE html>
<html>
   <head>
   <?php get_qisk_front_files("Dashboard","Dashboard  Page"); ?>
   </head>
   <body>
<div id="wrapper">
     <?php _top_header(); ?>
         <div class="left side-menu">
            <?php menu_dataset();?>
         </div>