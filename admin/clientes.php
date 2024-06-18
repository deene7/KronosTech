<?php include('header.php'); ?>

<?php
include('../server/connection.php');

$is_filter_applied = false;

if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM users");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$stmt2 = $conn->prepare("SELECT * FROM users");
$stmt2->execute();
$users = $stmt2->get_result();
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Lista de Clientes</h3>
            </div>

            <?php if(isset($_GET['deleted_successfully'])) {?>
            <p class="text-center" style="color: green; text-align: center; font-weight: bold;"><?php echo $_GET['deleted_successfully'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['deleted_failure'])) {?>
            <p class="text-center" style="color: red; text-align: center; font-weight: bold;"><?php echo $_GET['deleted_failure'] ?></p>
            <?php } ?>

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
                                <td>Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($user = $users->fetch_assoc()) { ?>
                                <tr>
                                    <td><strong><?php echo $user['user_id']; ?></strong></td>
                                    <td><?php echo $user['user_name']; ?></td>
                                    <td><?php echo $user['user_cpf']; ?></td>
                                    <td><?php echo $user['user_email']; ?></td>
                                    <td><?php echo $user['user_phone']; ?></td>
                                    <td><button><a class="btn btn-primary" href="#" onclick="confirmDelete(<?php echo $user['user_id']; ?>)">Excluir</a></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId) {
    if (confirm("Você tem certeza que deseja excluir este cliente?")) {
        window.location.href = "delete_user.php?user_id=" + userId;
    }
}
</script>

</body>
</html>
