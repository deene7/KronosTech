<?php 
session_start();
include('../server/connection.php'); // Corrigido o caminho do arquivo
?>

<?php 
if(!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);

    if($stmt->execute()) {
        header('location: orders.php?deleted_successfully=O pedido foi excluido com sucesso!');
    } else {
        header('location: orders.php?deleted_failure=Não foi possível excluir o pedido.');
    }

    $stmt->close();
    $conn->close();
}
?>
