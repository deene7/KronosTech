<?php
session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if(isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? LIMIT 1");

  $stmt->bind_param('s', $email);

  if($stmt->execute()) {
    $stmt->bind_result($user_id, $username, $user_email, $user_password);
    $stmt->fetch();

    if(password_verify($password, $user_password)) {
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $username;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;

      header('location: account.php?login_success=Você entrou na conta com sucesso');
      exit();
    } else {
      header('location: login.php?error=Senha ou email incorretos');
      exit();
    }
  } else {
    header('location: login.php?error=Alguma coisa deu errado');
    exit();
  }
}
?>




<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar | KronosTech</title>
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


<!--LOGIN-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <br>
    </div>
    <div class="mx-auto container">
        <form id="login-form" method="POST" action="login.php">
          <p style="color:red" class="text-center"><?php if(isset($_GET['error'])) {echo $_GET['error'];}  ?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Senha" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
            </div>
            <div class="form-group">
                <a id="register-url" >Não tem uma conta? <a href="register.php" style="color: #6221fe; text-decoration: none">Criar Conta</a>
            </div>
        </form>
    </div>
</section>


<?php include('layouts/footer.php'); ?>