<?php
$bdd = new PDO('mysql:host=localhost;dbname=visits_ip', 'root', '');

if (isset($_GET['e'])) {
    $page = htmlspecialchars($_GET['e']);
} else {
    $page = $_SERVER['SCRIPT_NAME'];
}
$jsonfileinsert = file_get_contents('http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR']);
$insertmbr3 = $bdd->prepare('INSERT INTO ip_list(ip, navigateur, date, json, page) VALUES(?, ?, UNIX_TIMESTAMP(), ?, ?)');
$insertmbr3->execute(array($_SERVER['REMOTE_ADDR'], $_SERVER["HTTP_USER_AGENT"], $jsonfileinsert, $page));
