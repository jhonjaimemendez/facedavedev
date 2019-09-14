 <?php

 session_start();
 
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (! empty($email) && ! empty($password)) {

    $users = $collectionUsers->find( [ '_id' => $email ] );
    echo 'names';
    foreach ($users as $doc) {
        
        $_SESSION['email'] = $email;
        $_SESSION['names'] = $doc['names'];
        $_SESSION['memberyear'] = $doc['dateRegistration'];
        $_SESSION['publications'] = $doc['publications']->count();
        
       /*foreach ($doc['publications'] as $key => $value) {
           echo $value;
        }
         */
        
    }
    
    
   
    if (empty($users)) {

        echo 'Wrong username or password';
        header('Location: index.php');
        
        
    } else {

        header('Location: wall.php');
        
    }
}

?>
