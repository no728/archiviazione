<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='css/homepage.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="../bin/script-homepage.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <title>Digital Arc</title>
</head>

<body onload="bind_btns()" style="background-color: lightgray">
    <?php include('../bin/config.php');
    session_cache_limiter('private, must-revalidate');
    session_cache_expire(60);
    session_start();
    $valid_login = true;
    $valid_session = false;
    $session_user = new User;
    if (isset($_POST['CF'])) {
        $temp_CF = strtoupper($_POST['CF']);
        $session_user->set_CF($temp_CF);
        //echo $session_user->get_CF(); 
    } else {
        $valid_login = false;
    }
    if (isset($_POST['pwd'])) {
        $salt = $temp_CF;
        $pwd = $salt . $_POST['pwd'];
        $pwd = hash("sha512", $pwd);  //  Previene SQL Injections provienienti dal Login (../index.php)
        $session_user->set_pwd($pwd);
        //echo $session_user->get_pwd();
    } else {
        $valid_session = true;
        if(count($_SESSION) == 0){
            $valid_session = false;
        }
        foreach($_SESSION as $key => $value){
            if ($value == null) $valid_session = false;
            // echo $key . ' ' . $value;
        }
    }
    if ($valid_session){
        $session_user->set_CF($_SESSION['session_user']->get_CF());
        $session_user->set_pwd($_SESSION['session_user']->get_pwd());
        $valid_login = true;
    }
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo 'CF: ' . $session_user->get_CF() . '   PWD: ' . $session_user->get_pwd();
    $query = "SELECT user_CF, user_name, user_surname, user_pwd, user_role from Utenti WHERE user_CF='" . $session_user->get_CF() . "' and user_pwd='" . $session_user->get_pwd() . "'";
    $user = $conn->query($query) or die($conn->error);
    $normalized_user = $user->fetch_assoc();
    if ($normalized_user == null) {
        $valid_login = false;
    }
    if ($valid_login == true) {
        session_unset();
        session_destroy();
        session_cache_limiter('private, must-revalidate');
        session_cache_expire(60);
        session_start();
        $_SESSION['session_user'] = $session_user;
        $_SESSION['user_name'] = $normalized_user['user_name'];
        $_SESSION['user_surname'] = $normalized_user['user_surname'];
        $_SESSION['user_role'] = $normalized_user['user_role'];
        echo '
        <center>
            <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 17.5%; margin-right: 17.5%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                <div id="text_div" class="container">
                    <h1 class=\'display-4\'> Benvenuto/a<br>' . $normalized_user['user_surname'] . ' ' . $normalized_user['user_name'] . '.</h1>
                    <br><hr class="my-4">';
                    if ($normalized_user['user_role'] == 'admin'){
                        echo'
                        <div class="form-group">
                            <p class="lead">Aggiungi un utente.</p>
                            <form style="display: inline-block" class="form-inline" action="add_user.php" method="GET">
                                <button type="submit" class="btn btn-outline-primary mb-2" id="add_user_btn">Vai</button>
                            </form>
                        </div>
                        ';
                    }
                echo '
                <br><div id="change_pwd_div">
                    <p class="lead">Cambia password.</p>
                    <form style="display: inline-block" class="form-inline" action="change_pwd.php" method="GET">
                        <button type="submit" class="btn btn-outline-primary mb-2" id="change_pwd_btn">Vai</button>
                    </form>
                </div>
                <div id="container_div" class="jumbotron">
                    <div id="left_div">
                        <hr class="my-4">
                        <p class="lead">Ricerca un Documento.</p>
                        <div class="form-group">
                            <form  class=\'center\' style="display: inline" class="form-inline" action="find_documents.php" method="GET">
                                <br><button type="submit" class="btn btn-outline-primary mb-2" id="find_btn">Ricerca</button>
                            </form>
                        </div>
                    </div>
                    <div id="right_div">
                         <hr class="my-4">
                        <p class="lead">Inserisci un Documento.</p>
                        <div class="form-group">
                            <form  class=\'center\' style="display: inline" class="form-inline" action="insert_documents.php" method="GET">
                                <br><button type="submit" class="btn btn-outline-primary mb-2" id="search_btn">Inserisci</button>
                            </form>
                        </div>
                    </div>
            </div>
        </center>';
    } else {
        header("Location: redirect.php");
        exit();
    } ?>
</body>

</html>