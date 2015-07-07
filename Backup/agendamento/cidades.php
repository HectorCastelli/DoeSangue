<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Doe Sangue</title>
	<link href="css/my-styles.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
			
	   $('input[name=campanha]').change(function(){
			$('form').submit();
	   });
	 });
	 

	</script>   
	<div data-role="page" id="main">
		<div data-role="header">
			</div>
		<div data-role="content">
			<form method="get" action="campanhas.php"> 
			<?php
			echo '<div class="jumbotron">';
			$ctrl_bt_pross=1;
			//conectar ao SQL
			if (mysql_connect($server,$username,$password)) {
				//sucesso
				if (mysql_select_db($database)) {
					//sucesso
					//Capturar cidades com campanhas disponíveis
					$query = @mysql_query('SELECT id, dia FROM campanhas_ativas WHERE cidade_fk ='.$_GET['cidade'].'');
					if (!$query) {
						echo'<div align="center" class="page-header"><ul class="pager"></ul><font size="8"><span class="label label-danger">Doe Sangue</span><br> Selecione a campanha que deseja participar: </font></div>';
						echo '<H3 align="center">Nao foi possivel completar a operacao</H3>';
						echo '</div>';
						$ctrl_bt_pross=0;
						
					} else{
						echo'<div align="center" class="page-header"><ul class="pager"></ul><font size="8"><span class="label label-danger">Doe Sangue</span><br> Selecione o dia da campanha que deseja participar: </font></div>';
						echo '<nav class="navbar navbar-default navbar-fixed-top"><br><div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Campanha<span class="sr-only"></span></div></div></nav>';
						echo '<div class="jumbotron">';
						$i = 0;
						while ($result = mysql_fetch_array($query)) {
							echo '<div class="input-group"><span style="border:none;" class="input-group-addon">
							<H4><input  type="radio" aria-label="..." name="campanha" id="radio-choice-'.$i.'" value="'.$result['id'].'" /><label for="radio-choice-'.$i.'">'.date('d/m/Y', strtotime($result['dia'])).'</label></H4></span></div><br>';
							$i++;
						}}
					
				} else {echo 'Opa, tivemos problemas com a database!';}
			} else {echo 'Ops, estamos com problemas com nosso banco de dados!';}
			?>
			</div>
			</form>
			

			
		</div>
		
	</div>
	<nav class="navbar navbar-default navbar-fixed-bottom">
			<br>	
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a href="index.php" class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>            Voltar</a>
						
					</div>	
				</div>
			<br>	
			</nav>	
	</body>
</html>