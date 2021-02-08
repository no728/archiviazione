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
            $kws_exist = true;
            if(isset($_POST['keywords'])) $keywords = $_POST['keywords']; else $kws_exist = false;
            if(isset($_POST['document_tipology'])) $tipologia_doc = $_POST['document_tipology']; else $valid_input = false;
            if(isset($_POST['document_category'])) $categoria_doc = $_POST['document_category']; else $valid_input = false;
            if(isset($_POST['document_index'])) $indice_doc = $_POST['document_index']; else $valid_input = false;
            if(isset($_POST['document_year'])) $anno_doc = $_POST['document_year']; else $valid_input = false;
            if(isset($_POST['document_month'])) $mese_doc = $_POST['document_month']; else $valid_input = false;
            if(isset($_POST['document_day'])) $giorno_doc = $_POST['document_day']; else $valid_input = false;
            // echo $anno_doc . ' ' . $mese_doc . ' ' . $giorno_doc;
            if ($valid_input){
                $conn = new mysqli($servername, $username, $password, $dbname);
                $keywords = strtolower($keywords);
                $keywords = explode("-", $keywords);
                /*foreach($keywords as $kw){
                    echo $kw . " | ";
                }
                echo "<br><br>";*/
                if (startsWith($tipologia_doc, "A")){
                    $table = "DocumentiAmministrazione";
                }else{
                    $table = "DocumentiDidattica";
                }
                $query = 'SELECT * FROM ' . $table . '';
                $valid_docs = [];
                $docs = $conn->query($query) or die($conn->error);
                $normalized_docs = $docs->fetch_assoc();
                if ($kws_exist){
                    foreach($docs as $doc){ // per OGNI documento doc
                        foreach($keywords as $kw){  // per ogni parola chiave
                            $lowered_name = strtolower($doc['document_name']);
                            if ($kw === '') array_push($valid_docs, $doc);  // aggiungi il file alla lista dei documenti "validi"
                            else if (strpos($lowered_name, $kw) !== false){    // se contiene una parola chiave, entrambe le stringhe sono interamente minuscole
                                    array_push($valid_docs, $doc);  // aggiungi il file alla lista dei documenti "validi"
                            }
                            if (in_array($doc, $valid_docs)) break;
                        }
                    }
                }else{
                    $valid_docs = $docs;
                }
                //echo $categoria_doc;
                if ($categoria_doc != ''){
                    $index = 0;
                    foreach($valid_docs as $doc){
                        if ($doc['document_category'] != $categoria_doc){
                            unset($valid_docs[$index]);
                        }
                        $index += 1;
                    }
                }
                //echo $indice_doc;
                if ($indice_doc != ''){
                    $index = 0;
                    foreach($valid_docs as $doc){
                        if ($doc['document_index'] != $indice_doc){
                            unset($valid_docs[$index]);
                        }
                        $index += 1;
                    }
                }
                if ($anno_doc != ''){
                    $index = 0;
                    foreach($valid_docs as $doc){
                        if ($doc['document_year'] != $anno_doc){
                            unset($valid_docs[$index]);
                        }
                        $index += 1;
                    }
                }
                if ($mese_doc != ''){
                    $index = 0;
                    foreach($valid_docs as $doc){
                        if ($doc['document_month'] != $mese_doc){
                            unset($valid_docs[$index]);
                        }
                        $index += 1;
                    }
                }
                if ($giorno_doc != ''){
                    $index = 0;
                    foreach($valid_docs as $doc){
                        if ($doc['document_day'] != $giorno_doc){
                            unset($valid_docs[$index]);
                        }
                        $index += 1;
                    }
                }
                // A questo punto valid_docs contiene tutti i documenti che coincidono con le keyword
                // scrivere una pagina in forma tabellare (vedi Tabelle Bootstrap) che contenga la struttura dei 
                // documenti e un tasto di download che contenaga il riferimento a documento.pathToFile
                // è possibile scaricare quanti file si vuole prima di chiudere la pagina.
                echo 
                '
                <center>
                <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                    <h1 class="display-4"> Risultati Ricerca </h1><br>
                    <hr class="my-4"><br>
                    <div id="table_div" class="container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><center>ID</center></th>
                                    <th scope="col"><center>Nome Documento</center></th>
                                    <th scope="col"><center>Data (YYYY/mm/gg)</center></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach($valid_docs as $doc){
                                echo '<tr><th scope="row">' . $doc["documentID"] . '</th>';
                                echo '<td>' . $doc["document_name"] . '</td>';
                                $year = $doc['document_year'];
                                $month = $doc['document_month'];
                                $day = $doc['document_day'];
                                $date = $year . "/" . $month . "/" . $day;
                                echo '<td>' . $date . '</td>';
                                echo '<td>' . '<center>
                                                <a href="' . $doc['pathToFile'] . '" download="">
                                                    <button type="button" class="btn btn-outline-primary">Download</button>
                                                </a>
                                                </center>' . '<td></tr>'; 
                            }
                            echo '</tbody>
                    </div>
                </div>
                </center>
                ';
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