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
<?php
					$mensagem=$_GET['mensagem'];
					if (mysql_connect($server,$username,$password)) {
					if (mysql_select_db($database)) {
					$query = @mysql_query('SELECT email  FROM doadores ');while ($result = mysql_fetch_array($query)) {
							$to = $result['email'];
							$subject = $_GET['assunto'];
							$headers = "From: " . strip_tags('doesangue@feg.unesp.br') . "\r\n";
							$headers .= "Reply-To: ". strip_tags('doesangue.guara@gmail.com') . "\r\n";
							$headers .= "MIME-Version: 1.0\r\n";
							$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								
							$message = '<html><body><p>'.$mensagem.'</p><br>';
							$message .= '</body></html>';
					mail($to, $subject, $message, $headers);
										
					}}}?>
</html>					