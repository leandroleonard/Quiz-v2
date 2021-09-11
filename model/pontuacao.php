<?php 
    require_once "conexao.php";
    
    class ModelPontuacao extends Conexao
    {
        protected $table = "pontuacao";
        
        public static function getAllPontuacao(){
            return parent::bd()->query("SELECT jogador, MAX(pontos) as pontuacao, updated_at FROM pontuacao GROUP BY jogador  ORDER BY pontuacao DESC");
        }
    }