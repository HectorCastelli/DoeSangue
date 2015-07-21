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
              <h1>Portal Doe Sangue: agendamento eletrônico (3/3)</</h1>
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
            <h4>Insira teus dados, para reservar o horário</h4>
              <form method="post" action="register.php">
                  <input type="hidden" name="campain" value=<?php echo ('"'.$_GET['campain'].'"'); ?>>
                  <input type="hidden" name="time" value=<?php echo ('"'.$_GET['time'].'"'); ?>>
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
                  <p>Selecione a cidade > selecione a data da campanha > escolha um horário > <em>insira teus dados</em></p>
						<p>Os dados solicitados serão usados apenas para o registro e uso no portal e não serão disponibilizados para outros fins.</p>
                  <p>O número do CPF será usado como <em>nome de usuário</em>, sempre que este deseje consultar ou cancelar uma reserva.</p>
						<p>O nome é apenas para a identificação do doador, durante a campanha.</p>
						<p>O e-mail será usado para que o portal possa enviar mensagens relembrando a reserva e para avisar quando novas campanhas são disponibilizadas.</p>
						<p>Nenhum dado informado durante a campanha (biometria e entrevista) ou decorrente da análise do sangue coletado, será armazenado no portal. Estes dados são de uso restrito em atendimento às normas estabelecidas pelo Ministério da Saúde do Brasil.</p>
              </div>
          </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/foundation/js/foundation.min.js"></script>
      <script src="js/app.js"></script>
  </body>
</html>
