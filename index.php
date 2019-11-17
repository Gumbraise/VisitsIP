<?php
echo
'<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .col-sm-3 {
            display: block;
            float: left;
            text-align: center;
            padding-top: 30px
        }
        body, html {
            background: #000;
            color: #00a700;
            padding-bottom: 30px
        }
        .card-header, .card-footer {
            background: #080808
        }
        .card-body {
            background: #000
        }
        .card {
            background: #202020;
        }
        .btn {
            background-color: #00a700;
            border: none;
        }
        .btn:hover {
            background-color: #006200;
        }
    </style>
</head>
';
$bdd = new PDO('mysql:host=localhost;dbname=visits_ip', 'root', '');
$reqabcd = $bdd->query("SELECT * FROM ip_list ORDER BY date DESC");
if(isset($_GET['id'])) {
    $deleteIP = $bdd->prepare("DELETE FROM ip_list WHERE id = ?");
    $deleteIP->execute(array($_GET['id']));
}
while($donneesaa = $reqabcd->fetch()) {
    $jsonfile = file_get_contents('http://ip-api.com/json/'.$donneesaa['ip']);
    $json = json_decode($jsonfile);
echo '

<div class="col-sm-3">
    <div class="card">
        <div class="card-header">'. date('d/m/Y H:i:s', $donneesaa['date']) .'</div>
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo'. $donneesaa['id'] .'">Debug</button>
            <div id="demo'. $donneesaa['id'] .'" class="collapse">
            '. $donneesaa['navigateur'] .'
            </div>
        <br><br>
        ';
        if($json->{'status'} == "success") {
            print $json->{'regionName'};
            echo '
            <br>
            ';
            print $json->{'city'};
            echo '
            <br>
            ';
            print $json->{'zip'};
            echo '
            <br>
            ';
            print $json->{'as'};
        } else {
            echo 'Error IPV6';
        }
        echo '
        </div>
        <div class="card-footer">'. $donneesaa['ip'] .'
        <br><br>
        <form action="" method="GET">
            <input type="hidden" name="id" value="'. $donneesaa['id'] .'">
            <button type="submit" class="btn btn-primary">Supprimer</button>
        </form>
        </div>
    </div>
</div>

';
}
$reqabcd->closeCursor();
?>