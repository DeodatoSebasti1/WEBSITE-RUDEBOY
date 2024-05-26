<?php
require('../M/conecao.php');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>website rudeboy training</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/responsividade.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../icone/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../icone/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../icone/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../icone/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../icone/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../icone/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../icone/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../icone/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../icone/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../icone/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../icone/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../icone/favicon-16x16.png">
        <link rel="manifest" href="../icone/manifest.json">
        <meta name="msapplication-TileColor" content="">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ff3b3b">
  </head>
  
  <body>
    
    <!-- _________________________________NAVBAR CABEÇALHO__________________________________________ -->
    <?php 
    include("cabecalho.php");
    ?>
<!-- _________________________________  CARROSSEL___________________________________________ -->

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../img/img1.jpg" class="d-block w-100 fotocar">
    </div>
    
    <div class="carousel-item">
      <img src="../img/img2.jpg" class="d-block w-100 fotocar" alt="...">
    </div>
    
    <div class="carousel-item">
      <img src="../img/img3.jpg" class="d-block w-100 fotocar" alt="...">
    </div>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<!--____________________________________Icones________________________-->
<div class=" container-fluid icones ">
  <div class="container">
    <div class="row">
      
      <div class="col-3">
        <center>
          <img src="../img/icon1.PNG" class="foto"> <br>
          <span>Treino</span>
        </center>
      </div>
      
      <div class="col-3">
        <center>
          <img src="../img/icon2.PNG" class="foto" > <br>
          <span>Força</span>
        </center>
      </div>
      
      <div class="col-3">
        <center>
          <img src="../img/icon3.PNG" class="foto"> <br>
          <span>Energia</span>
        </center>
      </div>
      
      <div class="col-3">
        <center>
          <img src="../img/icon4.png" class="foto" > <br>
          <span>Saúde</span>
        </center>
      </div>
      
    </div>
  </div>
  
  
</div>

<!-- __________________________________Nossos Pacotes__________________________________________ -->

<div class=" container pacotes_e_produtos">
  
  </div>
  
  <div class="container-fluid pacotes" id="pacotes">
    <div class="container">
      <div class="row pacotes">
        <h3>NOSSOS PACOTES</h3>
        <div class="col-md-4 ">
          <div class="card"">
          <img src="../img/pacotemini.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h3>Pacote Mini</h3>
                <p class="card-text">Duas vezes na semana:
                Quarta-feira,
                sexta-feira(Dias opicionais)</p>
                <span>25.000kz.</span>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 ">
          <div class="card"">
          <img src="../img/pacotemax.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h3>Pacote Max</h3>
            <p class="card-text">Três vezes na semana:
              Segunda-feira, quarta-feira, sexta-feira(Dias opicionais)
            </p>
            <span> 35.000kz.</span>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
        <img src="../img/pacotepremium.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h3>Pacote Premium</h3>
          <p class="card-text">Treinos ao domicílio:</p>
          <p>60.000kzs</p> 
          <p>70.000kzs</p>
          <p>100.000kzs</p>
        </div>
      </div>
    </div>
    
  </div>
</div>
</div>
<!-- __________________________________Nossos produtos__________________________________________ -->

<div class="container-fluid produtos" id="produtos">
  <div class="container">
    <div class="row">
      <h3>NOSSOS PRODUTOS</h3>
      <div class="col-md-4">
        <div class="card"">
        <img src="../img/luvas de mma.jpg" class="card-img-top" alt="...">

            <h3>Luvas</h3>
            <ul>
            <li>Tamanho: Grande</li>
              <li>Cor: Preto</li>
              <li>Preço: 1000kzs</li>
            </ul>

        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
        <img src="../img/luvas.jpg" class="card-img-top" alt="...">
        <h3>Luvas</h3>
            <ul>
            <li>Tamanho: Grande</li>
              <li>Cor: Preto</li>
              <li>Preço: 1000kzs</li>
            </ul>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card"">
        <img src="../img/caneleiras.jpg" class="card-img-top" alt="...">
        <h3>Luvas</h3>
            <ul>
              <li>Tamanho: Grande</li>
              <li>Cor: Preto</li>
              <li>Preço: 1000kzs</li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>

<!--_________________________________SOBRENOS______________________________-->

<div class="sobrenos equipeinstalacoes " id="sobrenos">
  <h3>SOBRE NÓS</h3>
  <p> A RudeBoy Training é uma empresa de venda e prestação de serviços 
    ligada a saúde e preparação física. A empresa comercializa produtos 
    para atletas e possui uma academia para treinamentos. A empresa foi 
    criada em 10 de maio de 2017, por Divaldo Ribeiro Vicente e seus
    sócios Oscar Breno Domingos De Assis e Delvio Cristiano Manuel Lucas. 
    
    Numa primeira instancia a empresa operava sem um escritório físico, 
    oferecendo apenas os seus serviços a outras organizações com os mesmos 
    fins de negócio, atualmente a empresa está localizada no bairro Talatona, 
    município do Belas no condomínio American Plaza desde 11 de março de 2021.
    <p>
      </div>
      
      <!--_____________________nossa equipe_________________-->
      
      <div class="container-fluid equipeinstalacoes ">
        <div class="container">
          <div class="row equipeinstalacoes">
            <h3>NOSSA EQUIPE</h3>
            <div class="col-md-4">
              <div class="card"">
              <img src="../img/IMG_8321.jpg" class="card-img-top2" alt="...">

            </div>
          </div>
          
          <div class="col-md-4">
            <div class="card"">
            <img src="../img/IMG_0998.JPG" class="card-img-top2" alt="...">
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card"">
          <img src="../img/IMG_0989.JPG" class="card-img-top2" alt="...">
        </div>
      </div>
    </div>
  </div>
</div>


<!--_____________________instalações_________________-->

<div class="container-fluid equipeinstalacoes ">
  <div class="container">
    <div class="row equipeinstalacoes">
      <h3>NOSSAS INSTALAÇÕES</h3>
      <div class="col-md-4">
        <div class="card"">
        <img src="../img/instalacoes.jpg" class="card-img-top2" alt="...">
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card"">
      <img src="../img/instalacoes2.jpg" class="card-img-top2" alt="...">
      
    </div>
  </div>
  
  <div class="col-md-4">
    <div class="card"">
    <img src="../img/instalacoes9.jpg" class="card-img-top2" alt="...">
    
  </div>
</div>
</div>
</div>
</div>
</div>
<!--_____________________NOSSA MISSÃO_________________-->
<div class="Missao">
  <h1>Nossa Missão</h1>
  <p>
    Contribuir para o melhoramento da saúde física e mental dos seus clientes.
    Prestação de serviço nas áreas de artes marciais, venda de produtos desportivos
    e fitness. <br>
    
    Ser uma das maiores empresas de artes marciais de Angola, Africa e Mundo.
    Contribuir para a evolução das Artes Marciais em Angola e não só como 
    também na saúde e bem estar dos nossos clientes, proporcionar profissionalismo 
    e seriedade aos nossos parceiros e aos nossos patrocínio 
  </p>
</div>





<!--____________________________dicas de saude_______________________-->

<div class="container-fluid dicas_de_saude">
  <div class="container">
  
  <div class="row ">
    
    <h1 > Dicas de Saúde</h1>
    <div class="col-md-6 p1">
      

      <ul>
      <h5>BENEFÍCIOS DE BEBER ÁGUA</h5>
        <li>Regula a temperatura corporal
        A água ajuda o organismo a regular a temperatura do 
        corpo de acordo com a 
        temperatura ambiente. 
        Isso porque em altas temperaturas, o nosso corpo produz e 
        libera o suor, que, 
        ao evaporar, 
        libera calor, diminuindo, 
        assim, a temperatura do corpo.
      </li> <br>
        <li>
        Melhora a circulação sanguínea
          Por diluir o sangue, evitando a coagulação sanguínea, 
          a água melhora a circulação, facilitando a chegada do sangue a todos 
          os órgãos e evitando, assim, problemas como pressão alta.
        </li>
      </ul>

      </div>
      <div class="col-md-6 p1">
        <ul>
          <h5>O QUE COMER NO PRÉ-TREINO</h5>
              <li>
              BANANA: Rica em carboidrato e potássio, a banana contribui para a energia do 
              corpo e promove o relaxamento muscular, evitando cãibras e dores depois
              do treino. Outro benefício,
              não tão comentado, é o balanceamento da água no nosso organismo.
              </li> <br>
          <h5>BENEFÍCIOS DO DESCANSO PÓS-TREINO</h5>
              <li>
              Os benefícios do descanso estão a recuperação muscular e o ganho muscular
                de massa magra. “Isso acontece por conta do aumento dos sarcômeros, isto 
                é, o tamanho da grossura da sua Hbra muscular. Ou seja, há um aumento do
                músculo (que é o ganho de massa magra)”.
              </li>
        </ul>
          </div>
        </div>
        </div>
      </div>
      
      
      <!--—————————————————————————————————————Nossos Parceiros————————————————————————————-->
      <div class="nossosparceiros">
        <h3>Nossos Parceiros</h3>
        
        <img src="../img/parceiro2.JPG" class="parceirosimg">  
        <img src="../img/parceiro1.PNG" class="parceirosimg"> 
      </div>
      
      
      <!--____________________________Rodape___________________________________________-->
      <?php 
        include("rodape.php");
        ?>
<div id="contactos">
  
  </div>

  <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>