<?php include('header.php'); ?>

<?php 
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();  // Fechar o statement após a execução
} else if (isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];


    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_category=? WHERE product_id=?");
    $stmt->bind_param('ssdsi', $name, $description, $price, $category, $product_id);

    if ($stmt->execute()) {
        $stmt->close();  // Fechar o statement após a execução
        $conn->close();  // Fechar a conexão após a execução
        header('location: products.php?edit_success_message=Você editou o produto com sucesso!');
        exit;
    } else {
        $stmt->close();  // Fechar o statement após a execução
        $conn->close();  // Fechar a conexão após a execução
        header('location: products.php?edit_failure_message=Ocorreu um erro ao editar o produto. Tente novamente.');
        exit;
    }

} else {
    header('Location: products.php');
    exit;
}
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Editar Produto</h3>
            </div>
            <div class="card-body">

                <form method="post" action="edit_product.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                    <h4>Nome:</h4> <input type="text" name="name" class="input-large" value="<?php echo $product['product_name']; ?>" placeholder="Nome do Produto"> <br><br>
                    <h4>Descrição:</h4> <textarea name="description" class="input-large-textarea" placeholder="Descrição do Produto"><?php echo $product['product_description']; ?></textarea> <br><br>
                    <h4>Valor (R$):</h4> <input type="text" id="preco" name="price" class="input-large" value="<?php echo $product['product_price']; ?>" placeholder="Valor do Produto" maxlength="7"> <br><br>
                    <h4>Categoria:</h4> <input type="text" name="category" class="input-large" value="<?php echo $product['product_category']; ?>" placeholder="Categoria do Produto"> <br><br>
                    <input type="submit" class="btn btn-primary" name="edit_btn" value="Editar">
                    
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('sidebar.php'); ?>

</body>
</html>
