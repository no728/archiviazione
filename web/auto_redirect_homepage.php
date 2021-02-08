<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <title>Digital Arc</title>
</head>

<body style="background-color: lightgray">
    <?php
    session_start();
    header("refresh:3;url=homepage.php");
    echo '
            <center>
                <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                    <div id="text_div" class="container">
                        <h1 class="display-4">Operazione Eseguita.</h1>
                        <p class="lead">Verrai reindirizzato alla homepage in 3 secondi.</p>
                    </div>
                </div>
            </center>';
    ?>
</body>

</html>