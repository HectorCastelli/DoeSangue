<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
					$query = @mysql_query('SELECT email  FROM doadores ');
					if ($query == "") {
						echo'<div align="center" class="page-header"><ul class="pager"></ul><h1><span class="label label-danger">Doe Sangue</span><br><br>Encaminhe um e-mail para os cadastrados: </p></h1></div>';
						echo '<H3 align="center">Nao foi possivel completar a operacao</H3>';
						echo '</div>';
					}else{
						$i=0;
						echo '<div align="center" class="page-header"><ul class="pager"></ul><h1><span class="label label-danger">Doe Sangue</span> <br><br>Encaminhe um e-mail para os cadastrados: </h1><br><br>';
						echo '<form method="get" action="email-enviar.php">';
						echo '<div class="input-group"><span class="input-group-addon" id="basic-addon1">    Assunto: </span><input type="Text" name="assunto" id="assunto" class="form-control" accept="text/plain" aria-describedby="basic-addon1" ></input></div><br><br>';
						echo '<textarea  name="mensagem" cols="100" rows="20"></textarea>
							  <input type="hidden" value="'.$query.'" name="query" value=1><br><br>';
						echo '<div class="btn-group btn-group-justified" role="group" aria-label="...">
								<div class="btn-group" role="group">
									<button type="submit" value="Prosseguir" class="btn btn-success"  > enviar            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
								</div>									
							</div>';
						echo '</form></div>';
						}
					}
			}?>
			</div>
	</div>
</body>