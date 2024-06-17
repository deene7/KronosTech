<?php
session_start();
include('connection.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Para realizar um pedido é necessário fazer login/criar conta');
    exit;
}

date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para Brasília

if (isset($_POST['place_order'])) {

    //1. Pegar info do usuário e salvar no banco de dados
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $uf = $_POST['uf'];
    $cep = $_POST['cep'];
    $order_cost = $_SESSION['total'];
    $order_status = "Aguardando Pagamento";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Preparar e executar a inserção na tabela orders
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, complemento, bairro, uf, cep, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    if (!$stmt) {
        die("Erro na preparação do SQL: " . $conn->error);
    }
    
    $stmt->bind_param('isiisssssss', $order_cost, $order_status, $user_id, $phone, $city, $address, $complemento, $bairro, $uf, $cep, $order_date);
    
    if (!$stmt->execute()) {
        die("Erro na execução do SQL: " . $stmt->error);
    }
    
    //2. Emitir novo pedido e salvar info do pedido no banco de dados
    $order_id = $stmt->insert_id;

    //3. Pegar produtos do carrinho (da sessão)
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        //4. Salvar cada produto no order_items do banco
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt1) {
            die("Erro na preparação do SQL para order_items: " . $conn->error);
        }
        
        $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        
        if (!$stmt1->execute()) {
            die("Erro na execução do SQL para order_items: " . $stmt1->error);
        }
    }

    // Salva o order_id na sessão
    $_SESSION['order_id'] = $order_id;

    //5. Informar ao usuário se está tudo ok ou se tem algum problema
    header('location: ../pagamento.php?order_status=Pedido Realizado com Sucesso');

    //6. Limpar a sessão do carrinho após o checkout bem-sucedido
    unset($_SESSION['cart']);
}
?>
