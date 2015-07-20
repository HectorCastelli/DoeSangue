<?php
  require("mysql_config.php");
  $dbConnection - mysql_connect($servername, $username, $password);
  mysql_select_db($database, $dbConnection);
  //$query = mysql_query("");
  //Must change parameter in sangue.campain and add register to sangue.donnors
  mysql_close($dbConnection);
?>
