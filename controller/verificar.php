<?php
	require_once "../model/conexao.php";
	session_start();
	$cod = $_POST['pergunta'];
	$resposta = $_POST['opcao'];

	$verificar = Conexao::bd()->query("SELECT * from respostas where cod_pergunta = '$cod' and resposta = '$resposta'");

	if($verificar == true):
		while ($row = $verificar->fetch_array()):
			if ($row['tipo'] == "V"):
				echo json_encode(array("statusCode"=>200));
				$_SESSION['pontos'] += 60;
			elseif($row['tipo'] == "F"):
				$sql = Conexao::bd()->query("SELECT * from respostas where cod_pergunta = '$cod' and tipo = 'V'");
				$row = $sql->fetch_array();

				echo json_encode(array("statusCode"=>201, "respotaCerta" => $row['cod_resposta'], "pontos" => $_SESSION['pontos']));
			endif;
		endwhile;
	else:
		echo "resposta invalida";
	endif;

	if($_SESSION['pontos'] > 60):
		$pontos = $_SESSION['pontos'];
		$jogador = $_SESSION['jogador'];
		$data = date("Y-m-d H:i:m");
		Conexao::bd()->query("INSERT INTO pontuacao (jogador, pontos, updated_at) VALUES('$jogador', '$pontos', '$data')");		
	endif;


?>