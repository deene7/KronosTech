<!--ESSE LAYOUT SÓ N VAI TER NO REGISTER E LOGIN-->



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
            <a href="cart.php"><ion-icon name="cart"></ion-icon>
              <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0) { ?>
                <span class="cart-quantity"> <?php echo $_SESSION['quantity']; ?></span>
                <?php } ?>
            
          </a>

          </li> 
        </ul>  
        <div class="butaobrita">
        <a href="account.php"><button class="bbnavbar" id="bbnavbar"><?php echo $textoBotao; ?></button></a>
            <label class="switch">
              <input type="checkbox" id="darkModeToggle">
              <span class="slider"></span>
            </label>
          </div>
      </div>
    </div>
  </nav>