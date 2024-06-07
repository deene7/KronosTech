<?php

include('server/connection.php');

if(isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i", $product_id);

  $stmt->execute();
  
  $product = $stmt->get_result();

  // Se nenhum produto for encontrado, redirecione para index.php
  if($product->num_rows === 0) {
    header('Location: index.php');
    exit(); // Certifique-se de sair após redirecionar
  }

  // Obtém o nome do produto para usar no título
  $row = $product->fetch_assoc();
  $product_cname = $row['product_cname'];
  $product_quant = $row['product_quant'];

} else {
  header('Location: index.php');
  exit(); // Certifique-se de sair após redirecionar
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product_cname); ?> | KronosTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/imgs/logomini.png" type="image/x-icon">

    <style>
      .small-img-group {
        display: flex;
        justify-content: space-between;
      }

      .small-img-col {
        flex-basis: 24%;
        cursor: pointer;
      }

      .small-img-col:hover img {
        opacity: 0.7;
      }

      .sproduct input {
        width: 50px;
        height: 40px;
        padding-left: 10px;
        font-size: 16px;
        margin-right: 10px;
      }

      .sproduct input:focus {
        outline: none;
      }

      .buy-button {
        background-color: #6221fe;
        transition: 0.3s all;
      }

      .buy-button:hover {
        background-color: black;
      }

      #marca img {
        max-width: 11%;
        height: auto;
    }
    .hovert {
      color: #d8d8d8;
      text-decoration: none; /* Removendo o sublinhado padrão */
      position: relative; /* Adicionando posição relativa para o efeito de linha */
    }

    /* Efeito de hover */
    .hovert:hover {
      color: #6221fe; /* Mudança de cor ao passar o mouse */
    }

    </style>
</head>
<body>

<?php
session_start(); // Inicia a sessão, se ainda não estiver iniciada

// Verifica se o usuário está logado
if(isset($_SESSION['logged_in'])) {
    $textoBotao = "MINHA CONTA";
    $link = "sua_conta.php"; // Altere para o link da página de conta do usuário
} else {
    $textoBotao = "ENTRAR / REGISTRAR";
    $link = "account.php"; // Altere para o link da página de login/registro
}
?>

<!--BARRA DE NAVEGAÇÃO-->
<?php include('layouts/navbar.php'); ?>

<section class="container sproduct my-5 pt-5">
  <br>
  <div class="row mt-4">
    <?php do { ?>

    <!-- Coluna para as imagens -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <img class="produtoimg img-fluid" src="assets/imgs/<?php echo $row['product_image']; ?>" id="MainImg" style="width: 100%; max-width: 500px;">

      <div class="small-img-group col-lg-11">
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" alt="">
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" alt="">
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" alt="">
        </div>
      </div>
    </div>

    <!-- Coluna para os detalhes do produto -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <br>
      <h6><a href="shop.php" class="hovert">Loja</a> / <a href="shop.php?category=<?php echo urlencode($row['product_category']); ?>" class="hovert"><?php echo $row['product_category']; ?></a></h6>
      <h4><?php echo $row['product_name']; ?></h4>
      <!-- PREÇO DO PRODUTO -->
      <?php if ($product_quant >= 1 && $product_quant > 0): ?> <!-- verifica a quantidade de produtos -->
          <h2 style="color: #6221fe;"> <!-- Define a cor da fonte se houver produto -->
              R$ <?php echo number_format($row['product_price'], 2, ',', '.'); ?> 
          </h2>
      <?php else: ?>
          <h2 style="color: #d4d4d4; opacity: 0.8;"> <!-- Define a cor da fonte se NÃO houver produto -->
              R$ <?php echo number_format($row['product_price'], 2, ',', '.'); ?>
          </h2>
      <?php endif; ?>

      <!-- ANTIGO PREÇO -->
             <!-- <h2 style="color: #6221fe;">R$ <?php echo number_format($row['product_price'], 2, ',', '.'); ?></h2> --
      <!-- ANTIGO PREÇO -->

      <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_cname']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
        <input type="hidden" name="product_quantity" value="1" min="1">
      <?php if ($product_quant >= 1 && $product_quant > 0){echo "<button class='buy-button' type='submit' name='add_to_cart'>Adicionar ao Carrinho</button>";} else {echo "<button class='buy-button disabled' type='submit' name='add_to_cart' disabled>Produto Indisponível</button>";}?>
    </form>

      <h4 class="mt-5">Detalhes do Produto</h4>
      <?php if($product_quant >= 1 && $product_quant > 0){echo "<h4 class='estoque-true'>EM ESTOQUE<h4>";}else {echo "<h4 class='estoque-false'>SEM ESTOQUE<h4>";} $product_quant; ?>
      <h6>Características</h6>
      <span><?php echo $row['product_description']; ?></span>
    </div>
    <?php } while($row=$product->fetch_assoc()); ?>
  </div>
</section>

<!--PRODUTOS HOME-->
<section id="featured" class="w-100">
  <div class="container text-center mt-5 py-5">
    <h3>Produtos Relacionados</h3>
    <hr class="custom-hr-index">
    <p>Produtos geralmente comprados em conjunto.</p>
  </div>

  <div class="row">

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

<script>
  window.onload = function() {
    var MainImg = document.getElementById('MainImg');
    var smallimg = document.getElementsByClassName('small-img');

    smallimg[0].onclick = function() {
      MainImg.src = smallimg[0].src;
    }
    smallimg[1].onclick = function() {
      MainImg.src = smallimg[1].src;
    }
    smallimg[2].onclick = function() {
      MainImg.src = smallimg[2].src;
    }
    smallimg[3].onclick = function() {
      MainImg.src = smallimg[3].src;
    }
  };
</script>

<?php include('layouts/footer.php'); ?>

</body>
</html>
