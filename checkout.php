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

    
      .container-cep {
        justify-content: center;
        align-items: center;
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
        <a href="login.php" class="btn btn-primary">Login</a>
    <?php } ?>
    </p>
    <div class="container-cep">
      <label>Digite seu CEP: </label>
      <input type="number" id="cep" name="cep" required>
      <button type="button" class="btn btn-secondary" onclick="consultaEndereco()">Consultar</button>

      <div id="resultado">
      <form method="POST" action="place_order.php">
          <p>Endereço: <input type="text" name="address" id="endereco" readonly required></p>
          <p>Complemento: <input type="text" name="complemento" id="complemento" readonly required></p>
          <p>Bairro: <input type="text" name="bairro" id="bairro" readonly required></p>
          <p>Cidade: <input type="text" name="city" id="cidade" readonly required> - 
          <input type="text" name="uf" id="uf" readonly style="width: 35px;"></p>
          <input type="hidden" name="name" value="Nome do Usuário">
          <input type="hidden" name="email" value="email@exemplo.com">
          <input type="hidden" name="phone" value="123456789">
          <button type="submit" name="place_order">Enviar Pedido</button>
      </form>
      </div>
    </div>



    <!-- <button type="submit">Confirmar</button> -->
</form>
        
    </div>
</section>

<script>
function consultaEndereco() {
    let cep = document.querySelector('#cep').value;

    // Verificação do formato do CEP
    if (!/^\d{8}$/.test(cep)) { // Verifica se o CEP possui 8 dígitos numéricos
        alert('CEP inválido!');
        return;
    }

    let url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            mostrarEndereco(data);
        })
        .catch(error => console.error('Erro ao consultar o CEP:', error));
}

function mostrarEndereco(dados) {
    let resultado = document.querySelector('#resultado');
    if (dados.erro) {
      alert('Não foi possível localizar seu endereço!');
        
    } else {
        document.getElementById('endereco').value = dados.logradouro;
        document.getElementById('complemento').value = dados.complemento;
        document.getElementById('bairro').value = dados.bairro;
        document.getElementById('cidade').value = dados.localidade;
        document.getElementById('uf').value = dados.uf;

        // Habilitar campos para edição
        document.getElementById('endereco').readOnly = false;
        document.getElementById('complemento').readOnly = false;
        document.getElementById('bairro').readOnly = false;
        document.getElementById('cidade').readOnly = false;
        document.getElementById('uf').readOnly = false;
    }
}
</script>
<?php include('layouts/footer.php'); ?>