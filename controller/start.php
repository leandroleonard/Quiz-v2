<?php 
    if($_SERVER['REQUEST_METHOD'] != "POST"):
        header("location: ../index.php");
    endif;

    if(isset($_POST['nome_jogador'])):
        $jogador        = $_POST['nome_jogador'];
        $jogador_cod    = md5($jogador);

        session_start();

        $_SESSION['jogador'] = $jogador;
        $_SESSION['pontos']  = 0;

        header("location: ../index.php?quiz=on&jogador=$jogador_cod");
    endif;

