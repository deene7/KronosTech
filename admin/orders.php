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

// Retorna o número de pedidos
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// Atualize a consulta para recuperar todos os pedidos
$stmt2 = $conn->prepare("SELECT * FROM orders");
$stmt2->execute();
$orders = $stmt2->get_result();
?>

<?php include('header.php') ?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Pedidos</h3>
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
                                <td>Status</td>
                                <td>Id do Cliente</td>
                                <td>Data do Pedido</td>
                                <td>Celular</td>
                                <td>Cidade</td>
                                <td>Detalhes</td>
                                <td>Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($order = $orders->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $order['order_id']; ?></td>
                                    <td><?php echo $order['order_status']; ?></td>
                                    <td><?php echo $order['user_id']; ?></td>
                                    <td><?php echo date('d/m/Y H:i:s', strtotime($order['order_date']));?></td>
                                    <td><?php echo $order['user_phone']; ?></td>
                                    <td><?php echo $order['user_city']; ?></td>
                                    <td><button><a class="btn btn-primary" href="view_order.php?order_id=<?php echo $order['order_id']; ?>">Detalhes</a></button></td>
                                    <td><button><a class="btn btn-primary" href="#" onclick="confirmDelete(<?php echo $order['order_id']; ?>)">Excluir</a></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(orderId) {
    if (confirm("Você tem certeza que deseja excluir este pedido?")) {
        window.location.href = "delete_order.php?order_id=" + orderId;
    }
}
</script>

</body>
</html>
