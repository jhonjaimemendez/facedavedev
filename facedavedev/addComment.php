<?php
require('config.php');


$user = $_POST['user'];
$comment = $_POST['comment'];
$publication = $_POST['publication'];
$avatar = $_POST['avatar'];

$idGenerate = new MongoDB\BSON\ObjectId();


$updateResult = $collectionUsers->updateOne(
    ['_id' => $user], [
    '$push' => 
            ['comments' => 
        
                [   '_id' => $idGenerate,
                    'publication' => $publication,
                    'user' => $user,
                    'text' => $comment,
                    'avatar' => $avatar,
                    'datePublish' => date('Y/m/d H:i:s')
                ]
            
     
     ]
]);

?>