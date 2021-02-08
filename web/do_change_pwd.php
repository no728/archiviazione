<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='css/homepage.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="../bin/script-change_pwd.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <title>Digital Arc</title>
</head>

<body style="background-color: lightgray">
    <?php
    error_reporting(0);
    include('../bin/config.php');
    session_cache_limiter('private, must-revalidate');
    session_cache_expire(60);
    session_start();
    $valid_input = true;
    if (isset($_POST['old_pwd'])) $old_pwd_input = $_POST['old_pwd'];
    else $valid_input = false;
    if (isset($_POST['new_pwd'])) $new_pwd = $_POST['new_pwd'];
    else $valid_input = false;
    if ($valid_input == false) {
        header("Location: change_pwd.php");
        exit();
    }
    $valid_session = true;
    if(count($_SESSION) == 0){
        $valid_session = false;
    }
    foreach($_SESSION as $key => $value){
        if ($value == null) $valid_session = false;
        // echo $key . ' ' . $value;
    }
    if ($valid_session){
        $session_user = new User;
        $session_user->set_CF($_SESSION['session_user']->get_CF());
        $session_user->set_pwd($_SESSION['session_user']->get_pwd());
        $old_pwd_is_correct = true;
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT user_pwd FROM Utenti WHERE user_CF='" . $session_user->get_CF() . "'";
        // echo 'QUERY : ' . $query;
        $pwd = $conn->query($query) or die($conn->error);
        $pwd_normalized = $pwd->fetch_assoc()['user_pwd'];
        $salt =  $session_user->get_CF();
        if ($pwd_normalized != hash("sha512", $salt. $old_pwd_input)){
            $old_pwd_is_correct = false;
        }
        // echo $old_pwd_input . " " . $pwd_normalized . " " . $new_pwd;
        if ($old_pwd_is_correct){
            
            $query = "UPDATE Utenti SET user_pwd='" . hash("sha512", $salt . $new_pwd) . "' WHERE user_CF='" . $session_user->get_CF() . "'";
            // echo 'QUERY :' . $query;
            if ($conn->query($query) === TRUE) {
                $changed = true;
            } else {
                $changed = false;
                $error_msg = "Error: " . $query . "<br>" . $conn->error;
            }
            if ($changed){
                header("Location: auto_redirect_index.php");
                exit();
            }else{
                echo '<center>
                        <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                            <div id="text_div" class="container">
                                <h1 class="display-4">Errore di connessione.</h1>
                                <p class="lead">';
                                echo $error_msg . '<br>Premi il pulsante per essere reindirizzato alla homepage.</p>
                                <br><button class="btn btn-outline-primary mb-2" id="redirectBtn">Redirect</button>
                                <script language="javascript">var redirect = document.getElementById("redirectBtn");
                                redirect.addEventListener("mousedown", function() {
                                // btn.setAttribute("disabled", true);
                                redirect.innerHTML = "Carico...<br>";
                                var newSpan = document.createElement("span");
                                newSpan.classList.add("spinner-border");
                                newSpan.classList.add("spinner-border-sm");
                                newSpan.setAttribute("role", "status");
                                newSpan.setAttribute("aria-hidden", "true");
                                redirect.appendChild(newSpan);
                                document.location.href = "homepage.php";
                                });
                                </script>
                            </div>
                        </div>
                    </center>';
            }
        }else{
            echo 
            '
            <center>
            <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8"">
                <div id="text_div" class="container">
                    <h1 class="display-4">La password inserita<br>non è corretta.</h1>
                    <p class="lead">';
                    echo $error_msg . '<br>Premi il pulsante per essere reindirizzato alla homepage.</p>
                    <br><button class="btn btn-outline-primary mb-2" id="redirectBtn">Redirect</button>
                    <script language="javascript">var redirect = document.getElementById("redirectBtn");
                    redirect.addEventListener("mousedown", function() {
                    // btn.setAttribute("disabled", true);
                    redirect.innerHTML = "Carico...<br>";
                    var newSpan = document.createElement("span");
                    newSpan.classList.add("spinner-border");
                    newSpan.classList.add("spinner-border-sm");
                    newSpan.setAttribute("role", "status");
                    newSpan.setAttribute("aria-hidden", "true");
                    redirect.appendChild(newSpan);
                    document.location.href = "homepage.php";
                    });
                    </script>
                    </div>
                </div>
            </center>';
        }
    } ?>
    </body>
</html>