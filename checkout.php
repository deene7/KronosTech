<?php
session_start();

if(!empty($_SESSION['cart'])) {

//manda o usuario para a homepage
}else{
  header('location: index.php');
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continuar Compra | KronosTech</title>
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


<!--CHEKOUT-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Insira seus dados</h2>
        <hr class="custom-hr-shop mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="server/place_order.php">
          <p class="text-center" style="color: red;"><?php if(isset($_GET['message'])) {echo $_GET['message'];} ?>
          <?php if(isset($_GET['message'])) {?>
            <a  href="login.php" class="btn btn-primary">Login</a>

            <?php } ?>
        
        </p>
            <div class="form-group checkout-small-element">
                <label>Nome Completo</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Nome Completo" required/>
            </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group checkout-small-element">
                <label>Celular</label>
                <input type="number" class="form-control" id="checkout-phone" name="phone" placeholder="Celular" required/>
            </div>
            <div class="form-group checkout-small-element">
                <label>Cidade</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Cidade" required/>
            </div>
            <div class="form-group checkout-large-element">
                <label>Endereço</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Endereço" required/>
            </div>
            <div class="form-group checkout-btn-container">
              <p>Preço total: <?php echo 'R$ ' . number_format($_SESSION['total'], 2, ',', '.'); ?></p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order"value="Finalizar Compra"/>
            </div>
        </form>
    </div>
</section>


<?php include('layouts/footer.php'); ?>