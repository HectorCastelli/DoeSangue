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
          <div class="large-8 small-12 columns">
            <div class="large-12 columns">
              <?php
                $dbConnection = mysql_connect($servername, $username, $password);
                mysql_select_db($database, $dbConnection);
                $query = mysql_query("SELECT `user`.`iduser`, `user`.`name`, `user`.`mail`, `user`.`cpf`, `user`.`password` FROM `sangue`.`user` WHERE `user`.`cpf`='".$_POST['cpf']."' AND `user`.`password` = '".$_POST['pass']."' ;");
                while($row = mysql_fetch_array($query)) {
                  echo '<h4>Olá '.$row['name'].'</h4>';
                  echo ('
                      <ul class="accordion" data-accordion>
                        <li class="accordion-navigation">
                          <a href="#data">Dados Cadastrais</a>
                          <div id="data" class="content">
                             <form method="post" action="update.php" data-abide>
                                  <input type="hidden" name="user" value="'.$row["iduser"].'">
                                  <div class="row name-field">
                                    <label>Nome</label>
                                    <input name="name" type="text" required placeholder="Nome" value="'.$row['name'].'">
                                    <small class="error">Nome deve ser preenchido.</small>
                                  </div>
                                  <div class="row mail-field">
                                    <label>E-Mail</label>
                                    <input name="mail" type="text" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="E-Mail" value="'.$row['mail'].'">
                                    <small class="error">E-mail deve ser preenchido e válido</small>
                                  </div>
                                  <ul class="button-group even-2">
                                    <li><button class="button alert" type="reset">Cancelar</button></li>
                                    <li><button class="button success" type="submit">Aceitar</button></li>
                                  </ul>
                            </form>
                          </div>
                        </li>
                        <li class="accordion-navigation">
                          <a href="#alter">Alterar Horário</a>
                          <div id="alter" class="content">
                  ');
                  $query2 = mysql_query("SELECT `donnors`.`iddonnors`,`donnors`.`iduser`,`donnors`.`idcity`,`donnors`.`idcampain`,`donnors`.`time`,`city`.`name`,`campain`.`date`  FROM `sangue`.`donnors` LEFT JOIN `sangue`.`city` ON `donnors`.`idcity`=`city`.`idcity`  LEFT JOIN `sangue`.`campain` ON `donnors`.`idcampain`=`campain`.`idcampain`WHERE `donnors`.`iduser` = 1 ORDER BY `city`.`name` ;");
                  while($row2 = mysql_fetch_array($query2)) {
                    echo '<h5>'.$row2['name'].' <small>('.fixDate($row2['date']).')</small></h5>';
                    $query3 = mysql_query("SELECT `campain`.`idcampain`, `campain`.`date`, `campain`.`vacant`, `campain`.`occupied`, `campain`.`starttime` FROM `sangue`.`campain` WHERE `campain`.`idcampain` = ".$row2['idcampain'].";");
                    while($row3 = mysql_fetch_array($query3)) {
                      $free = $row3["vacant"];
                      $taken = $row3["occupied"];
                      $start = $row3["starttime"];
                      for ($i=0; $i<strlen($free); $i++) {
                        if ($i == $row2['time']) {
                          echo ('<span class="button radius large-12 small-12 info disabled">'.resTime($start, $i).'</span>');
                        } else {
                          if ($free[$i] - $taken[$i] > 0)
                            echo ('<a class="button radius large-12 small-12 success" href="rebook.php?donnors='.$row2["iddonnors"].'&campain='.$row3['idcampain'].'&time='.$i.'&oldtime='.$row2['time'].'">'.resTime($start, $i).'</a>');
                        }
                      }
                    }
                  }
                  echo ('
                          </div>
                        </li>
                        <li class="accordion-navigation">
                          <a href="#camp">Excluir Agendamento</a>
                          <div id="camp" class="content">
                  ');
                  $query4 = mysql_query("SELECT `donnors`.`iddonnors`,`donnors`.`iduser`,`donnors`.`idcity`,`donnors`.`idcampain`,`donnors`.`time`,`city`.`name`,`campain`.`date`  FROM `sangue`.`donnors` LEFT JOIN `sangue`.`city` ON `donnors`.`idcity`=`city`.`idcity`  LEFT JOIN `sangue`.`campain` ON `donnors`.`idcampain`=`campain`.`idcampain`WHERE `donnors`.`iduser` = 1 ORDER BY `city`.`name` ;");
                  while($row4 = mysql_fetch_array($query4)) {
                     echo ('<a href="exclude.php?campain='.$row4['idcampain'].'&time='.$row4['time'].'&donnors='.$row4['iddonnors'].'" class="button alert expand"><b>'.fixDate($row4['date']).'</b><br />'.$row4['name'].'</a>');
                  }
                  echo ('
                          </div>
                        </li>
                      </ul>
                  ');
                }
                if (mysql_num_rows($query) == 0 ) {
                  echo '<h4>Seu login falhou, tente novamente.</h4>';
                }
                mysql_close($dbConnection);
              ?>
            </div>
          </div>
          <div class="large-4 show-for-medium-up columns">
              <div class="panel">
                  <h4>Como funciona?</h4>
                  <p>Insira os dados que foram cadastrados na sua primeira doação neste portal.</p>
              </div>
          </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/foundation/js/foundation.min.js"></script>
      <script src="js/app.js"></script>
  </body>
</html>
