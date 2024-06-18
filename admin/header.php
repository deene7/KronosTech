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
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css"> -->
    <link rel="icon" href="../assets/imgs/logomini.ico" type="image/x-icon">
    <!-- Incluindo jQuery do CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluindo DataTables CSS do CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Incluindo DataTables JS do CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabelaOrdenada').DataTable({
                "language": {
                    "url": "assets/json/Portuguese-brasil.json"
                }
            });
        });
    </script>
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
                    <a href="clientes.php"><span class="las la-users"></span>
                    <span>Clientes</span></a>
                </li>
                <li>
                    <a href="admins.php"><span class="las la-users"></span>
                    <span>Administradores</span></a>
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

        <script src="assets/js/script.js"></script>