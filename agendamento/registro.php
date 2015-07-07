<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Doe Sangue</title>
	<script src="./JQuery/jquery-1.10.2.min.js"></script>
	<link href="css/my-styles.css" rel="stylesheet" media="screen">
	<script src="./JQuery/jquery.maskedinput.min.js" type="text/javascript"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	</head>
<?php
	
	require('config.php');
	
?>
<body>
	
	
	<div class="jumbotron">
	<div align="center" class="page-header"><ul class="pager"></ul><font size="8"><span class="label label-danger">Doe Sangue</span><br> Cadastre seus dados: </font></div>
	<nav class="navbar navbar-default navbar-fixed-top"><br><div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">Cadastro<span class="sr-only"></span></div></div></nav>
			<?php 
			error_reporting(0);
			ini_set(“display_errors”, 0 );
			$resultado= $_GET['radio-choice'];
			if ( $resultado==NULL){
				echo' Nao foi possivel completar a operacao <BR> 
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a href="index.php " class="btn btn-default"><span aria-hidden="true">&larr;</span> Voltar</a>
					</div></div>';
			}else{?>								
			<p style="color:#ff0000;">Utilize CPF válido.</p>	
			<form method="post" action="efetuar.php">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">    Nome: </span>
					<input required type="text" class="form-control" name="nome" id="nome" accept="text/plain" aria-describedby="basic-addon1">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">  CPF:   </span>
				    <input required type="text" class="form-control" name="cpf" id="cpf" aria-label="..." value=""/>
				</div>
				<br>	
				<div class="input-group">
				    <span class="input-group-addon" id="basic-addon1"> Telefone:</span>
				    <input class="form-control" type="text" name="telefone" id="telefone" value=""/>
				</div>
				<br>	
				<div class="input-group">
				    <span class="input-group-addon" id="basic-addon1"> E-mail</span>
				    <input required class="form-control" type="email" name="email" id="email" value=""/>
				</div>
				
				
				<br>
				
			
	</div>
	<nav class="navbar navbar-default navbar-fixed-bottom">
		<br>
			
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a href="campanhas.php?campanha=<?php echo $_GET['campanha']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>           Voltar</a>
					</div>
					<div class="btn-group" role="group">
						<button type="submit" value="Prosseguir" class="btn btn-success"  > Prosseguir            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
					</div>									
				</div>
				<br>
	</nav>			
				<input type="hidden" name="vaga" value="<?php echo $_GET['radio-choice']; ?>" />
				<br>
				<input type="hidden" name="campanha" value="<?php echo $_GET['campanha']; ?>" />	
				<br>
				
			</form><?php }?>
	<script type="text/javascript">
	 jQuery(function($){
		$("#cpf").mask("999.999.999-99",{placeholder:"_"});
		$("#telefone").mask("(99)99999999?9",{placeholder:"_"});
	 });
	 $(document).ready(function() { 
	    $('body').css('display', 'none');
		$('body').fadeIn(800);
		<?php	
			if ($_GET['invalid']==1){					
				echo'alert(\'CPF inválido.\');';
		}?>});
	</script>		
</body>
</html>