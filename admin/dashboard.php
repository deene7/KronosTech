<?php
// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_name'])) {
    header("Location: logina.php");
    exit();
}


include('../server/connection.php'); // Inclua o arquivo de conexão ao banco de dados

// Obter o total de clientes
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_clientes FROM users");
$stmt1->execute();
$stmt1->bind_result($total_clientes);
$stmt1->fetch();
$stmt1->close();

// Obter o total de admins
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_admins FROM admins");
$stmt1->execute();
$stmt1->bind_result($total_admins);
$stmt1->fetch();
$stmt1->close();

// Obter o total de produtos
$stmt2 = $conn->prepare("SELECT COUNT(*) AS total_produtos FROM products");
$stmt2->execute();
$stmt2->bind_result($total_produtos);
$stmt2->fetch();
$stmt2->close();

// Obter o total de pedidos
$stmt3 = $conn->prepare("SELECT COUNT(*) AS total_pedidos FROM orders");
$stmt3->execute();
$stmt3->bind_result($total_pedidos);
$stmt3->fetch();
$stmt3->close();

?>

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
<main>
    <h1>Bem-vindo de volta, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h1>
    <div class="cards">
        <div class="card-single">
            <div>
                <h1><?php echo $total_clientes; ?></h1>
                <span>Clientes</span>
            </div>
            <div>
                <span class="las la-users"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1><?php echo $total_admins; ?></h1>
                <span>Administradores</span>
            </div>
            <div>
                <span class="las la-users"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1><?php echo $total_produtos; ?></h1>
                <span>Produtos</span>
            </div>
            <div>
                <span class="las la-clipboard"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1><?php echo $total_pedidos; ?></h1>
                <span>Pedidos</span>
            </div>
            <div>
                <span class="las la-shopping-bag"></span>
            </div>
        </div>
    </div>
</main>
</div>
</body>
</html>

<script src="assets/js/script.js"></script>

