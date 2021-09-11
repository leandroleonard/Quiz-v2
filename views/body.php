<?php 
    require_once ("../controller/game.php");
?>
<link rel="stylesheet" type="text/css" href="../public/assets/css/app.css">
<!-- Sweet Alert-->
<link href="../public/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<?php if($perguntas->num_rows > 0): ?>
	<?php while ($row = $perguntas->fetch_array()): ?>
		<div class="row my-5">
			<div class="col-12 text-center">				
				<div class="alert alert-dark">
					<span id="pergunta" cod="<?=$row['cod_pergunta']?>"><?=$row['pergunta']?></span>
				</div>
			</div>
		</div>
	
	<?php
		$cod_pergunta = $row['cod_pergunta'];
		$getRespostas = respostas($cod_pergunta);
		$contador = 0;
		$linhas = ["a)", "b)", "c)", "d)"];
	?>

		<form>
			<div class="row">
				<?php while ($respostas = $getRespostas->fetch_array()): ?>
					<div class="col-xs-12 col-md-3">
						<div class="alert alert-dark" id="<?=$linhas[$contador]?>" codresposta="<?=$respostas['cod_resposta']?>">
							<span id="linha"><?=$linhas[$contador]?></span><span id="resposta"><?=$respostas['resposta']?></span>
						</div>
					</div>
					<?php $contador++;?>
				<?php endwhile ?>
			</div>
    <?php endwhile ?>
			<div class="row">
				<div class="container col-12" id="opcoes">
					<div class="btn-group">						
						<select class="form-control" id="opcao">
							<?php
								$getAllRespostas = respostas($cod_pergunta);
								$l = ["A", "B", "C", "D"];
								$contador = 0;
							?>
							<?php while ($resposta = $getAllRespostas->fetch_array()): ?>
								<option value="<?=$resposta['resposta']?>"><?=$l[$contador]?></option>
								<?php $contador++; ?>
							<?php endwhile ?>
						</select>
						<button type="button" class="btn btn-danger" id="demoSwal"><i class="fas fa-thumbs-up"></i></button>
					</div>
				</div>
			</div>
		</form>
		


		<script src="../public/assets/js/vendor.min.js"></script>

		<!-- Sweet Alerts js -->
		<script src="../public/assets/libs/sweetalert2/sweetalert2.min.js"></script>
		<!-- Sweet alert init js-->
		<script src="../public/assets/js/pages/sweet-alerts.init.js"></script>

		<script src="../public/assets/js/app.min.js"></script>

		<script type="text/javascript" src="../public/assets/js/sweetalert.min.js"></script>
        <script type="text/javascript">
        	$("#try").on("click", function(){location.reload()});
		      $("button[id='demoSwal']").click(function(){
		        swal({
		          title: "Tem certeza?",
		          text: "",
		          type: "warning",
		          showCancelButton: true,
		          confirmButtonText: "Sim",
		          cancelButtonText: "Cancelar",
		          closeOnConfirm: false,
		          closeOnCancel: true
		        }, function(isConfirm) {
		          if (isConfirm) {
					$.ajax({
						url: "../controller/verificar.php",
						type: "post",
						cache: false,
						data: {
							opcao: $("#opcao").val(),
							pergunta: $("#pergunta").attr("cod")
						},
				        success: function(dataResult){
				    		var dataResult = JSON.parse(dataResult);
					        if(dataResult.statusCode==200){
					        	window.setTimeout(function(){
			                		swal("Resposta correcta", $("#opcao").val() , "success");
					        		
					        	},0);

		                		$.ajax({
					        		url: "../controller/game.php",
					        		type: "post",
					        		cache: false,
					        		data:{
					        			trocarPergunta:"true",
					        			pergunta: $("#pergunta").attr("cod")
					        		}
					        	});	
			                	window.setTimeout(function(){
			                		location.reload();
			                	}, 20e2);    
					        }else if(dataResult.statusCode==201){
					        	swal("Resposta incorrecta", "" , "error");
					        	$.ajax({
					        		url: "../controller/game.php",
					        		type: "post",
					        		cache: false,
					        		data:{endgame:"true"}
					        	});

					        	var correcta = dataResult.respotaCerta;
					        	var pontos = dataResult.pontos;

					        	$("div[codresposta='" + correcta + "']").removeClass("alert-dark");
					        	$("div[codresposta='" + correcta + "']").addClass("alert-success");

					        	$("div[id][codresposta!='" + correcta + "']").removeClass("alert-dark");
					        	$("div[id][codresposta!='" + correcta + "']").addClass("alert-danger");


					        	$("#demoSwal").remove();
					        	$("select").remove();
					        	if(pontos < 60){
					        		$("#opcoes").before("<i class='fas fa-sad-cry fa-lg text-danger'></i> &nbsp;&nbsp;Você perdeu.<br> Pontuação: " + pontos + "<br> <button class='btn btn-danger btn-sm' id='try'>Tentar outra vez.</button>");
					        	}else{
					        		$("#opcoes").before("<i class='fas fa-frown fa-lg text-warning'></i> &nbsp;&nbsp;Você perdeu, mas conseguiu uma boa pontuação (" + pontos + ") <br> <button class='btn btn-danger btn-sm' id='try'>Tentar outra vez.</button>");
					        	}
					        	$("#opcoes").remove();
					        }
					      }
					});	
		          }
		        });
		      });
    	</script>
<?php else: ?>
	<?php session_start(); ?>
	<div class="container">		
		<h1> <span class="fas fa-smile-beam"></span> Parabéns você venceu o jogo <span class=" fas fa-gamepad"></span>!</h1>
		<h3> <span class="far fa-gem"></span> Pontuação: <?=$_SESSION['pontos']?>pts</h3>

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

		<div class="row">
			<a href="../index.php" class="btn btn-danger">Menu</a>
		</div>
	</div>
<?php endif ?>