<?php
    
    unset($_SESSION['email']);
    unset($_SESSION['avatars']);
    unset($_SESSION['names']);
    unset($_SESSION['memberyear']);
    unset($_SESSION['firstnames'] );
    unset($_SESSION['surname'] );
    unset($_SESSION['gender'] );
    unset($_SESSION['birthdate']);
    unset( $_SESSION['password']  );
    unset($_SESSION['numFriend'] );

    
    header('Refresh: 1; URL = index.php');
?>