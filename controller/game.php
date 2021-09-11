<?php 
    require_once ("../model/perguntas.php");
    require_once ("../model/respostas.php");
    require_once ("../model/pontuacao.php");

    $model_perguntas = new ModelPerguntas();
    $perguntas = ModelPerguntas::getPergunta();
    $pontuacao = ModelPontuacao::getAllPontuacao();
    
    function respostas($pergunta){
        return ModelRespostas::getRespostasByPergunta($pergunta);
    }

    if(isset($_POST['trocarPergunta'])):
		$pergunta = $_POST['pergunta'];

		$eliminar = Conexao::bd()->query("DELETE FROM perguntas where cod_pergunta = '$pergunta'");
		if($eliminar):
			echo "Pergunta Ultrapassada!";
        endif;

    endif;
    
    if(isset($_POST["endgame"])):
		session_start();

		session_destroy();

        header("location: ../view/index.php?quiz=off");
	endif;
    