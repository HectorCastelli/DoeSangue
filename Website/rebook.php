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
              <h1>Bem vindo ao portal DoeSangue</h1>
          </div>
      </div>

      <div class="row">
          <div class="large-12 small-12 columns">
              <div class="large-12 columns">
                <h4>Atualização Bem-Suscedida.</h4>
                <?php
                  $dbConnection - mysql_connect($servername, $username, $password);
                  mysql_select_db($database, $dbConnection);
                  $query = mysql_query("SELECT occupied FROM sangue.campain WHERE idcampain = ".$_GET["campain"].";");
                  $row = mysql_fetch_array($query);
                  $occupied = $row['occupied'];
                  $occupied[$_GET['time']] = $occupied[$_GET['time']]+1;
                  $occupied[$_GET["oldtime"]] = $occupied[$_GET["oldtime"]]-1;
                  $query = mysql_query("UPDATE `sangue`.`campain` SET `occupied` = '".$occupied."' WHERE `idcampain` = ".$_GET["campain"].";");
                  if (!$query) {
                    die('Invalid query: ' . mysql_error());
                  }
                  $query = mysql_query("UPDATE `sangue`.`donnors` SET `time`='".$_GET["time"]."' WHERE `iddonnors`='".$_GET["donnors"]."';");
                  if (!$query) {
                    die('Invalid query: ' . mysql_error());
                  }
                  mysql_close($dbConnection);
              ?>
            </div>
          </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/foundation/js/foundation.min.js"></script>
      <script src="js/app.js"></script>
  </body>
</html>
