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
			<h1>Acessando campanhas que fun&ccedil;&atilde;o <?php echo $_SESSION['funcao']; ?> pode acessar. </h1>
		</div>
		<div data-role="content">
			<form method="post" action="adicionar.php">
				<?php
				if ($_SESSION['funcao'] == 0) {
					//conectar ao SQL
					if (mysql_connect($server,$username,$password)) {
						//sucesso
						if (mysql_select_db($database)) {
							//sucesso
							//Capturar campanhas disponiveis para funcao
							$query = mysql_query('SELECT id, nome FROM cidades GROUP BY nome ORDER BY nome ASC');
							if ($query == "") {
								//nulo
								echo 'Desculpa, não temos cidades a serem visualizadas';
							} else {	
								//Imprimir valores na lista
								echo '<label for="funcao" class="select">Selecione sua cidade</label>';
								echo '<select id="funcao" name="funcao">';
								while ($result = mysql_fetch_array($query)) {
									echo '<option value="'.$result['id'].'">'.$result['nome'].'</option>';
								}
								echo '</select>';
							}
							//mostrar seleçao de gestor
							$query2 = mysql_query('SELECT id, login FROM usuarios ORDER BY login ASC');
							if ($query2 == "") {
								//nulo
								echo 'Desculpa, não temos gestores a serem visualizados';
							} else {	
								//Imprimir valores na lista
								echo '<label for="gestor" class="select">Selecione seu gestor</label>';
								echo '<select id="gestor" name="gestor">';
								while ($result2 = mysql_fetch_array($query2)) {
									echo '<option value="'.$result2['id'].'">'.$result2['login'].'</option>';
								}
								echo '</select>';
							}
						} else {echo 'Opa, tivemos problemas com a database!';}
					} else {echo 'Ops, estamos com problemas com nosso banco de dados!';}
				} else {
					echo '<input type="hidden" value="'.$_SESSION['funcao'].'" name="funcao" id ="funcao">';
				 	echo '<input type="hidden" value="'.$_SESSION['id'].'" name="gestor" id="gestor">';
				}
				?>
				<div data-role="fieldcontain">
				    <label for="data">Data: </label>
				    <input type="date" name="data" id="data" value=""/>
				</div>
				<div data-role="fieldcontain">
				    <label for="inicio">Hor&aacute;rio de in&iacute;cio: </label>
				    <input type="time" name="inicio" id="inicio" value=""/>
				</div>
				<div data-role="fieldcontain">
				    <label for="fim">Hor&aacute;rio de T&eacute;rmino: </label>
				    <input type="time" name="fim" id="fim" value=""/>
				</div>	
				<div data-role="fieldcontain">
				    <label for="macas">N&uacute;mero de macas (dispon&iacute;veis para reserva): </label>
				    <input type="number" name="macas" id="macas" value=""/>
				</div>
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