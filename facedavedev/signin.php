 <?php

include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (! empty($email) && ! empty($password)) {

    $users = $collectionUsers->find( [ '_id' => $email ] );
    foreach ($users as $doc) {
       
        echo $doc['names'];
        echo  $doc['dateRegistration'];
      
     
    }
    
   
    if (empty($users)) {

        echo 'Wrong username or password';
        //header('Location: index.php');
        
    } else {

        $_SESSION['email'] = $email;
      //  echo $users['names'];
       // $_SESSION['avatars'] = $user->$profilePicture;
        
        /*$_SESSION['names'] = $user->$names . ' ' . $user->$surname;
        $_SESSION['memberyear'] = $user->$dateRegistration;
        $_SESSION['publications'] = $user->$publications;
        
        
        header('Location: wall.php');*/
    }
}

?>
