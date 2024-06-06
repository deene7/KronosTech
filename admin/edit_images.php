<?php include('header.php'); ?>

<?php 
if(isset($_GET['product_id']) && isset($_GET['product_name'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
} else {
    header('location: products.php');
}
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Alterar Imagens</h3>
            </div>
            <div class="card-body">

                <form method="post" enctype="multipart/form-data" action="update_images.php">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>"/>

                    <h4>Imagem 1:</h4> <input type="file" id="image1" name="image1">
                    <h4>Imagem 2:</h4> <input type="file" id="image2" name="image2">
                    <h4>Imagem 3:</h4> <input type="file" id="image3" name="image3">
                    <h4>Imagem 4:</h4> <input type="file" id="image4" name="image4"> <br> <br>
                    
                    <input type="submit" class="btn btn-primary" name="update_images" value="Alterar">
                </form>
            </div>
        </div>
    </div>
</div>
