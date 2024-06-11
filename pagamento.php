<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['logged_in'])) {
    $textoBotao = "MINHA CONTA";
    $link = "account.php"; // Altere para o link da página de conta do usuário
} else {
    $textoBotao = "ENTRAR / REGISTRAR";
    $link = "login.php"; // Altere para o link da página de login/registro
}

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento | KronosTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/imgs/logomini.png" type="image/x-icon">
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

<!--PAGAMENTO-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Pagamento</h2>
        <hr class="custom-hr-shop mx-auto">
    </div>
    <div class="mx-auto container text-center">
        <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
            <p>Total a Pagar: <?php echo 'R$ ' . number_format($_SESSION['total'], 2, ',', '.'); ?></p>
            <div id="paypal-button-container"></div>
        <?php } elseif (isset($_POST['order_status']) && $_POST['order_status'] == "Aguardando Pagamento") { ?>
            <p>Total a Pagar: <?php echo 'R$ ' . number_format($_POST['order_total_price'], 2, ',', '.'); ?></p>
            <div id="paypal-button-container"></div>
        <?php } else { ?>
            <p>Você não fez um pedido.</p>
        <?php } ?>
    </div>
</section>

<script>
    window.onbeforeunload = function() {
        <?php unset($_SESSION['total']); ?>
    };
</script>

<script src="https://www.paypal.com/sdk/js?client-id=AeLKdP5lwvvPFdSXyHJDmgb4SRJc80NF8hcFPevHRF8uP_7hjLvH8Pen94QlxrwJ5fC07HSQ1Buh_VW2&currency=BRL"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : (isset($_POST['order_total_price']) ? $_POST['order_total_price'] : '0'); ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
            });
        }
    }).render('#paypal-button-container');
</script>

<?php include('layouts/footer.php'); ?>
