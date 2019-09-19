<?php

require('config.php');

session_start();

if (isset($_POST['post'])) {

    $publication = $_POST['publication'];
    $dateRegistration = date('Y/m/d H:i:s');
    $alea = substr(strtoupper(md5(microtime(true))), 0, 12);
    $type = 'jpg';
    $rfoto = $_FILES['picture']['tmp_name'];

    if (is_uploaded_file($rfoto)) {

        $name = $_SESSION['email'] . $alea . "." . $type;
        $destino = "images/" . $name;
        copy($rfoto, $destino);
    } else {

        $destino = '';
    }

    $idGenerate = new MongoDB\BSON\ObjectId();

    $updateResult = $collectionUsers->updateOne([
        '_id' => $_SESSION['email']
    ], [
        '$push' => [
            'publications' => [
                '_id' => $idGenerate,
                'text' => $publication,
                'multimediaurl' => $destino,
                'coments' => '',
                'likes' => '0',
                'nolikes' => '0',
                'datePublication' => date('Y/m/d H:i:s'),
                'typepublication' => 'post'
            ]
        ]
    ]);
}

unset($_POST['post']);
header('Location: wall.php');

?>            