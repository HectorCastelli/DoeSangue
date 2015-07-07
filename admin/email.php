<?php
	session_start();
	if ($_SESSION['login'] == '') {
		echo 'Acesso incorreto!';
		header('Location: index.php');
	}
	require('config.php');
		if (!empty($_POST))
			$index = $_POST['dia'];
		else
			$index = 1;
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Doe Sangue</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/my-styles.css" rel="stylesheet" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"></head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
</head>
<body>
	<script type='text/javascript'>
	 $(document).ready(function() { 
	    $('body').css('display', 'none');
		$('body').fadeIn(800);	
	 });
	 
	 
	</script>
        
		<div data-role="content">
			<?php
			echo '<div class="jumbotron">';
			$cidade=NULL; //evita que o usuário passe por um bug
			//conectar ao SQL
			$ctrl_bt_pross=1;
			echo'<div align="center" ><h3>Encaminhe um e-mail para os cadastrados: </p></h3></div>';

			if (mysql_connect($server,$username,$password)) {
				//sucesso
				if (mysql_select_db($database)) {
					//sucesso
					?>
					<nav class="navbar navbar-inverse navbar-fixed-top">
						<br>
					  	<p align="center"><a href="painel.php" style="text-decoration: none"><img src="./css/Logo Doe Sangue.png" ></a>	</p>
					  
					</nav>
					<?php
					//Rotina para que a campanha seja selecionada antes do e-mail ser
					if (!empty($_GET)){
						$funcao=$_GET['i'];
						$ID=$_GET['f'];
					}else{
						$ID=$_POST['id'];
						$funcao=$_POST['funcao'];
					}
					
					if (@$funcao==0 ){
					$query = @mysql_query('SELECT id,dia FROM campanhas WHERE ativa="1" ');
					echo '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post"><div class="input-group">';
					echo '<input type="hidden" id="funcao" name="funcao" value="'.$funcao.'">';
					echo '<input type="hidden" id="id" name="id" value="'.$ID.'">';
					echo '<span class="input-group-addon" id="basic-addon1">Campanha: </span>';
					echo '<select class="form-control" data-width="auto" id="dia" name="dia" onchange="$(this.form).trigger('."'submit'".');">';
					echo '<option value=" " selected> Selecione o dia da campanha:</option>';											
					while ($result = mysql_fetch_array($query)) {
						if (($result['id']==$_POST['dia'])&&(!empty($_POST)))
							echo '<option value="'.$result['id'].'" selected>'.$result['dia'].'</option>';
						else
							echo '<option value="'.$result['id'].'" >'.$result['dia'].'</option>';
					}	
					echo '</select>';
					echo'</div><br></form>';}
					else{
					$query = @mysql_query('SELECT id,dia FROM campanhas WHERE ativa="1" AND gestor='.$ID.'');
					echo '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post"><div class="input-group">';
					echo '<input type="hidden" id="funcao" name="funcao" value="'.$funcao.'">';
					echo '<input type="hidden" id="id" name="id" value="'.$ID.'">';
					echo '<span class="input-group-addon" id="basic-addon1">Campanha: </span>';
					echo '<select class="form-control" data-width="auto" id="dia" name="dia" onchange="$(this.form).trigger('."'submit'".');">';
					echo '<option value=" " selected> Selecione o dia da campanha:</option>';
					while ($result = mysql_fetch_array($query)) {
						if (($result['id']==$_POST['dia'])&&(!empty($_POST)))
							echo '<option value="'.$result['id'].'" selected>'.$result['dia'].'</option>';
						else
							echo '<option value="'.$result['id'].'" >'.$result['dia'].'</option>';
					}	
					echo '</select>';
					echo'</div><br></form> ';}
					}
					if (@!empty($_POST)){
					$query = mysql_query('SELECT email  FROM reservas_horarios_doadores where campanha_fk="'.$_POST['dia'].'"');
						if ($query == "") {
							echo '<H3 align="center">Nao foi possivel completar a operacao</H3>';
							echo '</div>';
						}else{
							$i=0;
							echo '<form method="get" action="email-enviar.php">';
							echo '<div class="input-group"><span class="input-group-addon" id="basic-addon1">Assunto  :</span><input type="Text" name="assunto" id="assunto" class="form-control" accept="text/plain" aria-describedby="basic-addon1" ></input></div><br><br>';
							echo '<textarea  name="mensagem" class="form-control"  rows="5"></textarea>
								  <input type="hidden" value="'.$query.'" name="query" value=1><br><br>';
							echo '<div class="btn-group btn-group-justified" role="group" aria-label="...">
									<div class="btn-group" role="group">
										<button type="submit" value="Prosseguir" class="btn btn-success"  > enviar            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
									</div>									
								</div>';
							echo '</form></div>';
							}
					}	
					}
			?>
			
			</div>
	</div>
</body>