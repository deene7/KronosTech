<?php
session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

// REALIZAR LOGOUT
if(isset($_GET['logout'])) {
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

// ALTERAR SENHA
if(isset($_POST['change_password'])){
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];
  $user_email = $_SESSION['user_email'];
  
  // Se as senhas não coincidem
  if($password !== $confirmPassword) {
    header('location: account.php?error=As senhas não coincidem');
    exit(); // Adiciona exit para interromper a execução adicional
  }
  
  // Se a senha tem menos de 6 caracteres
  if(strlen($password) < 6) {
    header('location: account.php?error=A senha tem que ter pelo menos 6 caracteres');
    exit(); // Adiciona exit para interromper a execução adicional
  } else {
    // Hash da senha
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Atualizar a senha no banco de dados
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', $password_hashed, $user_email);

    if($stmt->execute()){
      header('location: account.php?message=Sua senha foi alterada com sucesso.');
    } else {
      header('location: account.php?error=Não foi possível alterar sua senha.');
    }
  }
}

// GET ORDERS
if(isset($_SESSION['logged_in'])){

  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id =? ");

  $stmt->bind_param('i',$user_id);

  $stmt->execute();

  $orders = $stmt->get_result();
}

?>



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta | KronosTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

        <!--CSS-->
        <style>
          #marca img {
            max-width: 11%;
            height: auto;
        }

        hr.custom-hr-msenha {
            border: none; /* Remove a borda padrão */
             height: 5px; /* Define a altura da linha */
            width: 39%; /* Define a largura da linha */
            background-color: #6221feFF; /* Define a cor da linha */
            margin: 20px 0px; /* Define a margem superior e inferior da linha */
            opacity: 100%;
            border-radius: 100px;
}
/* CARRINHO */
.carts table{
  width: 100%;
  border-collapse: collapse;
}

.carts .product-info{
  display: flex;
  flex-wrap: wrap;
}

.carts th{
  text-align: left;
  padding: 5px 10px;
  color: #fff;
  background-color: #6221fe;
}

.carts td{
  padding: 10px 20px;
}

.carts td img{
  width: 80px;
  height: 80px;
  margin-right: 10px;
}

.carts td input{
  width: 40px;
  height: 30px;
  padding: 5px;
}

.carts td a{
  color: #6221fe;
}

.carts .remove-btn{
  color: #6221fe;
  text-decoration: none;
  font-size: 14px;
}

body.dar-mode .carts .remove-btn{
  color: #fff;
}

.carts .edit-btn{
  color: #6221fe;
  text-decoration: none;
  font-size: 15px;
}

.carts .product-info p{
  margin: 3px; /* margem do preço do produto ao nome */
}

td:last-child {
  text-align: right; /* ajusta o preço a direita*/
}

th:last-child {
  text-align: right; /*ajusta o preço a direita */
}
        </style>

</head>
<body>

<!--BARRA DE NAVEGAÇÃO-->
<nav class="navbar navbar-expand-lg bg-body-tertiary py-4 fixed-up">
  <div class="container">
      <a class="navbar-brand" href="index.php">
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


<!--MINHA CONTA-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])) {echo $_GET['register_success'];} ?></p>
        <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])) {echo $_GET['login_success'];} ?></p>
            <h3 class="font-weight-bold">Informações da Conta</h3>
            <hr class="custom-hr-shop mx-auto">
            <div class="account-info">
                <p>Nome: <span><?php if(isset($_SESSION['user_name'])) { echo $_SESSION['user_name'];} ?></span></p>
                <p>E-mail: <span><?php if(isset($_SESSION['user_email'])) { echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="order-btn" style="color: #6221fe; text-decoration: none">Meus Pedidos</a></p>
                <p><a href="account.php?logout=1" id="logout-btn" style="color: #6221fe; text-decoration: none">Sair da conta</a></p>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
              <p class="text-center" style="color:red"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
              <p class="text-center" style="color:green"><?php if(isset($_GET['message'])) {echo $_GET['message'];} ?></p>
                <h3>Mudar Senha</h3>
                <hr class="custom-hr-msenha mx-auto">
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Senha" required>
                </div>
                <div class="form-group">
                    <label>Confirmar Senha</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirm_password" placeholder="Confirmar Senha" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Mudar Senha" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>


</section>
<br><br><br>

  <!--PEDIDOS-->
  <section id="orders" class="carts container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Meus Pedidos</h2>
        <hr class="custom-hr-shop mx-auto">
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Id Pedido</th>
            <th>Custo do Pedido</th>
            <th>Status do Pedido</th>
            <th>Data</th>
            <th>Detalhes do Pedido</th>
        </tr>

        <?php while($row = $orders->fetch_assoc()) { ?>


            <tr> 
                <td>
                    <!-- <div>
                      <img src="assets/imgs/new1.jpg">
                      <div>
                        <p class="mt-3"><?php echo $row['order_id']; ?></p>
                      </div>
                    </div> -->
                    <span><?php echo $row['order_id']; ?></span>
                </td>

                <td>
                  <span><?php echo 'R$ ' . number_format($row['order_cost'], 2, ',', '.'); ?></span>
                </td>

                <td>
                  <span><?php echo $row['order_status']; ?></span>
                </td>

                <td>
                  <span><?php 
                    // Exibindo apenas a data formatada
                    echo date('d/m/Y H:i:s', strtotime($row['order_date']));
                    ?>            
                  </span>
                </td>

                <td>
                    <form method="POST" action="order_details.php" class="order">
                      <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                      <input type="submit" class="btn order-detail-btn" value="Detalhes" name="order_details_btn">
                </form>
              </td>

            </tr>

          <?php } ?>
    </table>

   
  </section>



  <?php include('layouts/footer.php'); ?>