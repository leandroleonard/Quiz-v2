<?php 
    session_start();
    session_destroy();
    require_once "../controller/game.php";
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    <!-- assets -->
	<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/icons.min.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/app.min.css">
	<!-- Sweet Alert-->
    <link href="../public/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav class="navbar navbar-expand bg-danger navbar-dark">
        <strong><a href="#" class="navbar-brand">QUIZ</a></strong>
    </nav>

    <div class="container my-3">
        <div class="row">
            <div class="col-md-3">
                <h3>Novo jogo</h3>
                <form action="../controller/start.php" method="post">
                    <div class="form-group">
                        <input type="text" name="nome_jogador" id="nome_jogador" required class="form-control" placeholder="Nome do Jogador">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="comecar" class="d-none"></button>
                    </div>
                </form>
                <button type="button" class="d-none" id="sa-close"></button>
                <button id="btn_comecar" class="form-control btn btn-danger"> <i class="far fa-laugh-beam"></i> Comecçar</button>
            </div>
            <div class="col-md-9">
                <h3>Top 10 dos melhores jogadores</h3>
                <div class="table">
					<table class="table table-hover">
						<thead>
							<tr>
								<th><span class=" fas fa-flag-checkered"></span></th>
								<th>Jogador</th>
								<th><span class="far fa-gem"></span></th>
								<th><span class="far fa-calendar-alt"></span></th>
							</tr>
						</thead>
						<tbody>
							<?php $contador = 1;?>
							<?php while($row = $pontuacao->fetch_array()):?>
								<tr>
									<td>
										<?php if($contador == 1): ?>
											<span class="fas fa-star"></span>
										<?php elseif($contador == 2): ?>
											<span class="fas fa-star-half-alt"></span>
										<?php elseif($contador == 3): ?>
											<span class="far fa-star"></span>
										<?php else: ?>
											<span><?=$contador?></span>
										<?php endif ?>
									</td>
									<td><?=$row['jogador']?></td>
									<td><?=$row['pontuacao']?></td>
									<td><?=substr($row['updated_at'], 0, 10)?></td>
								</tr>
								<?php $contador++; ?>
							<?php endwhile ?>
						</tbody>
					</table>			
				</div>
            </div>
        </div>
    </div>

    <script src="../public/assets/js/vendor.min.js"></script>

	<!-- Sweet Alerts js -->
	<script src="../public/assets/libs/sweetalert2/sweetalert2.min.js"></script>
	<!-- Sweet alert init js-->
	<script src="../public/assets/js/pages/sweet-alerts.init.js"></script>

	<script src="../public/assets/js/app.min.js"></script>

	<script>
		$(document).on("click", "#btn_comecar", function(){
			var jogador = $("#nome_jogador").val();
			if(jogador == ""){
				$("#nome_jogador").before("<span class='text-danger text-right' id='aviso'>Preencher campo!!!</span>");

				window.setTimeout(
					function(){
						$("#aviso").fadeOut();
					}, 30e2
				);
			}else{
				// carregar perguntas
				$.ajax({
					url: "../controller/load.php",
					type: "post",
					cache: false,
					data:{game: "start"}
				});
				//==========
				$("#sa-close").click();
				//==========
				
				window.setTimeout(
					function(){
						$("#comecar").click();
					},
					30e2
				);
			}
		});
	</script>
</body>
</html>