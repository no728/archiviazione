<html>

<head>
    <link rel='stylesheet' href='css_homepage.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="../bin/script-find_documents.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <title>Digital Arc</title>
</head>

<body onload="bind_btns()" style="background-color: lightgray">
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
            echo'
            <center>
            <div id="main_div" class="jumbotron jumbotron-fluid" style="width: 50%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                <h1 class="display-4">Inserisci i dati del documento<br>da cercare.</h1><br>
                <hr class="my-4"><br>
                <form  class=\'center\' style="display: inline" class="form-inline" action="find.php" method="POST">
                    <div class="form-group">
                         <div id="left_div" class="form-group">
                            <label for="form_tipologia_documento">Tipologia documento (obbligatorio).</label>
                            <select id="form_tipologia_documento" name="document_tipology" class="form-control form-control-sm" style="width: 25%">
                                <option>A - Amministrazione</option>
                                <option>B - Didattica</option>
                            </select>
                        </div>
                        <div id="left_div" class="form-group">
                            <label for="document_name" class="mr-sm-2">Parole chiave: (lasciare vuoto per ottenere tutti i documenti).</label>
                            <input class="form-control form-control-sm" name=\'keywords\' placeholder=\'Inserisci delle parole chiave separate da "-".\' id="keywords"
                                style=\'width: 50%\' autocomplete="off">
                        </div>
                        <div id="right_div" class="form-group">
                            <label for="form_categoria_documento">Categoria documento.</label>
                            <select id="form_categoria_documento" name="document_category" class="form-control form-control-sm" style="width: 25%">
                                <option></option>
                                <option>A1 – Norme, disposizioni organizzative e ispezioni</option>
                                <option>A2 - Organi collegiali e direttivi</option>
                                <option>A3 - Carteggio ed atti</option>
                                <option>A4 - Contabilità</option>
                                <option>A5 – Edifici e impianti</option>
                                <option>A6 - Inventari dei beni</option>
                                <option>A7 - Personale docente e non docente</option>
                                <option>A8 – Alunni</option>
                                <option>B1 - Documentazione ufficiale dell\'attività didattica</option>
                                <option>B2 - Attività didattiche specifiche</option>
                            </select>
                        </div>
                    </div>
                    <div id="container_div" class="form-group">
                        <div id="left_div" class="form-group">
                            <label for="form_indice_documento">Indice documento.</label>
                            <select id="form_indice_documento" name="document_index" class="form-control form-control-sm" style="width: 25%">
                            <option></option>';
                            for($i = 1; $i < 48; $i++) echo '<option>' . $i . '</option>';
                            echo '
                            </select>
                        </div>
                        <div id="right_div" class="form-group">';
                            $current_year = strftime("%Y", time());
                            echo'
                            <label for="div_anno_documento">Data documento.</label><br>
                            <div id="div_anno_documento" >
                                <div class="bootstrap-select-wrapper">
                                    <label for="select_year">Anno.</label>
                                    <select id="select_year" name="document_year" class="form-control form-control-sm" style="width: 12.5%" >
                                    <option></option>';
                                    for($i = 1970; $i <= intval($current_year); $i++) echo '<option>' . $i . '</option>';
                                    echo '
                                    </select>
                                </div>
                                <div class="bootstrap-select-wrapper">
                                    <label for="select_month">Mese.</label>
                                    <select id="select_month" name="document_month" class="form-control form-control-sm" style="width: 12.5%">
                                    <option value=""></option>
                                    <option value="1">Gennaio</option>
                                    <option value="2">Febbraio</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Aprile</option>
                                    <option value="5">Maggio</option>
                                    <option value="6">Giugno</option>
                                    <option value="7">Luglio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Settembre</option>
                                    <option value="10">Ottobre</option>
                                    <option value="11">Novembre</option>
                                    <option value="12">Dicembre</option>
                                    </select>
                                </div>
                                <div >
                                    <label for="select_day">Giorno.</label>
                                    <select id="select_day" name="document_day" class="form-control form-control-sm" style="width: 12.5%">
                                    <option></option>';
                                    for($i = 1; $i <= 31; $i++) echo '<option>' . $i . '</option>';
                                    echo '
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <br><br><button type="submit" class="btn btn-outline-primary mb-2" id="insert_btn">Cerca</button>
                    </div>
                </form>
            </center>';
        }else{
            header("Location: redirect.php");
            exit();
        }
        ?>
</body>

</html>