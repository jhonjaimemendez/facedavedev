<?php
    
    unset($_SESSION['email']);
    unset($_SESSION['avatars']);
    unset($_SESSION['names']);
    unset($_SESSION['memberyear']);
    unset($_SESSION['publications']);

    
    header('Refresh: 2; URL = index.php');
?>