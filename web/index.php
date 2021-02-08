<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='css/index.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="../bin/script-index.js"></script>
    <title>Digital Arc</title>
</head>

<body style="background-color: lightgray">
    <center>
        <div id='main_div' class="jumbotron jumbotron-fluid" style='margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8'>
            <div id='text_div' class='container'>
                <h1 class="display-1">Digital Arc</h1>
                <br><p class="lead" style="font-style: italic">nati dai documenti, per i documenti</p> <!-- Slogan Digital-Arc -->
                <hr class="my-4">
            </div>
            <div id='input_div' class="jumbotron jumbotron-fluid">
                <form class='center' class="form-inline" style='margin-top:1%' onsubmit='validate()'
                    action='homepage.php' method='POST'>
                    <!--
                    <label for="name" class="mr-sm-2">Nome:</label>
                    <input class="form-control mb-2 mr-sm-2" name='name' maxlength='20' placeholder="Inserisci il Nome"
                        id="name" style='width: 50%' autocomplete="off" required>
                    <label for="surname" class="mr-sm-2">Cognome:</label>
                    <input class="form-control mb-2 mr-sm-2" name='surname' maxlength='20'
                        placeholder="Inserisci il Cognome" id="surname" style='width: 50%' autocomplete="off" required>
                    -->
                    <label for="CF" class="mr-sm-2">Codice Fiscale:</label>
                    <input class="form-control mb-2 mr-sm-2" name='CF' placeholder="Inserisca il suo Codice Fiscale." id="CF"
                        style='width: 50%' autocomplete="off" required>
                    <br><label for="pwd" class="mr-sm-2">Password:</label>
                    <input type="password" class="form-control mb-2 mr-sm-2" name='pwd'
                        placeholder="Inserisca la Password." id="pwd" style='width: 50%' maxlength='20' required>
                    <br><br><button type="submit" class="btn btn-outline-primary mb-2" onclick='login_btn_clicked()'
                        id='login_btn'>Invia</button>
                </form>
            </div>
        </div>
    </center>
</body>

</html>