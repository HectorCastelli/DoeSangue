<?php
	session_start();
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Doe Sangue</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./JQuery/jquery.mobile.structure-1.3.2.min.css" />
	<link rel="stylesheet" href="./JQuery/jquery.mobile.theme-1.3.2.min.css" />
	<script src="./JQuery/jquery-1.10.2.min.js"></script>
	<script src="./JQuery/jquery.mobile-1.3.2.min.js"></script>
	<script src="./JQuery/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<?php
	require('config.php');
?>
<body>
	<div data-role="page" id="main">
		<div data-role="header">
			<h1>Doe Sangue</h1>
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" data-enable="false" style="display: none;">Voltar</a>
			<a href="#ajuda" data-role="button" data-icon="info" data-mini="true" data-inline="true" >Ajuda</a>
		</div>
		<div data-role="content">
		<?php
		//conectar ao SQL
		if (mysql_connect($server,$username,$password)) {
			//sucesso
			if (mysql_select_db($database)) {
				//sucesso
				//Capturar cidades com campanhas disponíveis
				$query = mysql_query('DELETE FROM usuarios WHERE  id='.$_GET['i'].';');
				if (!$query) {
					//nulo
					echo '<p>Não foi possível excluir o gestor!</p>';
				} else {	
					//Imprimir valores na lista
					echo '<p>Excluido com sucesso!</p>';
					echo '<meta http-equiv="refresh" content="2; url=../painel.php">';
				}
			} else {echo 'Opa, tivemos problemas com a database!';}
		} else {echo 'Ops, estamos com problemas com nosso banco de dados!';}
	?>	
		</div>
		<div data-role="footer">
			<h4></h4>
		</div>
	</div>
	
	
	<div data-role="page" id="ajuda">
		<div data-role="header">
			<h1>Doe Sangue - Ajuda</h1>
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" >Voltar</a>
			<a href="#ajuda" data-role="button" data-icon="info" data-mini="true" data-inline="true" >Ajuda</a>
		</div>
		<div data-role="content">

		</div>
		<div data-role="footer">
			<h4></h4>
		</div>
	</div>
</body>
</html>