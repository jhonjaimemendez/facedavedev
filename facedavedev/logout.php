<?php
    
   
    session_unset();
    session_destroy();
    
    header('Refresh: 1; URL = index.php');
?>