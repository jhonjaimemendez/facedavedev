 <?php

 session_start();
 
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (! empty($email) && ! empty($password)) {

    $users = $collectionUsers->find([ '_id' => $email,'password' => $password ] );
    
    foreach ($users as $doc) {
     
        $_SESSION['email'] = $email;
        $_SESSION['names'] = $doc['names'].' '. $doc['surname'];
        $_SESSION['firstnames'] = $doc['names'];
        $_SESSION['surname'] = $doc['surname'];
        $_SESSION['gender'] = $doc['gender'];
        $_SESSION['birthdate'] = $doc['birthdate'];
        $_SESSION['password']  = $doc['password'];
        $_SESSION['avatars'] = $doc['profilePicture'];
        $_SESSION['memberyear'] = $doc['dateRegistration'];
        $_SESSION['numFriends'] = '0';
        
        if ($doc['friends']) {
        
            $_SESSION['numFriends'] = $doc['friends']->count();
            
        }
        
        
        
        
    }
    
    
   
    if (empty($users)) {

        echo 'Wrong username or password';
        header('Location: index.php');
        
        
    } else {

        header('Location: wall.php');
        header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
    }
}

?>
