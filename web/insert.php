<html>
    <head>
        <link rel='stylesheet' href='css_homepage.css' />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="../bin/script-homepage.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <title>Digital Arc</title>
    </head>
    <body style="background-color: lightgray">
        <?php
        include('../bin/config.php');
        session_start();
        $valid_session = true;
        //echo count($_SESSION);
        if(count($_SESSION) == 0){
            $valid_session = false;
        }
        foreach($_SESSION as $key => $value){
            if ($value == null) $valid_session = false;
            // echo $key . ' ' . $value;
        }
        if($valid_session == true){
            $session_user = $_SESSION['session_user'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            $valid_input = true;
            if(isset($_POST['document_name'])) $nome_doc = $_POST['document_name']; else $valid_input = false;
            if(isset($_POST['document_typology'])) $tipologia_doc = $_POST['document_typology']; else $valid_input = false;
            if(isset($_POST['document_category'])) $categoria_doc = $_POST['document_category']; else $valid_input = false;
            if(isset($_POST['document_index'])) $indice_doc = $_POST['document_index']; else $valid_input = false;
            if(isset($_POST['publishment_date'])) $data_doc = $_POST['publishment_date']; else $valid_input = false;
            if ($valid_input){
                $percorso_doc = (new Path)->create_path($nome_doc . $data_doc);
                $timestamp = strtotime($data_doc);
                $day = date("d", $timestamp);
                $month = date("m", $timestamp);
                $year = date("Y", $timestamp);
                $conn = new mysqli($servername, $username, $password, $dbname);
                if (startsWith($tipologia_doc, "A")){
                    $table = "DocumentiAmministrazione";
                }else{
                    $table = "DocumentiDidattica";
                }
                $filename = (new Path)->create_path($nome_doc . $data_doc);
                $destination = $target_dir . basename($filename);
                $file = $_FILES['document_file']['tmp_name'];
                if (move_uploaded_file($file, $destination)){
                    echo $sql = 'INSERT INTO ' . $table . ' (document_name, pathToFile, document_category, document_index, document_day, document_month, document_year) VALUES ("' . $nome_doc . '", "'. $destination . '", "' . $categoria_doc . '", "' . $indice_doc . '", "' . $day . '", "' . $month . '", "' . $year . '")';
                    if ($conn->query($sql)){
                        // correctly done
                        header("Location: insert_documents.php");
                        exit();
                    }   
                    else{
                        header("Location: redirect_homepage.php");
                        exit();
                    }
                }else{
                    header("Location: redirect_homepage.php");
                    exit();
                }
            }else{
                header("Location: redirect_homepage.php");
                exit();
            }
        }else{
            header("Location: redirect.php");
            exit();
        }
        ?>
    </body>
</html>