<?php include('header.php'); ?>

<?php 
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();

        $order = $stmt->get_result();

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
                <?php foreach($order as $r) { ?>

                    <div>
                        <label><strong>Id do Pedido</strong></label>
                        <p><?php echo $r['order_id'];?></p>
                    </div>
                    <br>
                    <div>
                        <label><strong>Valor do Pedido</strong></label>
                        <p style="color: green;"><strong><?php echo 'R$ ' . number_format($r['order_cost'], 2, ',', '.'); ?></strong></p>
                    </div>
                    <br>
                    <div>
                        <label><strong>Status</strong></label> <br>
                        <p><?php echo $r['order_status'];?></p>
                    </div>
                    <br>
                    <div>
                        <label><strong>Data do Pedido</strong></label>
                        <p><?php echo date('d/m/Y H:i:s', strtotime($r['order_date']));?></p>
                    </div>
                    <br>
                    <br>
                    <div class="card-header">
                        <h3>Detalhes do Cliente</h3>
                    </div>
                    <div>
                        <p>Id: <?php echo $r['user_id'];?> </p>
                        <p>Nome: </p>
                        <p>Celular: <?php echo $r['user_phone'];?></p>
                        <p>Cidade: <?php echo $r['user_city'];?></p>
                        <p>Endereço: <?php echo $r['user_address'];?></p>
                    </div>
                    

                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>