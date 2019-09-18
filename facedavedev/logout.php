<?php
    
   
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);

    
    header('Refresh: 1; URL = index.php');
?>