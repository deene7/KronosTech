<?php

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
  $order_id = $_POST['order_id'];
  $order_status = $_POST['order_status'];

  $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

  $stmt->bind_param('i',$order_id);

  $stmt->execute();

  $order_details = $stmt->get_result();

  $order_total_price = calculateTotalOrderPrice($order_details);
}else {
  header('location: account.php');
  exit;

}

function calculateTotalOrderPrice($order_details) {
  $total = 0;

  foreach($order_details as $row) {
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];

    $total = $total + ($product_price * $product_quantity);

  }

  return $total;
}


?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deatlhes do Pedido | KronosTech</title>
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
<nav class="navbar navbar-expand-lg bg-body-tertiary py-4 fixed-up">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img id="logo" src="assets/imgs/logo2.png" height="40px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="index.php">Página Inicial</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="shop.php">Comprar</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contato.php">Contato</a>
        </li>

        <li class="nav-item">
          <a href="cart.php"><ion-icon name="cart"></ion-icon></a>          
        </li>
        <li class="nav-item">
          <!--<a href="account.php"><ion-icon name="person"></ion-icon></a>-->        
        </li>
      </ul>
         
      <div class="butaobrita">
        <label class="switch">
          <input type="checkbox" id="darkModeToggle">
          <span class="slider"></span>
        </label>
      </div>
      
    </div>
  </div>
</nav>





<!-- DETALHES DO PEDIDO -->
<section id="orders" class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Detalhes do Pedido</h2>
        <hr class="custom-hr-shop mx-auto">
    </div>

    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
        </tr>
        <?php foreach($order_details as $row) { ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>">
                        <p class="mt-3"><?php echo $row['product_name']; ?></p>
                    </div>
                </td>
                <td>
                    <span><?php echo 'R$ ' . number_format($row['product_price'], 2, ',', '.'); ?></span>
                </td>
                <td>
                    <span><?php echo $row['product_quantity']; ?></span>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if($order_status == "Aguardando Pagamento") { ?>
      <form style="float: right;" method="POST" action="pagamento.php">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
      <input type="hidden" name="order_total_price" value="<?php echo $order_total_price;?>">
      <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
        <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Continuar Compra">
      </form>

    <?php } ?>

</section>


<?php include('layouts/footer.php'); ?>