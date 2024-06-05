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
$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT ?, ?");
$stmt2->bind_param("ii", $offset, $total_records_per_page);
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" class="orders-table">
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Status</td>
                                    <td>Id do Cliente</td>
                                    <td>Data do Pedido</td>
                                    <td>Telefone</td>
                                    <td>Cidade</td>
                                    <td>Detalhes</td>
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
                                        <td><button><a class="btn btn-danger">Excluir</a></button></td>
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