<?php
   
   session_start();
   session_unset(); 
   $_SESSION = array();
   session_destroy();

   header('Location: http://localhost:8080/vega-restaurant-admin/index.php');
?>