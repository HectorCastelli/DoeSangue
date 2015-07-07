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
			<a href="#main" data-role="button" data-icon="back" data-mini="true" data-inline="true" data-enable="false">Voltar</a>
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
				$query = mysql_query('SELECT dia, num_vagas, hora_inicio, hora_final, nome, gestor FROM campanhas_ativas WHERE id ='.$_GET['campanha'].'');
				if ($query == "") {
					//nulo
					echo 'Desculpa, não temos campanhas disponíveis';
				} else {	
					//Imprimir valores na tabela
					$result = mysql_fetch_array($query);
					echo '<font face="arial" size="4"><p><strong>Dia:</strong>'.date('d/m/Y', strtotime($result['dia'])).' &#8212; <strong>Cidade:</strong> '.$result['nome'].' &#8212; <strong>Gestor:</strong> '.$result['gestor'].'</p></font>';
					$vagas = $result['num_vagas'];
					$hora_inicio = strtotime($result['hora_inicio']); //hora em segundos
					$hora_final = strtotime($result['hora_final']); //hora em segundos
					$aux = $hora_inicio;
					$cont = 0;
					while ($aux < $hora_final) {
						$aux += 1200;
						$cont ++;
					}
					//Criar #$cont botões.
					echo '<font face="arial" size="2"><ul data-role="listview">';
					$hora_atual = $hora_inicio;
					for ($i = 1; $i<=$cont; $i++) {
						//Verificar quantas vagas ocupadas existem e quem sao
						echo '<li data-role="list-divider">'.date('H:i	',$hora_atual).'</li>';
						$query = mysql_query('SELECT * from reservas_horarios_doadores where campanha_fk = '.$_GET['campanha'].' AND horario = '.$i.'');
						if ($query == "") {
							//nulo
							echo 'Desculpa, não conseguimos completar a solicitação';
						} else {	
							//imprimir valor
							while ($result = mysql_fetch_array($query)) {
								echo '<li><strong>Nome:</strong> '.$result['nome'].' &#8212; <strong>E-Mail:</strong> '.$result['email'].' &#8212; <strong>Telefone:</strong> '.$result['telefone'].'</li>';
							}
						}
						$hora_atual += 1200;
					}
					echo '</ul></font>';
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
		<div data-role="footer">
			<h4></h4>
		</div>
	</div>
</body>
</html>