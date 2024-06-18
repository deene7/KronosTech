<?php 
session_start();
include('../server/connection.php'); // Corrigido o caminho do arquivo
?>

<?php 
if(!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param('i', $user_id);

    if($stmt->execute()) {
        header('location: clientes.php?deleted_successfully=O cliente foi excluido com sucesso!');
    } else {
        header('location: clientes.php?deleted_failure=Não foi possível excluir o cliente.');
    }

    $stmt->close();
    $conn->close();
}
?>
