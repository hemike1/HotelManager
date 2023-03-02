<?php

require_once '/var/www/clients/client31/web184/web/korondi/Model/Database.php';

$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iconId'])) {
	$sql = $db->prepare('SELECT featureIcon FROM ' . $GLOBALS['prefix'] . 'features WHERE featureId = ?');
	if ($sql->bind_param('i', $_POST['iconId'])) {
		$sql->execute();
		if ($result = $sql->get_result()) {
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				echo $row['featureIcon'];
			}
		}
	}
}