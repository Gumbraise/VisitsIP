<?php
$bdd = new PDO('mysql:host=localhost;dbname=visits_ip', 'root', '');

$jsonfileinsert = file_get_contents('http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR']);
$insertmbr3 = $bdd->prepare('INSERT INTO ip_list(ip, navigateur, date, json) VALUES(?, ?, UNIX_TIMESTAMP(), ?)');
$insertmbr3->execute(array($_SERVER['REMOTE_ADDR'], $_SERVER["HTTP_USER_AGENT"], $jsonfileinsert));
