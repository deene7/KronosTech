<?php 
include('../server/connection.php');

if(isset($_POST['create_product'])) {
    $product_name = $_POST['name'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_category = $_POST['category'];

    // Diretório de upload
    $upload_dir = '../assets/imgs/';

    // Verifique se o diretório existe e tem permissões de escrita
    if (!is_dir($upload_dir) || !is_writable($upload_dir)) {
        die('Diretório de upload não existe ou não tem permissões de escrita.');
    }

    // Função para gerar nomes de arquivos únicos
    function generate_image_name($prefix, $index) {
        return $prefix . $index . '_' . time() . '.jpeg';
    }

    // Array para armazenar os caminhos das imagens
    $images = [];

    // Processar upload de cada imagem
    for ($i = 1; $i <= 4; $i++) {
        $image_key = 'image' . $i;
        if (isset($_FILES[$image_key]) && $_FILES[$image_key]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$image_key]['tmp_name'];
            $image_name = generate_image_name($product_name, $i);
            $target_path = $upload_dir . $image_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
                $images[] = $image_name;
            } else {
                die("Erro ao mover o arquivo $image_key.");
            }
        } else {
            $images[] = null;  // Ou defina um valor padrão caso a imagem não seja obrigatória
        }
    }

    // Certifique-se de que todas as imagens tenham sido processadas
    if (count($images) != 4) {
        die('Erro no upload das imagens.');
    }

    // Prepare a consulta SQL
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_image, product_image2, product_image3, product_image4, product_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('ssssssss', $product_name, $product_description, $product_price, $images[0], $images[1], $images[2], $images[3], $product_category);

    // Execute a consulta e verifique se foi bem-sucedida
    if ($stmt->execute()) {
        header('Location: products.php?product_created=O produto foi adicionado com sucesso!!');
    } else {
        header('Location: products.php?product_failed=Ocorreu um erro, tente novamente.');
    }
}
?>
