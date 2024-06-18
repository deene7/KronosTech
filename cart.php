<?php
session_start();

if(isset($_POST['add_to_cart'])) {
   //se o usuario ja adicionou um produto ao carrinho
  if(isset($_SESSION['cart'])) {

    $products_array_ids = array_column($_SESSION['cart'],"product_id");
    //se o produto ja foi adicionado ou não
    if(!in_array($_POST['product_id'], $products_array_ids) ) {

      $product_id = $_POST['product_id'];

      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image' => $_POST['product_image'],
        'product_quantity' => $_POST['product_quantity']
      );
      $_SESSION['cart'][$product_id] = $product_array;

    //o produto ja foi adicionado
    }else {
      echo '<script>alert("Este produto já foi adicionado ao carrinho.")</script>';
    }

    //se esse é o primeiro produto
  } else {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'product_image' => $product_image,
      'product_quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product_array;
    //
  }

  //calcular total do carrinho
  calculateTotalCart();



  //remover produto do carrinho
}else if(isset($_POST['remove_product'])) {
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

    //calcular total do carrinho
    calculateTotalCart();



    //editar quantidade do produto
}else if(isset($_POST['edit_quantity'])) {
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  // Verifica se a quantidade é maior ou igual a 1
  if ($product_quantity >= 1) {
      // Atualiza a quantidade do produto existente no carrinho
      $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
  } else {
      // Se a quantidade for menor que 1, remova o produto do carrinho
      unset($_SESSION['cart'][$product_id]);
  }

  //calcular total do carrinho
  calculateTotalCart();

}

function calculateTotalCart() {
  $total_price = 0;
  $total_quantity = 0;

  foreach($_SESSION['cart'] as $key => $product) {
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total_price = $total_price + ($price * $quantity);
    $total_quantity = $total_quantity + $quantity;
  }

  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho | KronosTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/imgs/logomini.png" type="image/x-icon">

    <!--CSS-->
    <style>
      #marca img {
        max-width: 11%;
        height: auto;
    }
    </style>

</head>
<body>
<!--BARRA DE NAVEGAÇÃO-->
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



<?php include('layouts/navbar.php'); ?>


  <!--Cart-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Meu Carrinho</h2>
        <hr class="custom-hr-cart">
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Total</th>
        </tr>

        <?php if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) { ?>
    <?php foreach($_SESSION['cart'] as $key => $value) { ?>
        <tr> <!-- PRODUTO NO CARRINHO -->
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php echo isset($value['product_image']) ? $value['product_image'] : ''; ?>">
                    <div>
                        <p><?php echo isset($value['product_name']) ? $value['product_name'] : ''; ?></p>
                        <small><span>R$</span><?php echo isset($value['product_price']) ? number_format($value['product_price'], 2, ',', '.') : ''; ?></small>
                        <br>
                        <form method="POST" action="cart.php">
                          <input type="hidden" name="product_id" value="<?php echo $key; ?>"/>
                          <input type="submit" name="remove_product" class="remove-btn" value="Excluir" style="width: 80px;"/>
                        </form>
                    </div>
                </div>
            </td>

            <td>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                  <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" min="1">
                  <input type="submit" class="edit-btn" value="Editar" style="width: 80px;" name="edit_quantity"/>

                </form>
            </td>

            <td>
                <span>R$</span>
                <span class="product-price"><?php echo isset($value['product_price']) ? number_format($value['product_quantity'] * $value['product_price'], 2, ',', '.') : ''; ?></span>
            </td>
        </tr>
    <?php } ?>
<?php } ?>

        
    </table>

    <div class="cart-total">
    <table>
        <tr>
            <td>Total a Pagar</td>
            <td>R$ <?php echo isset($_SESSION['total']) ? number_format($_SESSION['total'], 2, ',', '.') : '0,00'; ?></td>
        </tr>
    </table>
    </div>

    <div class="checkout-container">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <form id="checkout-form" method="POST" action="checkout.php">
            <p class="text-center" style="color: red;">
                <?php if (isset($_GET['message'])) echo htmlspecialchars($_GET['message']); ?>
            </p>
            <input type="submit" class="btn checkout-btn" value="Continuar" name="checkout">
        </form>
    <?php else: ?>
        <p class="text-center" style="color: red;">
            Você precisa estar logado para continuar a compra.
            <a href="login.php" class="btn btn-primary">Login</a>
        </p>
    <?php endif; ?>
</div>  
  </section>
  
  <div class="container text-center mt-5 py-5">
      <h3>Talvez você goste!</h3>
      <hr class="custom-hr-index">
      <p>Confira nossos produtos mais vendidos</p>
  </div>

  <!--ROW PRODUTOS-->
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


<?php include('layouts/footer.php'); ?>