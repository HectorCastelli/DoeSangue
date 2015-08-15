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
              <li><a href="city.php"><?php echo $_GET['city']?></a></li>
              <li class="current"><a href="#">Selecionando horário</a></li>
              <li class="unavailable"><a href="#">Preenchendo dados</a></li>
          </ul>
      </div>

      <div class="row">
          <div class="large-8 small-12 columns">
            <h4>Selecione um horário disponível</h4>
            <ul class="accordion" data-accordion>
              <li class="accordion-navigation">
                <a href="#panel2a">Accordion 2</a>
                <div id="panel2a" class="content">
                  Panel 2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
              </li>
              <li class="accordion-navigation">
                <a href="#panel3a">Accordion 3</a>
                <div id="panel3a" class="content">
                  Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
              </li>
            </ul>
            <div class="large-12 columns">
              <?php
                $dbConnection = mysql_connect($servername, $username, $password);
                mysql_select_db($database, $dbConnection);
                $query = mysql_query("SELECT `campain`.`idcampain`, `campain`.`date`, `campain`.`vacant`, `campain`.`occupied`, `campain`.`starttime` FROM `sangue`.`campain` WHERE `campain`.`idcampain` = ".$_GET['campain'].";");
                while($row = mysql_fetch_array($query)) {
                  $free = $row["vacant"];
                  $taken = $row["occupied"];
                  $start = $row["starttime"];
                  for ($i=0; $i<strlen($free); $i++) {
                    if ($free[$i] - $taken[$i] > 0)
                        echo ('<a class="button radius large-12 small-12 success" href="person.php?city='.$_GET['city'].'&campain='.$_GET['campain'].'&time='.$i.'">'.resTime($start, $i).'</a>');
                    else
                      echo ('<span class="button radius large-12 small-12 alert disabled">'.resTime($start, $i).'</span>');
                  }
                }
                mysql_close($dbConnection);
              ?>
            </div>
          </div>
          <div class="large-4 show-for-medium-up columns">
              <div class="panel">
                  <h4>Como funciona?</h4>
                  <p>Selecione a cidade > selecione a data da campanha > <em>escolha um horário</em> > insira teus dados</p>
                  <p>Os horários mostrados em verde, estão disponíveis. Os demais (em vermelho) já estão esgotados!</p>
						<p>Não existe <em>lista de espera</em>, mas os doadores agendados podem cancelar a reserva até o dia anterior da campanha, de forma a alterar o quadro de vagas disponíveis.</p>
              </div>
          </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/foundation/js/foundation.min.js"></script>
      <script src="js/app.js"></script>
  </body>
</html>
