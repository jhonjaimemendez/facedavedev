<?php
require('config.php');

$user = $_POST['user'];
$comment = $_POST['comment'];
$publication = $_POST['publication'];


$updateResult = $collectionUsers->updateOne(
    ['_id' => $user,'publications._id' => $publication], [
    '$push' => [
        'publications' => [
            'comments' [
        
                [
                    'user' => $user,
                    'text' => $comment,
                    'text' => date('Y/m/d H:i:s')
                ]
            ]
      ]
     ]
]);

?>