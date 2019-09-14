<?php 

    require 'vendor/autoload.php';
    
    # Connection parameters to the mongodb database are defined
    $connection = new MongoDB\Client("mongodb://localhost:27017");  
    $dbname = $connection->facedave;
    $collectionUsers = $dbname->users; 
    $collection = $connection->facedave->users;
    
    
?>

 
