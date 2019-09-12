 <?php
session_start();
// include 'config.php';

if (! isset($_SESSION['email'])) {

    header("Location: login.php");
}

$email = $_POST['email'];
$password = $_POST['password'];

if (! empty($email) && ! empty($password)) {

    $where = array(
        '$and' => array(
            array(
                '_id' => $email
            ),
            array(
                'password' => $password
            )
        )
    );
    
    $user = $collectionUsers->find($where);

    if (empty($user)) {

        echo 'Wrong username or password';
    } else {

        $_SESSION['email'] = $email;
        header('Location: wall.php');
    }
}

?>
