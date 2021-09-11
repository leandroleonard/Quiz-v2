<?php	

	session_start();

	if (!isset($_SESSION['jogador'])):
		header("location: index.php?quiz=off");		
	endif;
	
	if (!isset($_GET['jogador'])):
		header("location: index.php?quiz=off");
    endif;
    
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz</title>
	<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/icons.min.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/app.min.css">

</head>
<body>
	<nav class="navbar navbar-expand bg-danger navbar-dark">
		<strong><a href="#" class="navbar-brand">QUIZ</a></strong>

		<div class="ml-auto">
			<strong class="text-white">
                <i class="far fa-laugh-beam"></i> 
                <?= strToUpper($_SESSION['jogador']) ?> 
                &nbsp;&nbsp;&nbsp; 
                <span class="fas fa-gem"></span>
                : <?=$_SESSION['pontos']?>
            </strong>
		</div>
	</nav>
	
	<div class="container">
		<!-- Jogo -->
		<div class="body"></div>				

	</div>

	<script src="../public/assets/js/vendor.min.js"></script>

	<script src="../public/assets/js/app.min.js"></script>

	<script type="../public/assets/js/jquery.min.js"></script>

	<script>		
		$(document).ready(function(){
			// adicionar perguntas e respostas
			$.ajax({
				url: "body.php",
				type: "post",

				success: function(data){
					$(".body").html(data);
				}
			});			
		});
	</script>
</body>
</html>