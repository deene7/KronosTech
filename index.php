<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KronosTech</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">

  <!--CSS-->
  <style>
    #marca img {
      max-width: 11%;
      height: auto;
    }

  </style>

</head>

<body>
<?php
session_start(); // Inicia a sessão, se ainda não estiver iniciada

// Verifica se o usuário está logado
if(isset($_SESSION['logged_in'])) {
    $textoBotao = "MINHA CONTA";
    $link = "account.php"; // Altere para o link da página de conta do usuário
} else {
    $textoBotao = "ENTRAR / REGISTRAR";
    $link = "login.php"; // Altere para o link da página de login/registro
}
?>



<!--BARRA DE NAVEGAÇÃO-->
<?php include('layouts/navbar.php'); ?>


  


  <br>
  <!--CARROSEL ADS-->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="padding-top:95px;">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="shop.php?category=placa de vídeo">
        <img src="assets/imgs/ad.png" class="d-block w-100" alt="ad">
      </a>
    </div>
    <div class="carousel-item">
      <a href="produto1.php?product_id=5">
        <img src="assets/imgs/ad2.png" class="d-block w-100" alt="ad">
      </a>
    </div>
    <div class="carousel-item">
      <a href="produto1.php?product_id=1">
        <img src="assets/imgs/ad3.png" class="d-block w-100" alt="ad">
      </a>
    </div>
  </div>
</div>



  <!--PRODUTOS HOME-->
  <section id="featured" class="w-100">
    <div class="container text-center mt-5 py-5">
      <h3>Departamentos</h3>
      <hr class="custom-hr-index">
      <p>Explore os departamentos mais procurados na KronosTech!</p>
    </div>
    <!-- CARDS CATEGORIA -->
    
    <div class="row-cards">
    <div class="card categ">
      <div class="imgBox">
        <img src="assets/imgs/pcgamer2.png" alt="mouse corsair" class="card-item">
      </div>

      <div class="contentBox">
        <h3>Gabinetes</h3>
        <a href="shop.php?category=gabinete" class="buy">Ver Mais</a>
      </div>
    </div>
    
    <div class="card categ">
      <div class="imgBox">
        <img src="assets/imgs/teclado mancer1.png" alt="mouse corsair" class="card-item">
      </div>

      <div class="contentBox">
        <h3>Teclados</h3>
        <a href="shop.php?category=teclado" class="buy">Ver Mais</a>
      </div>
    </div>

    <div class="card categ">
      <div class="imgBox">
        <img src="assets/imgs/placapng.png" alt="mouse corsair" class="card-item">
      </div>

      <div class="contentBox">
        <h3>Placas de Vídeo</h3>
        <a href="shop.php?category=placa de vídeo" class="buy">Ver Mais</a>
      </div>
    </div>

    <div class="card categ">
      <div class="imgBox">
        <img src="assets/imgs/cadeira.png" alt="mouse corsair" class="card-item">
      </div>

      <div class="contentBox">
        <h3>Cadeiras</h3>
        <a href="shop.php?category=cadeira" class="buy">Ver Mais</a>
      </div>
    </div>
    </div>  <!-- CARDS CATEGORIA -->
   

    <br>
    <div class="container text-center mt-5 py-5">
      <h3>Produtos</h3>
      <hr class="custom-hr-index">
      <p>Produtos em destaque</p>
    </div>
     
<!--CARDS PRODUTOS -->
<div class="row">
        <?php include('server/get_products.php'); ?>
        <?php $products_array = $get_products->fetch_all(MYSQLI_ASSOC); ?>
        <?php foreach (array_slice($products_array, 0, 6) as $row) { ?>
          <?php //aumentar numero de cards (ex.:9) foreach (array_slice($products_array, 0, 9) as $row) { ?>

          <!-- Produtos -->
          <div class="product col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="row container">
              <div class="card custom-card">
                <div class="card-body">
                  <img class="card-img-top" src="assets/imgs/<?php echo $row['product_image']; ?>">
                  <h5 class="p-name" title="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?></h5>
                  <hr>
                  <h4 class="p-price" style="color: #6221fe;">R$ <?php echo number_format($row['product_price'], 2, ',', '.'); ?> </h4>
                  <a href="<?php echo "produto1.php?product_id=". $row['product_id'];?>"><button class="btn btn-primary">Comprar</button></a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

    </section>  

      <!--PÁGINA INICIAL-->
  <section id="home">
    <div class="container">
        <h5>NOVOS PRODUTOS!!!</h5>
        <h1>Os <span>Melhores Preços</span> Disponíveis</h1>
        <p>A KronosTech oferece os melhores produtos custo-benefício</p>
        <a href="shop.php"><button>Comprar Agora</button> </a>     
    </div> 
  </section>

    <!-- Bootstrap JavaScript e seu script personalizado -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
    // Função para rolar automaticamente o carrossel a cada 5 segundos
    $(document).ready(function(){
    $('#carouselExampleIndicators').carousel({
      interval: 4000 // 5000 milissegundos = 5 segundos
      });
    });
</script>

<?php include('layouts/footer.php'); ?>