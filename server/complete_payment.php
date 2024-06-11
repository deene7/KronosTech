<?php
session_start();
include('connection.php');

if (isset($_GET['transaction_id']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_status = "Pedido Pago";
    $transaction_id = $_GET['transaction_id'];
    $user_id = $_SESSION['user_id'];

    // Mudar order_status para PEDIDO PAGO
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    $stmt->execute();

    // Salvar info do pagamento no banco
    $stmt1 = $conn->prepare("INSERT INTO payments (order_id, user_id, transaction_id) VALUES (?, ?, ?);");
    $stmt1->bind_param('iis', $order_id, $user_id, $transaction_id);

    $stmt1->execute();

    // Ir para user account
    header("location: ../account.php?payment_message=Pedido pago com sucesso!!. A KronosTech agradece a sua compra.");
    exit;

} else {
    header("location: index.php");
    exit;
}
?>
