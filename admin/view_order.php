<?php include('header.php'); ?>

<?php 
$order = null; // Inicializa a variável $order
$user = null; // Inicializa a variável $user

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Obter detalhes do pedido
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order) {
        $user_id = $order['user_id'];

        // Obter detalhes do usuário
        $stmt = $conn->prepare("SELECT user_id, user_name, user_phone, user_email FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    }
}
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Detalhes do Pedido</h3>
            </div>
            <div class="card-body">

                <form method="post" action="edit_product.php">
                <?php if ($order) { ?>

                    <div>
                        <label><strong>Id do Pedido</strong></label>
                        <p><?php echo htmlspecialchars($order['order_id']); ?></p>
                    </div>
                    <br>
                    <div>
                        <label><strong>Valor do Pedido</strong></label>
                        <p style="color: green;"><strong><?php echo 'R$ ' . number_format($order['order_cost'], 2, ',', '.'); ?></strong></p>
                    </div>
                    <br>
                    <div>
                        <label><strong>Status</strong></label> <br>
                        <p><?php echo htmlspecialchars($order['order_status']); ?></p>
                    </div>
                    <br>
                    <div>
                        <label><strong>Data do Pedido</strong></label>
                        <p><?php echo date('d/m/Y H:i:s', strtotime($order['order_date'])); ?></p>
                    </div>
                    <br>
                    <br>
                    <div class="card-header">
                        <h3>Detalhes do Cliente</h3>
                    </div>
                    <div>
                        <p>Id: <?php echo htmlspecialchars($order['user_id']); ?> </p>
                        <p>Nome: <?php echo htmlspecialchars($user['user_name'] ?? ''); ?> </p>
                        <p>Celular: <?php echo htmlspecialchars($user['user_phone'] ?? ''); ?></p>
                        <p>Email: <?php echo htmlspecialchars($user['user_email'] ?? ''); ?></p>
                        <p>Cidade: <?php echo htmlspecialchars($order['user_city']); ?></p>
                        <p>Endereço: <?php echo htmlspecialchars($order['user_address']); ?></p>
                        <p>Complemento: <?php echo htmlspecialchars($order['complemento']); ?></p>
                    </div>

                <?php } else { ?>
                    <p>Pedido não encontrado.</p>
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
