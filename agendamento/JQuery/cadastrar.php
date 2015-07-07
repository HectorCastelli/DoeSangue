<html>
<head>
	<title>Doe Sangue</title>
	<script src="./JQuery/jquery-1.10.2.min.js"></script>
	<script src="./JQuery/jquery.maskedinput.min.js" type="text/javascript"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/my-styles.css" rel="stylesheet" media="screen">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"></head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
	require('config.php');
?>
<body>
	<div id="fb-root"></div>
		<div id="fb-root"></div>
	<div data-role="page" id="main">
		<div data-role="header">
			<div align="center" class="page-header"><ul class="pager"></ul><h1><span class="label label-danger">Doe Sangue</span> Parab&eacute;ns!!! </h1></div>
	    </div>
		<div class="jumbotron">
			<div data-role="content">		
				<?php
					//conectar ao SQL
					$cidade = trim($_POST['cidade']);
					$data = $_POST['data'];
					$data = $data[6].$data[7].$data[8].$data[9].$data[2].$data[3].$data[4].$data[5].$data[0].$data[1];
					$h_i1 = $_POST['h_i1'];
					$h_i1 = $h_i1[0].$h_i1[1].$h_i1[2].$h_i1[3].$h_i1[4]; //Retira máscara da hora inicial
					$h_i1=$h_i1.":00";
					$h_i2 = $_POST['h_i2'];
					$h_i2 = $h_i2[0].$h_i2[1].$h_i2[2].$h_i2[3].$h_i2[4];//Retira máscara da hora final
					$h_i2=$h_i2.":00";
					$telefone = $_POST['telefone'];
					$email = $_POST['email'];
					$num_vagas = $_POST['num_vagas'];
			
					if (mysql_connect($server,$username,$password)) {
						//sucesso
						if (mysql_select_db($database)) {
							//sucesso
							//insere cidade
							$query = 'INSERT INTO cidades (nome) VALUES ("'.$cidade.'");';
							$result = mysql_query($query);	
							if ($result) {
								$query1= 'SELECT * FROM cidades WHERE nome like "%'.$cidade.'%";';
								$result12 = mysql_query($query1);	
								$result12 = mysql_fetch_assoc($result12);
								$query2 = 'INSERT INTO campanhas (dia,cidade_fk,num_vagas,hora_inicio,hora_final,ativa) VALUES ("'.$data.'", '.$result12['id'].','.$num_vagas.',"'.$h_i1.'","'.$h_i2.'",1);';							
								$result2 = mysql_query($query2);
								if ($result2) {
									//Sucesso!
									echo '<H3 align="center"> Campanha cadastrada com sucesso! </H2>';
									
								}else{
										echo '<H3 align="center"> Não foi possível concluir o cadastro.</H2>';
								}
							}
						} 
					
					
					}
					
				?>
			</div>
		</div>
	</div>
		
</body>
</html>								