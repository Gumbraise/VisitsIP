<?php
if (isset($_POST['a'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=visits_ip', 'root', '');

    if (isset($_GET['e'])) {
        $page = htmlspecialchars($_GET['e']);
    } else {
        $page = $_SERVER['SCRIPT_NAME'];
    }

    $jsonfileinsert = file_get_contents('http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR']);
    $insertmbr3 = $bdd->prepare('INSERT INTO ip_list(ip, navigateur, date, json, page, orientation, screen, viewport, diagonal) VALUES(?, ?, UNIX_TIMESTAMP(), ?, ?, ?, ?, ?, ?)');
    $insertmbr3->execute(array($_SERVER['REMOTE_ADDR'], $_SERVER["HTTP_USER_AGENT"], $jsonfileinsert, $page, $_POST['orientation'], $_POST['screen'], $_POST['viewport'], $_POST['diagonal']));
} else {
?>
<script>
    window.onload = function () {
        window.requestAnimationFrame(animate);

            function animate(now) {
                frames++;
                if (new Date().getTime() - time >= 1000) {
                    document.getElementById("fps").textContent = frames;
                    frames = 0;
                    time += 1000;
                }
                window.requestAnimationFrame(animate);
            }

                window.outerHeight = window.screen.height;
                
        window.outerHeight = window.screen.height;

        const orientation = window.screen.msOrientation || window.screen.mozOrientation || (window.screen.orientation || {}).type;
        const screen = window.screen.width + "*" + window.screen.height;
        const viewport = window.innerWidth + "*" + window.innerHeight;
        const diagonal = Math.sqrt(window.screen.width / window.screen.height) * 10;

        var formData = new FormData();
        formData.set("a", "TRUE");
        formData.set("orientation", orientation);
        formData.set("screen", screen);
        formData.set("viewport", viewport);
        formData.set("diagonal", diagonal);

        var request = new XMLHttpRequest();
        request.open('POST', '/', true);
        request.send(formData);
        request.onreadystatechange = function() {}
}
</script>
<?php
}
?>

