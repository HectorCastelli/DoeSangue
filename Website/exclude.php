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
          <div class="large-8 small-12 columns">
              <div class="large-12 columns">
                <?php
                  $dbConnection - mysql_connect($servername, $username, $password);
                  mysql_select_db($database, $dbConnection);
                  //$query = mysql_query("");
                  //Must change parameter in sangue.campain and add register to sangue.donnors
                  /*$campain    $time    $donnors*/
                  $query = mysql_query("SELECT * FROM sangue.campain WHERE `idcampain`='".$_GET["campain"]."';");
                  if (!$query) {
                    die('Invalid query: ' . mysql_error());
                  }
                  while ($row = mysql_fetch_assoc($query)) {
                    $occupied = $row["occupied"];
                  }
                  $time = $_GET["time"];
                  $occupied[$time+1] = $occupied[$time+1]+1;
                  $query = mysql_query("UPDATE `sangue`.`campain` SET `occupied`='".$occupied."' WHERE `idcampain`='".$_GET["campain"]."';");
                  if (!$query) {
                    die('Invalid query: ' . mysql_error());
                  }
                  $query = mysql_query("DELETE FROM `sangue`.`donnors` WHERE `iddonnors`='".$_GET["donnors"]."';");
                  if (!$query) {
                    die('Invalid query: ' . mysql_error());
                  }
                  mysql_close($dbConnection);
              ?>
              <p>Compartilhe seu ato solidário!</p>
              <ul class="button-group even-7 round">
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://doesangue.com.br&t=DoeSangue - Eu doei!" class="button" target="_blank" name="Share on Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/intent/tweet?source=http://doesangue.com.br&text=DoeSangue -http://doesangue.com.br Eu doei!&via=doesangue" class="button" target="_blank" name="Tweet it!"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://plus.google.com/share?url=http://doesangue.com.br" class="button" target="_blank" name="Share it on Google Pluse"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="http://www.tumblr.com/share?v=3&u=http://doesangue.com.br&t=DoeSangue&s=" class="button" target="_blank" name="Post it on Tumblr"><i class="fa fa-tumblr"></i></a></li>
                <li><a href="http://pinterest.com/pin/create/button/?url=http://doesangue.com.br&media=http://doesangue.com.br/img/share.jpg&description=Eu doei! Venha fazer sua parte!" class="button" target="_blank" name="Pin in to you Pinterest"><i class="fa fa-pinterest"></i></a></li>
                <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=http://doesangue.com.br&title=DoeSangue&summary=Eu doei! Venha fazer sua parte!&source=http://doesangue.com.br" class="button" target="_blank" name="Share on your LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="mailto:?subject=DoeSangue&body=Eu doei! Venha fazer sua parte! : http://doesangue.com.br" class="button" target="_blank" name="Send it by Mail"><i class="fa fa-envelope-o"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="large-4 show-for-medium-up columns">
              <div class="panel">
                  <h4>Como funciona?</h4>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                  <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
              </div>
          </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/foundation/js/foundation.min.js"></script>
      <script src="js/app.js"></script>
  </body>
</html>
