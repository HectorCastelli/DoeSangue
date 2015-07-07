
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
	<?php
	session_start();
	if ($_SESSION['login'] == '') {
		echo 'Acesso incorreto!';
		header('Location: index.php');
	}
	?>
	<div data-role="page" id="main">
		<div data-role="header">
			<h1>Doe Sangue - Painel</h1>
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" data-enable="false" style="display: none;">Voltar</a>
			<h1>Bem vindo, <?php echo $_SESSION['login']; ?>!</h1>
			<a href="#ajuda" data-role="button" data-icon="info" data-mini="true" data-inline="true" >Ajuda</a>
			<h1>Acessando campanhas que fun&ccedil;&atilde;o <?php echo $_SESSION['funcao']; ?> pode acessar. </h1>
		</div>
		<div data-role="content">
			<form method="post" action="editar_action.php">
				<?php
				$y=0;
				if ($_SESSION['funcao'] == 0) {
					//conectar ao SQL
					if (mysql_connect($server,$username,$password)) {
						//sucesso
						if (mysql_select_db($database)) {
							//sucesso
							//Pega os dados referentes a campanha selecionada anteriormente
							$query1 = mysql_query('select dia,cidade_fk,num_vagas,hora_inicio,hora_final,gestor from campanhas where id='.$_GET['campanha'].'');
							if ($query1 == "") {
								//nulo
								echo 'Desculpa, campanha inacessível';
							} else {	
								//mostra os valores que estão no banco
								$result = mysql_fetch_array($query1);								
								echo '<input type="hidden" value="'.$_GET['campanha'].'" name="campanha" id="campanha">';				 											
								echo '<div data-role="fieldcontain">
				  					  <label for="data">Data: </label>
				  	 	 					<input type="date" name="data" id="data" value="'.$result['dia'].'"/>
											</div>
									<div data-role="fieldcontain">
				  				  		<label for="macas">N&uacute;mero de macas (dispon&iacute;veis para reserva): </label>
				 	 			 		 <input type="number" name="macas" id="macas" onchange="VerificadorMacas()" value="'.$result['num_vagas'].'"/>
									</div>';
							}
														
							$query2 = mysql_query('SELECT id, login FROM usuarios ORDER BY login ASC');
							if ($query2 == "") {
								//nulo
								echo 'Desculpa, não temos gestores a serem visualizados';
							} else {	
								//Lista de gestores, com o gestor antigo já selecionado:
								echo '<label for="gestor" class="select">Selecione seu gestor</label>';
								echo '<select id="gestor" name="gestor">';
								while ($result2 = mysql_fetch_array($query2)) {
									if ($result2['id']==$result['gestor']){
										echo '<option value="'.$result2['id'].'" selected>'.$result2['login'].'</option>';}
									else 
										echo '<option value="'.$result2['id'].'">'.$result2['login'].'</option>';	
								}
								echo '</select>
										<input type="submit" value="Prosseguir" data-theme="a"/>
										</form>';
							}
							
						} else {echo 'Opa, tivemos problemas com a database!';}
					} else {echo 'Ops, estamos com problemas com nosso banco de dados!';}
				} else {
				//para não administradores, temos:
				if (mysql_connect($server,$username,$password)) {
					//sucesso
						if (mysql_select_db($database)) {
							//sucesso
							//Pega os dados referentes a campanha selecionada anteriormente
							$query1 = mysql_query('select dia,cidade_fk,num_vagas,hora_inicio,hora_final,gestor from campanhas where id='.$_GET['campanha'].'');
							if ($query1 == "") {
								//nulo
								echo 'Desculpa, campanha inacessível';
							} else {	
								
							echo '<input type="hidden" value="'.$_SESSION['funcao'].'" name="funcao" id ="funcao">';
						 	echo '<input type="hidden" value="'.$_SESSION['id'].'" name="gestor" id="gestor">';	
							echo '<input type="hidden" value="'.$_GET['campanha'].'" name="campanha" id="campanha">';				 			
				 			$result = mysql_fetch_array($query1);								
							echo '		<div data-role="fieldcontain">
				  							  <label for="data">Data: </label>
				  	 	 						<input type="date" name="data" id="data" value="'.$result['dia'].'"/>
											</div>
											<div data-role="fieldcontain">
											    <label for="inicio">Hor&aacute;rio de in&iacute;cio: </label>
									 		   <input type="time" name="inicio" id="inicio" value="'.$result['hora_inicio'].'"/>
											</div>
											<div data-role="fieldcontain">
									    		<label for="fim">Hor&aacute;rio de T&eacute;rmino: </label>
		 									    <input type="time" name="fim" id="fim" value="'.$result['hora_final'].'"/>
											</div>	
											<div data-role="fieldcontain">
							  				  <label for="macas">N&uacute;mero de macas (dispon&iacute;veis para reserva): </label>
							 	 			  <input type="number" name="macas" id="macas" onchange="VerificadorMacas()" value="'.$result['num_vagas'].'"/>
											</div>
											<input type="submit" value="Prosseguir" data-theme="a"/>
										</form>';			
				}}}}
				$query3= mysql_query('SELECT COUNT(horario) FROM reserva_horarios where campanha_fk='.$_GET['campanha'].' GROUP BY horario');//seleciona apenas os horarios da campanha selecionada
				if ($query3==''){
					echo 'Banco de dados indisponível no momento! ';
				}else{
				$result3 = mysql_fetch_assoc($query3);
				$y=$result3["COUNT(horario)"];	
				}				
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
	<?php	
	echo '<script>'; //para que haja a correta comunicação entre o PHP e o Banco de Dados.
	echo	'
	window.onload = function(){if(window.name!="first")	window.location.reload();window.name = "first"};
	function VerificadorMacas(){
		var x='.$y.'				
		if ((document.getElementById("macas").value)<x){
			document.getElementById("macas").value=x;
		}
		
	}';	
	echo 	'</script>';
	?>
</body>
</html>