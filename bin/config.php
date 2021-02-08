<?php

$servername = "localhost:3306";
$username = "root";
$password = "Cristian3349256466";
$dbname = "digital-arc";

$target_dir = "../docs/";

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

class User
{
    private $__CF = '';
    private $__pwd = '';

    public function set_CF($new_CF){
        $this->__CF = $new_CF;
    }
    public function set_pwd($new_pwd){
        $this->__pwd = $new_pwd;
    }

    public function get_CF(){
        return $this->__CF;
    }
    public function get_pwd(){
        return $this->__pwd;
    }
}

class CodiceCatastale
{
    public function calcola($citta, $sigla){
        $str = file_get_contents( __DIR__.'/comuni.json');
        $json = json_decode($str, true); // decode the JSON into an associative array
        $codCatastale = '';
        foreach($json as $item){ 
            if ($item['nome'] == $citta && $item['sigla'] == $sigla){
                $codCatastale = $item['codiceCatastale'];
            }
        }
        // echo $codCatastale;
        return $codCatastale;
    }
}

class Path
{
    public static function create_path($document_name){ // example: Assenza D'Arrigo 19/10/2019
        $special_chars = ['\\', '/', ':', '*', '?',  '<', '>', '|'];
        $name = strtolower($document_name); // name: assenza d'arrigo 19/10/2019
        $name = str_replace(" ", "_", $name);   // name: assenza_d'arrigo_19/10/2019 
        $name = str_replace("/", "-", $name); // as you can't save slashes --> name: assenza_d'arrigo19-10-2019
        foreach($special_chars as $char){
            $name = str_replace($char, "", $name);
        }
        return $name . ".pdf";
    }
}