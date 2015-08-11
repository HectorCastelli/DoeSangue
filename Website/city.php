<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DoeSangue</title>
    <link rel="stylesheet" href="stylesheets/app.css" />
    <script src="bower_components/modernizr/modernizr.js"></script>
  </head>
  <?php
    require("mysql_config.php");
    require("functions.php");
  ?>
  <body>
      <nav class="top-bar" data-topbar role="navigation">
          <ul class="title-area">
              <li class="name">
                  <h1><a href="index.html">DoeSangue</a></h1>
              </li>
              <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
              <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
          </ul>
          <section class="top-bar-section">
              <ul class="left">
                  <li class="active"><a href="index.html">Home</a></li>
                  <li><a href="help.html">Ajuda</a></li>
              </ul>
          </section>
      </nav>

      <div class="row">
          <div class="large-12 columns">
              <h1>Agendamento Eletrônico</h1>
          </div>
      </div>

      <div class="row">
          <h6>Você está em:</h6>
          <ul class="breadcrumbs">
              <li class="current"><a href="#">Selecionando cidade e data</a></li>
              <li class="unavailable"><a href="#">Selecionando horário</a></li>
              <li class="unavailable"><a href="#">Preenchendo dados</a></li>
          </ul>
      </div>

      <div class="row">
          <div class="large-8 small-12 columns">
              <h4>Selecione uma cidade onde doar.</h4>
              <p>Cidades disponíveis:</p>
              <ul class="accordion" data-accordion>
                <?php
                $dbConnection = mysql_connect($servername, $username, $password);
if (!$dbConnection) {
    die('Não foi possível conectar: ' . mysql_error());
}
                mysql_select_db($database, $dbConnection);
                $count=0;
                $query = mysql_query("SELECT `city`.`name`, `campain`.`enabled` FROM `sangue`.`campain` INNER JOIN `sangue`.`city` ON `campain`.`idcity`=`city`.`idcity` WHERE `campain`.`enabled` = '1' GROUP BY `name` ORDER BY `name` ASC;");

                while($row = mysql_fetch_array($query)) {
                  echo ('
                    <li class="accordion-navigation">
                      <a href="#panel'.$count.'">'.$row["name"].'</a>
                      <div id="panel'.$count.'" class="content">'
                        );
                  $query2 = mysql_query("SELECT `campain`.`idcampain`, `campain`.`date`, `campain`.`enabled` FROM `sangue`.`campain` INNER JOIN `sangue`.`city` ON `campain`.`idcity`=`city`.`idcity` WHERE `campain`.`enabled` = '1' AND `city`.`name` = '".$row["name"]."' ORDER BY `name` ASC;");
                  while ($row2 = mysql_fetch_array($query2)) {
                    echo ('
                      <a class="button radius large-12 small-12" href="time.php?city='.$row["name"].'&campain='.$row2["idcampain"].'">'.fixDate($row2["date"]).'</a>
                    ');
                  }
                  echo ('
                      </div>
                    </li>
                    ');
                  $count++;
                }
                mysql_close($dbConnection);
                ?>
          </div>
          <div class="large-4 show-for-medium-up columns">
              <div class="panel">
                  <h4>Como funciona?</h4>
                  <p><em>Selecione a cidade</em> > <em>selecione a data da campanha</em> > escolha um horário > insira teus dados</p>
						<p>Você deve selecionar a cidade onde deseja fazer a doação de sangue (apenas as cidades já cadastradas nesse portal serão mostradas). Ao selecionar a cidade, serão mostradas as campanhas programadas, cujo agendamento está disponível!</p>
                  <p>Nas próximas telas, você deverá escolher o horário para a doação e inserir os dados pessoais!</p>
              </div>
          </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/foundation/js/foundation.min.js"></script>
      <script src="js/app.js"></script>
      <?php
        require 'mysql_close.php';
      ?>
  </body>
</html>
