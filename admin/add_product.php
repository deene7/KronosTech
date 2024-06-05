<?php include('header.php') ?>

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
                    <h4>Categoria:</h4> <input type="text" name="category" class="input-large" placeholder="Categoria do Produto">
                    <h4>Imagem 1:</h4> <input type="file">
                    <h4>Imagem 2:</h4> <input type="file">
                    <h4>Imagem 3:</h4> <input type="file">
                    <h4>Imagem 4:</h4> <input type="file"> <br> <br>
                    
                    <input type="submit" class="btn btn-primary" name="edit_btn" value="Adicionar">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>