<?php
	session_start();
	if ($_SESSION['login'] == '') {
		echo 'Acesso incorreto!';
		header('Location: index.php');
	}
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
			<h1>Doe Sangue - Painel</h1>
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" data-enable="false" style="display: none;">Voltar</a>
			<h1>Bem vindo, <?php echo $_SESSION['login']; ?>!</h1>
			<a href="#ajuda" data-role="button" data-icon="info" data-mini="true" data-inline="true" >Ajuda</a>
			<h1>Acessando gestores que fun&ccedil;&atilde;o <?php echo $_SESSION['funcao']; ?> pode acessar. </h1>
		</div>
		<div data-role="content">
			<p>
				<a href="./gestor/novo.php?>" data-role="button" data-icon="info" data-inline="true">Adicionar Gestor</a>
				<a href="./gestor/listar.php?i=<?php echo $_SESSION['funcao']; ?>" data-role="button" data-icon="info" data-inline="true">Listar Gestores</a>
			</p>
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
	

	<div data-role="page" id="dados">
		<div data-role="header">
			<h1>Doe Sangue - Ajuda</h1>
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" >Voltar</a>
			<a href="#ajuda" data-role="button" data-icon="info" data-mini="true" data-inline="true" >Ajuda</a>
		</div>
		<div data-role="content">
			<p>Login:<?php echo $_SESSION['login']; ?><br />Senha:<?php echo $_SESSION['senha']; ?><br />Fun&ccedil;&atilde;o:<?php echo $_SESSION['funcao']; ?></p>
		</div>
		<div data-role="footer">
			<h4></h4>
		</div>
	</div>
</body>
</html>