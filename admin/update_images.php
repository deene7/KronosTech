<?php
include('../server/connection.php');

if(isset($_POST['update_images'])) {
    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];

    $query = "SELECT product_image, product_image2, product_image3, product_image4 FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($current_image1, $current_image2, $current_image3, $current_image4);
    $stmt->fetch();
    $stmt->close();

    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];

    if($image1) {
        $image_name1 = $product_name."1.jpeg";
        move_uploaded_file($image1, "../assets/imgs/".$image_name1);
    } else {
        $image_name1 = $current_image1;
    }

    if($image2) {
        $image_name2 = $product_name."2.jpeg";
        move_uploaded_file($image2, "../assets/imgs/".$image_name2);
    } else {
        $image_name2 = $current_image2;
    }

    if($image3) {
        $image_name3 = $product_name."3.jpeg";
        move_uploaded_file($image3, "../assets/imgs/".$image_name3);
    } else {
        $image_name3 = $current_image3;
    }

    if($image4) {
        $image_name4 = $product_name."4.jpeg";
        move_uploaded_file($image4, "../assets/imgs/".$image_name4);
    } else {
        $image_name4 = $current_image4;
    }

    $stmt = $conn->prepare("UPDATE products SET product_image=?, product_image2=?, product_image3=?, product_image4=? WHERE product_id=?");
    $stmt->bind_param('ssssi', $image_name1, $image_name2, $image_name3, $image_name4, $product_id);

    if($stmt->execute()) {
        header('location: products.php?images_updated=As imagens foram alteradas com sucesso!!');
    } else {
        header('location: products.php?images_failed=Ocorreu um erro, tente novamente.');
    }
}
?>
