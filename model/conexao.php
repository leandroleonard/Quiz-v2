<?php
    require_once "config.php";

    class Conexao
    {
        public static function bd(){
            $conectar = new mysqli(HOST, USER, PASSWORD, DBNAME);
            if($conectar === false){
                die("ERROR: Erro de conecção. " . $mysqli->connect_error);
            }else{
                return $conectar;
            }
        }

        public function selectAll($table){
            return self::bd()->query("SELECT * FROM $table");
        }
    }