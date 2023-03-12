<?php
require_once '/var/www/clients/client31/web184/web/korondi/Model/Database.php';

$db = new Database();

if($_SERVER['REQUEST_METHOD'] === 'post'){
    $sql = $db->prepare('DELETE FROM '.$GLOBALS['prefix'].'savedLocations WHERE savedLocationId = ?');
    if($sql->bind_param('i', $_POST['id'])){
        $sql->execute();
        echo 'Done!';
    }
}