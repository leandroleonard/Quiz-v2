<?php
    require_once "../model/conexao.php";
    
    class SeedPerguntas extends Conexao
    {

        function __construct(){
            $sql = parent::bd()->query("TRUNCATE perguntas");
        }

        public function insertPerguntas(){
            $perguntas = [
                'pergunta1' => [
                    'pergunta' => 'Em que ano foi publicada a teoria da relatividade?',
                    'cod_pergunta' => '250fc5d62badd5ffabaa1fdee74eb952'
                ],
    
                'pergunta2' => [
                    'pergunta' => 'Qual destes elementos não faz parte do grupo 1 da tabela periodica?',
                    'cod_pergunta' => '7aabf5c0c68605e146678e7a1bc73c3f'
                ],
                'pergunta3' => [
                    'pergunta' => 'Em quantas partes está dividido o corpo humano?',
                    'cod_pergunta' => '6700b1d15538a4870cb9d9a9466c4361'
                ]
            ];

            shuffle($perguntas);

            foreach($perguntas as $pergunta):
                parent::bd()->query("INSERT INTO perguntas (pergunta, cod_pergunta) VALUES ('" . $pergunta['pergunta'] . "','" . $pergunta['cod_pergunta'] . " ')");
            endforeach;
        }

        public function seed(){
            $this->insertPerguntas();
        }
    }
?>