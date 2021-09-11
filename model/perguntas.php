<?php 
    require_once "conexao.php";
    
    class ModelPerguntas extends Conexao
    {
        protected $table = "perguntas";
        
        public static function getAllPerguntas(){
            return selectAll($table);
        }

        public static function getPergunta(){
            return parent::bd()->query("SELECT * FROM perguntas limit 1");
        }
    }