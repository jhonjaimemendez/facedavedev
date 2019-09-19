<?php
session_start();

include 'config.php';

$names = $_POST['names'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$birthdate = $_POST['year'] . '/' . $_POST['month'] . '/' . $_POST['day'];
$dateRegistration = date('Y/m/d H:i:s');
$profilePicture = "images/avatar.png";

try {
    $collectionUsers->insertOne([
        '_id' => $email,
        'password' => $password,
        'names' => $names,
        'surname' => $surname,
        'gender' => $gender,
        'birthdate' => $birthdate,
        'dateRegistration' => $dateRegistration,
        'profilePicture' => $profilePicture
    ]);

    $_SESSION['email'] = $email;
    $_SESSION['avatars'] = $profilePicture;
    $_SESSION['names'] = $names . ' ' . $surname;
    $_SESSION['memberyear'] = date('Y');
    $_SESSION['firstnames'] = $names;
    $_SESSION['surname'] = $surname;
    $_SESSION['gender'] = $gender;
    $_SESSION['birthdate'] = $birthdate;
    $_SESSION['password'] = $password;

    header('Location: wall.php');
} catch (Exception $e) {
    header('Location: messageError.php?messageError='.$e->getMessage());
   
    
}
?>