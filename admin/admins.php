<?php include('header.php'); ?>

<?php
include('../server/connection.php');

$is_filter_applied = false;

if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    // Se o usuário já entrou na página então o número da página fica selecionado
    $page_no = $_GET['page_no'];
} else {
    // Número padrão
    $page_no = 1;
}

// Retorna o número de produtos
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM admins");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// Atualize a consulta para recuperar todos os produtos
$stmt2 = $conn->prepare("SELECT * FROM admins");
$stmt2->execute();
$admins = $stmt2->get_result();
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Lista de Administradores</h3>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table width="100%" class="orders-table" id="tabelaOrdenada">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Nome</td>
                                <td>CPF</td>
                                <td>Email</td>
                                <td>Telefone</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($admin = $admins->fetch_assoc()) { ?>
                                <tr>
                                    <td><strong><?php echo $admin['admin_id']; ?></strong></td>
                                    <td><?php echo $admin['admin_name']; ?></td>
                                    <td><?php echo $admin['admin_cpf']; ?></td>
                                    <td><?php echo $admin['admin_email']; ?></td>
                                    <td><?php echo $admin['admin_phone']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
