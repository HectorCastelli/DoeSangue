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
		</div>
		<div data-role="content">
			<?php
			//echo $_GET['i'];
			//conectar ao SQL
			if (mysql_connect($server,$username,$password)) {
				//sucesso
				if (mysql_select_db($database)) {
					//sucesso
					//Capturar campanhas disponiveis para funcao
					if ($_GET['i'] <> 0) {
						echo '<p>Desculpe, você não é administrador.</p>';
					} else {
						$query = mysql_query('SELECT * FROM usuarios');
						if ($query == "") {
							//nulo
							echo 'Desculpa, não temos gestores a serem visualizados';
						} else {	
							//Imprimir valores na lista
							print ('<table align="center" border="1" cellspacing="2" cellpading="2" bordercolor="000000"><tr><th>ID</th><th>LOGIN</th><th>FUNCAO</th><th>EMAIL</th><th>TELEFONE</th></tr>');
							while ($result = mysql_fetch_array($query)) {
								echo '<tr>';
								echo '<td>'.$result['id'].'</td>';
								echo '<td>'.$result['login'].'</td>';
								echo '<td>'.$result['funcao'].'</td>';
								echo '<td>'.$result['email'].'</td>';
								echo '<td>'.$result['telefone'].'</td>';
								echo '<td><a href="excluir.php?i='.$result['id'].'">Excluir</a></td>';
								echo '</tr>';
							}
							print ('</table>');
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