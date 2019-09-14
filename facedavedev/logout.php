<?php
    
    unset($_SESSION['email']);
    unset($_SESSION['avatars']);
    unset($_SESSION['names']);
    unset($_SESSION['memberyear']);

    
    header('Refresh: 2; URL = index.php');
?>