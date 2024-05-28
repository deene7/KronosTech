<?php
session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if(isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  // Se as senhas não coincidem
  if($password !== $confirmPassword) {
    header('location: register.php?error=As senhas não coincidem');
    exit(); // Adiciona exit para interromper a execução adicional
  }

  // Se a senha tem menos de 6 caracteres
  if(strlen($password) < 6) {
    header('location: register.php?error=A senha tem que ter pelo menos 6 caracteres');
    exit(); // Adiciona exit para interromper a execução adicional
  }

  // Verifica se o email já existe
  $stmt = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $stmt->bind_result($num_rows);
  $stmt->fetch();

  // Fecha o conjunto de resultados antes de preparar a nova consulta
  $stmt->close();

  if($num_rows != 0) {
    header('location: register.php?error=Já existe um usuário com este email');
    exit(); // Adiciona exit para interromper a execução adicional
  }

  // Hash da senha
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insere um novo usuário
  $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_phone, user_password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param('ssss', $name, $email, $phone, $hashed_password);

  if($stmt->execute()) {
    $user_id = $stmt->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['logged_in'] = true;
    header('location: account.php?register_success=Você criou a conta com sucesso');
    exit(); // Adiciona exit para interromper a execução adicional
  } else {
    header('location: register.php?register_error=Não foi possível criar a conta');
    exit(); // Adiciona exit para interromper a execução adicional
  }
}
?>





<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta | KronosTech</title>
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


<!--CRIAR CONTA-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Criar Conta</h2>
        <br>
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">
          <p style="color: red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; }?></p>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Nome" required/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group">
                <label>Celular</label>
                <input type="number" class="form-control" id="register-phone" name="phone" placeholder="Celular" required/>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Senha" required/>
            </div>
            <div class="form-group">
                <label>Confirmar Senha</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirmar Senha" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="register" value="Criar Conta"/>
            </div>
            <div class="form-group">
                <a id="login-url"/>Já tem uma conta? <a href="login.php" style="color: #6221fe; text-decoration: none">Login</a>
            </div>
        </form>
    </div>
</section>


<?php include('layouts/footer.php'); ?>