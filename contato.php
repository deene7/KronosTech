<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | KronosTech</title>
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

<br>
<br>
<br>
  <!--CONTATO-->
  <section id="contact" class="container my-5 py-5">
    <div class="container text-center mt-5">
        <h3>Fale Conosco</h3>
        <hr class="custom-hr-shop mx-auto">
        <p class="w-50 mx-auto">
            Deseja tirar dúvidas ou solicitar um reembolso? Entre em contato concosco.
        </p>
        <p class="w-50 mx-auto">
            Whatsapp: <span>(61)9 8248-2666</span>
        </p>
        <p class="w-50 mx-auto">
            <p>Endereço de E-mail: <span>contato.kronostech@gmail.com</span></p>
        </p>
        <p class="w-50 mx-auto">
            A nossa equipe estará sempre à disposição para ajudar você.
        </p>

    </div>
  </section>
  <br>
  <br>

  <?php include('layouts/footer.php'); ?>