<?php session_start(); ?>
<?php include('../server/connection.php'); ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Painel de Controle | KronosTech</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <input type="checkbox" id="nav-toggle" style="display: none;">
    <div class="sidebar">

        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span><span>KronosTech</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="active"><span class="las la-igloo"></span>
                    <span>Página Inicial</span></a>
                </li>
                <li>
                    <a href="products.php"><span class="las la-clipboard-list"></span>
                    <span>Produtos</span></a>
                </li>
                <li>
                    <a href="add_product.php"><span class="las la-list"></span>
                    <span>Adicionar Produtos</span></a>
                </li>
                <li>
                    <a href="orders.php"><span class="las la-receipt"></span>
                    <span>Pedidos</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-users"></span>
                    <span>Usuários</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-user-circle"></span>
                    <span>Conta</span></a>
                </li>
                <li>
                    <a href="logout.php?logout=1"><span class="las la-door-open"></span>
                    <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Painel de Controle
            </h2>
            <div class="user-wrapper">
                <img src="img 2.png" width="40px" height="40px">
                <div>
                    <h4><?php echo $_SESSION['admin_name']; ?></h4>
                    <small>Adm. KronosTech</small>
                </div>
            </div>
        </header>