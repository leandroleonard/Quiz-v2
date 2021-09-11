<?php 

    if (isset($_POST['game']) && $_POST['game']  == "start"):
        require_once "../model/seed/perguntas.php";
        $perguntas = new SeedPerguntas();
        $perguntas->seed();

        require_once "../model/seed/respostas.php";
        $respostas = new SeedRespostas();
        $respostas->seed();
    endif;

        
    