<?php include('header.php') ?>

<?php 
include('../server/connection.php');

// Consulta para obter categorias distintas
$query = "SELECT DISTINCT product_category FROM products";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $categories = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $categories = [];
}
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Adicionar Produto</h3>
            </div>
            <div class="card-body">

                <form method="post" enctype="multipart/form-data" action="create_product.php">

                    <h4>Nome:</h4> <input type="text" name="name" class="input-large" placeholder="Nome do Produto">
                    <h4>Descrição:</h4> <textarea name="description" class="input-large-textarea" placeholder="Descrição do Produto"></textarea>
                    <h4>Valor (R$):</h4> <input type="text" id="preco" name="price" class="input-large" placeholder="Valor do Produto" maxlength="7">
                    <h4>Categoria:</h4> 
                    <select name="category" class="input-large">
                        <option value="" disabled selected>Selecione a categoria correspondente</option>
                        <?php foreach ($categories as $category): ?>
                            <option class="category-option" value="<?php echo htmlspecialchars($category['product_category']); ?>"><?php echo htmlspecialchars($category['product_category']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <h4>Imagem 1:</h4> <input type="file" id="image1" name="image1">
                    <h4>Imagem 2:</h4> <input type="file" id="image2" name="image2">
                    <h4>Imagem 3:</h4> <input type="file" id="image3" name="image3">
                    <h4>Imagem 4:</h4> <input type="file" id="image4" name="image4"> <br> <br>
                    
                    <input type="submit" class="btn btn-primary" name="create_product" value="Adicionar">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
