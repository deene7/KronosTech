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
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$total_records_per_page = 4; // Alterado para 5 produtos por página
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
$stmt2->bind_param("ii", $offset, $total_records_per_page);
$stmt2->execute();
$products = $stmt2->get_result();
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Produtos</h3>

            </div>

            <!--MENSAGENS AO CRIAR PRODUTO -->
            <?php if(isset($_GET['product_created'])) {?>
            <p class="text-center" style="color: green;"><?php echo $_GET['product_created'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['product_failed'])) {?>
            <p class="text-center" style="color: red;"><?php echo $_GET['product_failed'] ?></p>
            <?php } ?>
            
            <!--MENSAGENS AO ALTERAR IMAGEM -->
            <?php if(isset($_GET['images_updated'])) {?>
            <p class="text-center" style="color: green;"><?php echo $_GET['images_updated'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['images_failed'])) {?>
            <p class="text-center" style="color: red;"><?php echo $_GET['images_failed'] ?></p>
            <?php } ?>

            
            <!--MENSAGENS AO EDITAR PRODUTO -->
            <?php if(isset($_GET['edit_success_message'])) {?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['edit_failure_message'])) {?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'] ?></p>
            <?php } ?>


            <!--MENSAGENS AO DELETAR PRODUTO -->
            <?php if(isset($_GET['deleted_successfully'])) {?>
            <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['deleted_failure'])) {?>
            <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'] ?></p>
            <?php } ?>


            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="orders-table">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Img</td>
                                <td>Nome</td>
                                <td>Valor</td>
                                <td>Quant</td>
                                <td>Categoria</td>
                                <td>Descrição</td>
                                <td>Editar</td>
                                <td>Editar</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($product = $products->fetch_assoc()) { ?>
                                <tr>
                                    <td><strong><?php echo $product['product_id']; ?></strong></td>
                                    <td><img src="<?php echo "../assets/imgs/" . $product['product_image']; ?>" style="width: 70px; height: 70px;"/></td>
                                    <td><?php echo $product['product_name']; ?></td>
                                    <td style="color: #6221fe;"><?php echo 'R$ ' . number_format($product['product_price'], 2, ',', '.'); ?></td><td><?php echo $product['product_quant']; ?></td>
                                    <td><?php echo $product['product_category']; ?></td>
                                    <td><?php echo $product['product_description']; ?></td>
                                    
                                    <td><button><a class="btn btn-primary" href="edit_images.php?product_id=<?php echo $product['product_id']; ?>&product_name=<?php echo $product['product_name']; ?>">Imagens</a></button></td>
                                    <td><button><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Detalhes</a></button></td>
                                    <td><button><a class="btn btn-primary" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Excluir</a></button></td>
                                    <td><hidden button></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <ul>
                        <?php if($page_no > 1) { ?>
                        
                            <li><a href="?page_no=<?php echo $previous_page; ?>">Anterior</a></li>
                        <?php } ?>

                        <?php for($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
                            <?php if($counter == $page_no) { ?>
                                <li><a class="active"><?php echo $counter; ?></a></li>
                            <?php } else { ?>
                                <li><a href="?page_no=<?php echo $counter; ?>"><?php echo $counter; ?></a></li>
                            <?php } ?>
                        <?php } ?>

                        <?php if($page_no < $total_no_of_pages) { ?>
                            <li><a href="?page_no=<?php echo $next_page; ?>">Próxima</a></li>
                            
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
