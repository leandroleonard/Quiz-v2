<?php 
    if (!isset($_GET['quiz'])):
        session_start();
        session_destroy();
        header("location: views/index.php");
    endif;

    if($_GET['quiz'] == "off" || empty($_GET['quiz'])):
        session_start();
        session_destroy();
        header("location: views/index.php");
    endif;

    if(isset($_GET['quiz']) && isset($_GET['jogador'])):
		$jogador_cod = $_GET['jogador'];
		header("location: views/jogo.php?quiz=on&jogador=$jogador_cod");		
    endif;

    if(isset($_SESSION['jogador'])):
        $jogador        = $_SESSION['jogador'];
        $jogador_cod    = md5($jogador);

        header("location: ../index.php?quiz=on&jogador=$jogador_cod");
    endif;
    
    


