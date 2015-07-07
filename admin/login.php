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
		$login=$_POST['login'];
		$senha=$_POST['senha'];
		//conectar ao SQL
		if (mysql_connect($server,$username,$password)) {
			//sucesso
			if (mysql_select_db($database)) {
				//sucesso
				//Capturar cidades com campanhas disponíveis
				$query = mysql_query('SELECT * FROM usuarios WHERE login = "'.$_POST['login'].'" AND senha = "'.$_POST['senha'].'"');
				if ($query == "") {
					echo 'deu ruim';
				} else {	
					//Imprimir valores na lista
					$result = mysql_fetch_array($query);
					if ($result['login'] == '') {
						echo '<p>Login falhou!</p>';
						echo '<meta http-equiv="refresh" content="3; url=index.php">';
					} else {
						$_SESSION['login'] = $_POST['login'];
						$_SESSION['senha'] = $_POST['senha'];
						$_SESSION['funcao'] = $result['funcao'];
						$_SESSION['id'] = $result['id'];
						echo '<p align="center">Usuário: '.$_SESSION['login'].' logado com sucesso!</p>';
						echo '<meta http-equiv="refresh" content="3; url=painel.php">';
					}
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