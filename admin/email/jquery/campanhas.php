<!DOCTYPE html> 
<html>
<head>
	<title>Doe Sangue</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/my-styles.css" rel="stylesheet" media="screen">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"></head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
</head>
<?php
	require('config.php');
?>
<body>
	<script type='text/javascript'>

	 $(document).ready(function() { 
	    $('body').css('display', 'none');
		$('body').fadeIn(800);
	   $('input[name=radio-choice]').change(function(){
			$('form').submit();
	   });
	 });

	</script>
        
		<div data-role="content">
			<form method="get" action="registro.php">
			<?php
			echo '<div class="jumbotron">';
			$cidade=NULL; //evita que o usuário passe por um bug
			//conectar ao SQL
			$ctrl_bt_pross=1;
			if (mysql_connect($server,$username,$password)) {
				//sucesso
				if (mysql_select_db($database)) {
					//sucesso
					//Capturar cidades com campanhas disponíveis
					$query = @mysql_query('SELECT dia, num_vagas, hora_inicio, hora_final, cidade_fk FROM campanhas WHERE id ='.$_GET['campanha'].'');
					if ($query == "") {
						//nulo
						echo'<div align="center" class="page-header"><ul class="pager"></ul><h1><span class="label label-danger">Doe Sangue</span> Selecione a campanha que deseja participar: </h1></div>';
						echo '<H3 align="center">Nao foi possivel completar a operacao</H3>';
						echo '</div';
						$ctrl_bt_pross=0;
					} else {	
						//Imprimir valores na tabela
						$result = mysql_fetch_array($query);
						$vagas = $result['num_vagas'];
						$hora_inicio = strtotime($result['hora_inicio']); //hora em segundos
						$hora_final = strtotime($result['hora_final']); //hora em segundos
						$cidade = $result['cidade_fk'];
						$aux = $hora_inicio;
						$cont = 0;
						while ($aux < $hora_final) {
							$aux += 1200;
							$cont ++;
						}
						//Criar variavel post com campanha e horário
						echo '<input type="hidden" value="'.$_GET['campanha'].'" name="campanha" />'; 
						//Criar #$cont botões.
						
						$hora_atual = $hora_inicio;
						echo'<div align="center" class="page-header"><ul class="pager"></ul><font size="8"><span class="label label-danger">Doe Sangue</span> <br> Selecione o melhor horario para voce: </font></div>';
						echo '<nav class="navbar navbar-default navbar-fixed-top"><br><div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">Horario<span class="sr-only"></span></div></div></nav>';
						echo '<div class="jumbotron">';
						for ($i = 1; $i<=$cont-1; ++$i) {
							//Verificar quantas vagas ocupadas existem
							$query = mysql_query('SELECT count(horario) from reserva_horarios where reserva_horarios.campanha_fk = '.$_GET['campanha'].' AND reserva_horarios.horario = '.$i.'');
							if ($query == "") {
								//nulo
								echo 'Desculpa, não conseguimos completar a solicitação';
							} else {	
								//imprimir valor
								$result = mysql_fetch_array($query);
								if ($result[0] < $vagas) {
									//Existe #$result[0] vagas livres
									echo '<div class="input-group" align="center"><span class="input-group-addon"><input style="border-top:show;" required type="radio" aria-label="..." name="radio-choice" id="radio-choice-'.$i.'" value="'.$i.'" />';
									echo '<label for="radio-choice-'.$i.'"><h4><span class="label label-success">'.date('H:i	',$hora_atual).'</span><span class="badge">'.($vagas-$result[0]).' vagas livres.</span></label></H4></span></div><br>';
								} else {
									//Não existe nenhuma vaga livre
									echo '<div class="input-group" align="center"><span  class="input-group-addon"><input disabled type="radio" aria-label="..." name="radio-choice" id="radio-choice-'.$i.'" value="'.$i.'" />';
									echo '<label for="radio-choice-'.$i.'"><H4><span class="label label-danger">'.date('H:i	',$hora_atual).'</span><span class="badge">'.($vagas-$result[0]).'</span> vagas livres.</label></H4></span></div>';
								}
							}
							$hora_atual += 1200;
						}
						echo '</div></div></div>';
					}
				} else {echo 'Opa, tivemos problemas com a database!';}
			} else {echo 'Ops, estamos com problemas com nosso banco de dados!';}
			?>
				
			</form>
		
	
	<nav class="navbar navbar-default navbar-fixed-bottom">
			<br>	
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
					<?php	if ($cidade==NULL){
									echo '<a href="index.php" class="btn btn-danger"><span aria-hidden="true">&larr;</span> Voltar</a>';
								}else{
									//comando para que o comando voltar seja efetivo
									echo '<a href="cidades.php?cidade='.$cidade.'"  class="btn btn-danger"><span aria-hidden="true">&larr;</span> Voltar</a>';
								}?>	
					</div>	
				</div>
			<br>	
			</nav>			
	
	
		
</body>
</html>