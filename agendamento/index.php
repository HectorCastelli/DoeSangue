<!DOCTYPE html> 
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Doe Sangue</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/my-styles.css" rel="stylesheet" >
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
	   $('input[name=cidade]').change(function(){
			$('form').submit();
	   });
	 });

	</script>
	
	<div data-role="page" id="main">
		    <nav class="navbar navbar-default navbar-fixed-top"><br>
			</nav>
			<nav class="navbar navbar-default navbar-fixed-bottom"><br>
			</nav>
			<form method="get" action="cidades.php"> 
			
			<?php
			echo '<div class="jumbotron">';
			//conectar ao SQL
			if (mysql_connect($server,$username,$password)) {
				//sucesso
				if (mysql_select_db($database)) {
					//sucesso
					//Capturar cidades com campanhas disponíveis
					$query = mysql_query('SELECT id, nome FROM cidades_ativas GROUP BY nome ORDER BY nome ASC');
					if ($query == "") {
						//nulo
						echo 'Desculpa, nao temos cidades disponíveis';
					} else {	
						//Imprimir valores na lista
						echo'';
						echo '<div align="center" class="page-header"><ul class="pager"></ul><font size="8"><span class="label label-danger">Doe Sangue</span> <br>Selecione a sua cidade: </font></div>';
						$i = 0;
						while ($result = mysql_fetch_array($query)) {
							echo '<div class="input-group"><span style="border:none;" class="input-group-addon">
							<H4><input type="radio" aria-label="..." name="cidade" id="radio-choice-'.$i.'" value="'.$result['id'].'" />'.$result['nome'].'</H4></span></div><br>';
							$i++;
							
						}
						echo '</div>';
					}
				} else {echo 'Opa, tivemos problemas com a database!';}
			} else {echo 'Ops, estamos com problemas com nosso banco de dados!';}
			?>
				
				
			</form>
		</div>
	</div>
  </div>

</body>
</html>