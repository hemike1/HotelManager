<?php
require_once '/var/www/clients/client31/web184/web/korondi/Model/Database.php';

$db = new Database();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['billId'])){
    $sql = $db->prepare('SELECT * FROM '.$GLOBALS['prefix'].'savedLocations WHERE savedLocationId = ?');
    if($sql->bind_param('i', $_POST['billId'])){
        $sql->execute();
        if($result = $sql->get_result()){
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $response['cityId'] = $row['savedLocationCityId'];
                $response['street'] = $row['savedLocationStrName'];
                $response['houseNum'] = $row['savedLocationHouseNum'];
                print_r(json_encode($response));
            }
        }
    }
}