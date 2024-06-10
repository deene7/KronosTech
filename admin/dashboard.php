<?php
// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_name'])) {
    header("Location: logina.php");
    exit();
}

include('header.php');
include('../server/connection.php'); // Inclua o arquivo de conexão ao banco de dados

// Obter o total de clientes
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_clientes FROM users");
$stmt1->execute();
$stmt1->bind_result($total_clientes);
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
