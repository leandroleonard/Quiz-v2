<?php 
    require_once "conexao.php";
    
    class ModelRespostas extends Conexao
    {
        protected $table = "respostas";
        
        public static function getAllRespostas(){
            return selectAll("respostas");
        }

        public static function getRespostasByPergunta($pergunta){
            return parent::bd()->query("SELECT * FROM respostas WHERE cod_pergunta = '$pergunta'");
        }
    }