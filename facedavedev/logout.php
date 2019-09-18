<?php
    
    /*unset($_SESSION['email']);
    unset($_SESSION['avatars']);
    unset($_SESSION['names']);
    unset($_SESSION['memberyear']);
    unset($_SESSION['firstnames'] );
    unset($_SESSION['surname'] );
    unset($_SESSION['gender'] );
    unset($_SESSION['birthdate']);
    unset( $_SESSION['password']  );
    unset($_SESSION['numFriend'] );
    unset($_SESSION['friends']);*/
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);

    
    header('Refresh: 1; URL = index.php');
?>