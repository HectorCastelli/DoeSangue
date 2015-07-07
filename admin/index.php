<!DOCTYPE html> 
<html>
<head>
	<title>Doe Sangue</title>
	<link href="css/my-styles.css" rel="stylesheet" >	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./JQuery/jquery.mobile.structure-1.3.2.min.css" />
	<link rel="stylesheet" href="./JQuery/jquery.mobile.theme-1.3.2.min.css" />
	<script src="./JQuery/jquery-1.10.2.min.js"></script>
	<script src="./JQuery/jquery.mobile-1.3.2.min.js"></script>
	<script src="./JQuery/jquery.maskedinput.min.js" type="text/javascript"></script>
	<link href="css/my-styles.css" rel="stylesheet" media="screen">	
</head>
<?php
	require('config.php');
?>
<body>
	
	<div data-role="page" id="main">
		<div data-role="header">
			<p align="center"><img src="./css/Logo Doe Sangue.png" style="align=center"></p>
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" data-enable="false" style="display: none;">Voltar</a>
			<a href="#ajuda" data-role="button" data-icon="info" data-mini="true" data-inline="true" >Ajuda</a>
		</div>
		<div data-role="content">
			<form method="post" action="login.php"> 
				<label for="login">Insira seu login</label>
				<input id="login" name="login" type="text">
				<label for="senha">Insira sua senha</label>
				<input id="senha" name="senha" type="password">
				<input type="submit" value="Prosseguir" data-theme="a"/>
			</form>
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