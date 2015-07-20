<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DoeSangue</title>
    <link rel="stylesheet" href="stylesheets/app.css" />
    <script src="bower_components/modernizr/modernizr.js"></script>
  </head>
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
  Aparecida&campain=3
          <h6>Você está em:</h6>
          <ul class="breadcrumbs">
              <li><a href="city.php"><?php echo $_GET['city']?></a></li>
              <li><?php echo('<a href="time.php?city='.$_GET['city'].'&campain='.$_GET[campain].'" class="disabled">'.$_GET["time"]);?></a></li>
              <li class="current"><a href="#">Preenchendo dados</a></li>
          </ul>
      </div>

      <div class="row">
          <div class="large-8 small-12 columns">
            <h4>Insira seus dados abaixo para reservar seu horário</h4>
              <form method="post" action="register.php">
                  <div class="large-12 columns">
                    <div class="row collapse prefix-radius">
                      <div class="small-2 columns">
                        <span class="prefix">Nome</span>
                      </div>
                      <div class="small-10 columns">
                        <input name="name" type="text" required placeholder="Nome">
                      </div>
                    </div>
                    <div class="row collapse prefix-radius">
                      <div class="small-2 columns">
                        <span class="prefix">E-Mail</span>
                      </div>
                      <div class="small-10 columns">
                        <input name="mail" type="text" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="E-Mail">
                      </div>
                    </div>
                    <div class="row collapse prefix-radius">
                      <div class="small-2 columns">
                        <span class="prefix">CPF</span>
                      </div>
                      <div class="small-10 columns">
                        <input name="cpf" type="text" required pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="CPF com pontos e hífens">
                      </div>
                    </div>
                    <ul class="button-group even-2">
                      <li><button class="button alert" type="reset">Cancelar</button></li>
                      <li><button class="button success" type="submit">Aceitar</button></li>
                    </ul>
                  </div>
              </form>
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
