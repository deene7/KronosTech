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
    $quant = $_POST['quantity'];
    $category = $_POST['category'];

    // $product_quant = $_POST['quantity']; // Novo campo product_quant


    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_quant=?, product_category=? WHERE product_id=?");
    // $stmt->bind_param('ssdsii', $name, $description, $price, $quant, $category, $product_id);
    $stmt->bind_param('ssdisi', $name, $description, $price, $quant, $category, $product_id);
    



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

                    <h4>Nome:</h4> <input type="text" name="name" class="input-large" value="<?php echo $product['product_name']; ?>" placeholder="Nome do Produto">
                    <h4>Descrição:</h4> <textarea name="description" class="input-large-textarea" placeholder="Descrição do Produto"><?php echo $product['product_description']; ?></textarea>
                    <h4>Valor (R$):</h4> <input type="text" id="preco" name="price" class="input-large" value="<?php echo $product['product_price']; ?>" placeholder="Valor do Produto" maxlength="7">
                    <h4>Quantidade:</h4> <input type="number" id="quant" name="quantity" class="input-large" value="<?php echo $product['product_quant']; ?>" placeholder="Quant. do Produto" maxlength="7">
                    <h4>Categoria: </h4>
                    <select name="category" class="input-large">
                        <option value="" disabled="">Selecione a categoria correspondente</option>
                        <option class="category-option" value="Placa Mãe" <?php if ($product['product_category'] == "Placa Mãe") echo "selected"; ?>>Placa Mãe</option>
                        <option class="category-option" value="Fone de ouvido" <?php if ($product['product_category'] == "Fone de ouvido") echo "selected"; ?>>Fone de ouvido</option>
                        <option class="category-option" value="Processador" <?php if ($product['product_category'] == "Processador") echo "selected"; ?>>Processador</option>
                        <option class="category-option" value="Placa de vídeo" <?php if ($product['product_category'] == "Placa de vídeo") echo "selected"; ?>>Placa de vídeo</option>
                        <option class="category-option" value="Gabinete" <?php if ($product['product_category'] == "Gabinete") echo "selected"; ?>>Gabinete</option>
                        <option class="category-option" value="Memória" <?php if ($product['product_category'] == "Memória") echo "selected"; ?>>Memória</option>
                        <option class="category-option" value="Mouse" <?php if ($product['product_category'] == "Mouse") echo "selected"; ?>>Mouse</option>
                        <option class="category-option" value="SSD" <?php if ($product['product_category'] == "SSD") echo "selected"; ?>>SSD</option>
                        <option class="category-option" value="HDD" <?php if ($product['product_category'] == "HDD") echo "selected"; ?>>HDD</option>
                        <option class="category-option" value="Fonte" <?php if ($product['product_category'] == "Fonte") echo "selected"; ?>>Fonte</option>
                        <option class="category-option" value="Cadeira" <?php if ($product['product_category'] == "Cadeira") echo "selected"; ?>>Cadeira</option>
                        <option class="category-option" value="Teclado" <?php if ($product['product_category'] == "Teclado") echo "selected"; ?>>Teclado</option>
                        <option class="category-option" value="Monitor" <?php if ($product['product_category'] == "Monitor") echo "selected"; ?>>Monitor</option>
                    </select>

                    
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="edit_btn" value="Editar">
                    
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>
