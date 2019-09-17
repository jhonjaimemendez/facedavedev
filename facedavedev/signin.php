 <?php

 session_start();
 
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (! empty($email) && ! empty($password)) {

    $users = $collectionUsers->find( [ '_id' => $email,'password' => $password ] );
    $friends = array();
     
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
        $_SESSION['numFriend'] = $doc['friends']->count();
     
        foreach($doc['friends'] as $key => $value) {
            
            $friends[$key] = array($value['user'],$value['gender']);
                
        }
        
        $_SESSION['friends'] = $friends;
        
    }
    
    
   
    if (empty($users)) {

        echo 'Wrong username or password';
        header('Location: index.php');
        
        
    } else {

        header('Location: wall.php');
        
    }
}

?>
