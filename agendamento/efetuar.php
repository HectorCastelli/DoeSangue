<!DOCTYPE html> 
<?php
require('cpf.php');
			if ( valida_cpf( $_POST['cpf'] ) ) {	
			
		
		?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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


		
		<div class="jumbotron">
			<div align="center" class="page-header"><ul class="pager"></ul><h1><span class="label label-danger">Doe Sangue</span> <br><br>Parab&eacute;ns!!! </h1></div>
	        <nav class="navbar navbar-default navbar-fixed-top"><br><div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">Concluido!!!<span class="sr-only"></span></div></div></nav>
		
			
		<div data-role="content">		
			<?php
			//conectar ao SQL
			$cpf = $_POST['cpf'];
			$cpf = $cpf[0].$cpf[1].$cpf[2].$cpf[4].$cpf[5].$cpf[6].$cpf[8].$cpf[9].$cpf[10].$cpf[12].$cpf[13]; //Retira máscara do CPF
			$nome = $_POST['nome'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$campanha = $_POST['campanha'];
			$vaga = $_POST['vaga'];
			
			if (mysql_connect($server,$username,$password)) {
				//sucesso
				if (mysql_select_db($database)) {
					//sucesso
					//Verificar se o CPF já existe no banco de dados;
					$query = 'SELECT id from doadores WHERE cpf = '.$cpf.';';
					$result1 = mysql_query($query);
					$result = mysql_fetch_array($result1);
					if ($result[0] != '') {
						//Sucesso! Atualizar campos
						$query2 = 'UPDATE doadores SET nome="'.$nome.'", telefone="'.$telefone.'", email="'.$email.'" WHERE  cpf='.$cpf.';';						
					} else {
						//Falha, inserir novo campo
						$query2 = 'INSERT INTO doadores (cpf, nome, telefone, email) VALUES ('.$cpf.', "'.$nome.'", "'.$telefone.'", "'.$email.'");';
					}
					$result2 = mysql_query($query2);
					if ($result2) {
						//Sucesso! Selecionar id do doador
						$query3 = 'SELECT id FROM doadores WHERE cpf = '.$cpf.';';
						$result3 = mysql_query($query3);
						if ($result3) {
							//Sucesso! Adicionar doador!
							$result31 = mysql_fetch_array($result3);
							$doador_fk = $result31[0];		 
							$query4 = 'Insert INTO reservas (campanha_fk, doador_fk, horario) VALUES ('.$campanha.', '.$doador_fk.', '.$vaga.');';
							$result4 = mysql_query($query4);
							if ($result4) {
								//Sucesso!
								echo '<p align="center">Voce se registrou com sucesso! Enviamos um e-mail para você com a confirmação dos dados.</p>';
								echo '<BR> <BR>';
								echo '<div align="center"><div align="center" class="fb-share-button" data-href="http://www2.feg.unesp.br/#!/doesangue" data-type="button"></div></div>';
								echo '<BR> <BR> <BR> <BR>';
								echo '<div align="center"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www2.feg.unesp.br/#!/doesangue" data-text="Eu doarei sangue, doe você também!!!" data-lang="pt" data-count="none" data-hashtags="DoeSangue">Compartilhar no Twitter</a></div>';	
								//Enviando E-Mail
								$to = $email;
								$subject = 'Registro DoeSangue';
								$headers = "From: " . strip_tags('doesangue@feg.unesp.br') . "\r\n";
								$headers .= "Reply-To: ". strip_tags('doesangue.guara@gmail.com') . "\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								
								$message = '<html><body><p>Parab&eacute;ns, voc&ecirc; se registrou com sucesso!</p><br>';
								$message .= 'Nome: '.$nome.'<br>';
								
								//Verificar cidade e horário de registro.
								$query5 = mysql_query('SELECT nome, dia, hora_inicio FROM campanhas_ativas  WHERE id = '.$campanha.';');
								while ($result5 = mysql_fetch_array($query5)) {
									$message .= 'Cidade: '.$result5['nome'].'<br>';
									$message .= 'Data: '.date('d/m/Y',strtotime($result5['dia'])).'<br>';
									$hora_atual = strtotime($result5['hora_inicio']);
									$hora_atual += (1200)*($vaga-1);
									$message .= 'Hor&aacute;rio: '.date('H:i',$hora_atual).'<br>';
								}
								$message .= '';
								$message .= '</body></html>';
								mail($to, $subject, $message, $headers);
								//Enviando E-Mail para o responsável
								$toadm = $email;
								$toadm = strip_tags('caiohf2009@hotmail.com');
								$subjectadm = 'Novo Doador - DoeSangue';
								$headersadm = "From: " . strip_tags('doesangue@feg.unesp.br') . "\r\n";
								$headersadm .= "MIME-Version: 1.0\r\n";
								$headersadm .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								$messageadm = '<html><body><p>O seguinte usuário foi registrado:</p><br>';
								$messageadm .= 'Nome: '.$nome.'<br>';
								$messageadm .= 'CPF: '.$cpf.'<br>';
								//Verificar cidade e horário de registro.
								$query5 = mysql_query('SELECT nome, dia, hora_inicio FROM campanhas_ativas  WHERE id = '.$campanha.';');
								while ($result5 = mysql_fetch_array($query5)) {
									$messageadm .= 'Cidade: '.$result5['nome'].'<br>';
									$messageadm .= 'Data: '.date('d/m/Y',strtotime($result5['dia'])).'<br>';
									$hora_atual = strtotime($result5['hora_inicio']);
									$hora_atual += (1200)*($vaga-1);
									$messageadm .= 'Hor&aacute;rio: '.date('H:i',$hora_atual).'<br>';
								}
								$messageadm .= '';
								$messageadm .= '</body></html>';
								mail($toadm, $subjectadm, $messageadm, $headersadm);
								
							} else {
								//Erro!
								echo '<p>Desculpe, não conseguimos processar sua requisição</p>';
							}
						} else {
							//Erro!
							echo '<p>Desculpe, não coneguimos processar seu registro</p>';
						}
					} else {
						//Falha! Retornar!
						echo '<p>Desculpe, não conseguimos completar seu registro,volte para o início</p>
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a href="index.php" class="btn btn-default"><span aria-hidden="true">&larr;</span> Voltar</a>
					</div></div>';
						
					}
				}
			}				
			
		echo '<fieldset data-role="controlgroup" >';?>	
		<br> 
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		
	</div>
	<nav class="navbar navbar-default navbar-fixed-bottom">
		<br>
			
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a href="http://www2.feg.unesp.br/#!/doesangue" class="btn btn-danger "><span class="glyphicon glyphicon-home" aria-hidden="true"></span>           Página Principal</a>
					</div>
					<div class="btn-group" role="group">
						<a href="https://www.facebook.com/Doesangue.guara/" class="btn btn-danger ">Facebook da campanha          <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
					</div>									
				</div>
				<br>
	</nav>		
	<?php
	} else{
					header("location:registro.php?campanha=".$_POST['campanha']."&radio-choice=".$_POST['vaga']."&invalid=1");
					
			}
	?>
	<div id="fb-root"></div>
	<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=236759163171393";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	$(document).ready(function() { 
			$('body').css('display', 'none');
			$('body').fadeIn(800);
		  if (window.history && window.history.pushState) {

			$(window).on('popstate', function() {
			  var hashLocation = location.hash;
			  var hashSplit = hashLocation.split("#!/");
			  var hashName = hashSplit[1];

			  if (hashName !== '') {
				var hash = window.location.hash;
				if (hash === '') {
					window.location='index.php';
					return false;
				}
			  }
			});

			window.history.pushState('forward', null, './#forward');
		  }

		});
	// slight update to account for browsers not supporting e.which
	function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
	// To disable f5
		/* jQuery < 1.7 */
	$(document).bind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	$(document).on("keydown", disableF5);

	// To re-enable f5
		/* jQuery < 1.7 */
	$(document).unbind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	$(document).off("keydown", disableF5);	
	</script>

</body>
</html>