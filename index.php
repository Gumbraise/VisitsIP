<?php
if(isset($_POST['delete'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=visits_ip', 'root', '');
    $deleteIPs = $bdd2->prepare("DELETE FROM ip_list WHERE json = ?");
    $deleteIPs->execute(array($_POST['delete']));
    echo 'ok';
}
else {
echo
'<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
    .collapse {
        position: relative
    }
    .relative {
        position: relative
    }
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
        .judu {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            color: #00a700
        }
        .nope {
            display:none
        }
    </style>
</head>
';
if(isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
}
if(isset($_POST['login'])) {
    if(!empty($_POST['password'])) {
        if($_POST['password'] == "BDDp@stropsecur69") {
            $_SESSION['id'] = 1;
        }
    }
}
if(isset($_SESSION['id'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=visits_ip', 'root', '');

    if (isset($_GET['e'])) {
        $reqabcd = $bdd->prepare("SELECT * FROM ip_list WHERE page = ? ORDER BY date DESC LIMIT 100");
        $reqabcd->execute(array($_GET['e']));
    } else {
        $reqabcd = $bdd->query("SELECT * FROM ip_list ORDER BY date DESC LIMIT 100");
    }
    if(isset($_GET['id'])) {
        $deleteIP = $bdd->prepare("DELETE FROM ip_list WHERE id = ?");
        $deleteIP->execute(array($_GET['id']));
    }
    echo '<h3 style="text-align: center"><form action="" method="POST" name="logout"><input type="submit" value="Déconnexion" name="logout"></form></h3>
    <input type="text" placeholder="Remove">
    <div>
    </div>
    ';
    $count = $reqabcd->rowCount();
    if ($count != 0) {
        while($donneesaa = $reqabcd->fetch()) {
            $json = json_decode($donneesaa['json']);
        echo '

        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">'. date('d/m/Y H:i:s', $donneesaa['date']) .'</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo'. $donneesaa['id'] .'">Debug</button>
                    <div id="demo'. $donneesaa['id'] .'" class="collapse"><br>
                    <div class="row">
                        <div class="col-sm">
                            '. $donneesaa['navigateur'] .'
                        </div>
                        <div class="col-sm">
                        Orientation:<br>
                            '. $donneesaa['orientation'] .'<br>
                            Résolution écran:<br>
                            '. $donneesaa['screen'] .'<br>
                            Résolution fenêtre:<br>
                            '. $donneesaa['viewport'] .'<br>
                            Nombre de procos:<br>
                            '. $donneesaa['processors'];
                            if ($donneesaa['ram'] != 'undefined') { echo'<br>
                            RAM:<br>
                            '. $donneesaa['ram'] .'GB';
                            } echo
                            '
                        </div>
                        </div>
                    </div>
                <br><br>
                <div class="relative">
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
                    $jsonfile = file_get_contents('http://ip-api.com/json/'.$donneesaa['ip']);
                    $bdd = new PDO('mysql:host=db5000217374.hosting-data.io;dbname=dbs212220', 'dbu337316', 'BDDp@stropsecur69');
                    $insertmbr = $bdd->prepare('UPDATE ip_list SET json = ? WHERE id = ?');
                    $insertmbr->execute(array($jsonfile, $donneesaa['id']));            
                }
                echo '
                </div>
                </div>
                <div class="card-footer">'. $donneesaa['ip'] ."<br>".$donneesaa['page'].'
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
    } else {
        echo 'Il n\'y a encore personne qui a cliqué sur le lien';
    }
    echo '
    <script type="text/javascript">
        var input = document.getElementsByTagName("input")[1];
        

        input.onchange = function() {
            var div = document.getElementsByTagName("div")[0];
            div.innerHTML = "<div class=\"alert alert-warning\" role=\"alert\">This is a warning alert—check it out!</div>"

            var formData = new FormData();
            formData.set("delete", input.value);

            var request2 = new XMLHttpRequest();
            request2.open(\'POST\', \'pc.php\', true);
            request2.send(formData);
            request2.onreadystatechange = function()
            {
                if (request2.readyState === 4) {
                    if (request2.responseText == \'ok\') {
                        div.innerHTML = "<div class=\"alert alert-success\" role=\"alert\">This is a warning alert—check it out!</div>"
                    }
                    else {
                        div.innerHTML = "<div class=\"alert alert-danger\" role=\"alert\">This is a warning alert—check it out!</div>"
                    }
                }
            }
        }

    </script>
    ';
} else {
    echo '
    <div class="col-sm-3 judu">
        <form action="" method="POST" name="login">
            <input style="color:#00a700; background-color: #000; border:none" type="password" name="password" placeholder="Password">
            <button class="nope" type="submit" name="login"></button>
        </form>
    </div>
    ';
}
}
?>
