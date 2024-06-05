<?php 
session_start();
include('../server/connection.php'); // Corrigido o caminho do arquivo
?>

<?php 
if(!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param('i', $product_id);

    if($stmt->execute()) {
        header('location: products.php?deleted_successfully=O produto foi excluido com sucesso!');
    } else {
        header('location: products.php?deleted_failure=Não foi possível excluir o produto.');
    }

    $stmt->close();
    $conn->close();
}
?>
