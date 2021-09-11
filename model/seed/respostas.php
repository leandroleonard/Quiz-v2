<?php
    require_once "../model/conexao.php";
    
    class SeedRespostas extends Conexao
    {
        function __construct(){
            $sql = parent::bd()->query("TRUNCATE respostas");
        }

        public function insertRespostas(){
            $respostas = [
                'resposta1' => [
                    'resposta' => '1905',
                    'cod_pergunta' => '250fc5d62badd5ffabaa1fdee74eb952',
                    'tipo' => 'V',
                    'cod_resposta' => '73e0f7487b8e5297182c5a711d20bf26'
                ],
                'resposta2' => [
                    'resposta' => '1999',
                    'cod_pergunta' => '250fc5d62badd5ffabaa1fdee74eb952',
                    'tipo' => 'F',
                    'cod_resposta' => '5ec829debe54b19a5f78d9a65b900a39'
                ],
                'resposta3' => [
                    'resposta' => '2001',
                    'cod_pergunta' => '250fc5d62badd5ffabaa1fdee74eb952',
                    'tipo' => 'F',
                    'cod_resposta' => 'd0fb963ff976f9c37fc81fe03c21ea7b'
                ],
                'resposta4' => [
                    'resposta' => '1899',
                    'cod_pergunta' => '250fc5d62badd5ffabaa1fdee74eb952',
                    'tipo' => 'F',
                    'cod_resposta' => '6be5336db2c119736cf48f475e051bfe'
                ],
                'resposta5' => [
                    'resposta' => 'Oxigénio',
                    'cod_pergunta' => '7aabf5c0c68605e146678e7a1bc73c3f',
                    'tipo' => 'V',
                    'cod_resposta' => '9ccc95503d40e0a38e08e4ac72cf1eab'
                ],
                'resposta6' => [
                    'resposta' => 'Sódio',
                    'cod_pergunta' => '7aabf5c0c68605e146678e7a1bc73c3f',
                    'tipo' => 'F',
                    'cod_resposta' => '2095040186e32a0b1fd800b26ef8dea0'
                ],
                'resposta7' => [
                    'resposta' => 'Césio',
                    'cod_pergunta' => '7aabf5c0c68605e146678e7a1bc73c3f',
                    'tipo' => 'F',
                    'cod_resposta' => 'd1b14da33189977d700639cb59e0478f'
                ],
                'resposta8' => [
                    'resposta' => 'Rubídio',
                    'cod_pergunta' => '7aabf5c0c68605e146678e7a1bc73c3f',
                    'tipo' => 'F',
                    'cod_resposta' => '3c417b283e483ac458721f0637b97ebd'
                ],
                'resposta9' => [
                    'resposta' => '3',
                    'cod_pergunta' => '6700b1d15538a4870cb9d9a9466c4361',
                    'tipo' => 'V',
                    'cod_resposta' => 'eccbc87e4b5ce2fe28308fd9f2a7baf3'
                ],
                'resposta10' => [
                    'resposta' => '5',
                    'cod_pergunta' => '6700b1d15538a4870cb9d9a9466c4361',
                    'tipo' => 'F',
                    'cod_resposta' => 'e4da3b7fbbce2345d7772b0674a318d5'
                ],
                'resposta11' => [
                    'resposta' => '6',
                    'cod_pergunta' => '6700b1d15538a4870cb9d9a9466c4361',
                    'tipo' => 'F',
                    'cod_resposta' => '1679091c5a880faf6fb5e6087eb1b2dc'
                ],
                'resposta12' => [
                    'resposta' => '2',
                    'cod_pergunta' => '6700b1d15538a4870cb9d9a9466c4361',
                    'tipo' => 'F',
                    'cod_resposta' => 'c81e728d9d4c2f636f067f89cc14862c'
                ]
    
            ];

            shuffle($respostas);

            foreach($respostas as $resposta):
                parent::bd()->query("INSERT INTO respostas (resposta, cod_pergunta, cod_resposta, tipo) VALUES ('" . $resposta['resposta'] . "','" . $resposta['cod_pergunta'] . "', '" . $resposta['cod_resposta'] . "', '" . $resposta['tipo'] . "')");
            endforeach;
        }

        public function seed(){
            $this->insertRespostas();
        }
    }
?>