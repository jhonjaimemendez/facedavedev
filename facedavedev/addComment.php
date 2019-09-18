<?php
require('config.php');

$user = mysql_real_escape_string($_POST['user']);
$comment = mysql_real_escape_string($_POST['comment']);
$publication = mysql_real_escape_string($_POST['publication']);


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