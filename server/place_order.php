<?php
session_start();
include('connection.php');

//se o usuario nao esta logado
if(!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Para realizar um pedido é necessário fazer login/criar conta');
    exit;
}

date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para Brasília


if(isset($_POST['place_order'])) {

//1.pegar info do usuario e salvar no banco de dados
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'];
$order_cost = $_SESSION['total'];
$order_status = "Aguardando Pagamento";
$user_id = $_SESSION['user_id'];
$order_date = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
VALUES (?,?,?,?,?,?,?); ");

$stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

$stmt_status = $stmt->execute();

if(!$stmt_status) {
    header('location: index.php');
    exit;
}

//2.emitir novo pedido e salvar info do pedido no banco de dados
$order_id = $stmt->insert_id;


//3.pegar produtos do carrinho(da session)
foreach($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];


    //4. salvar cada produto no order_items do banco
    $stmt1 = $conn->prepare("INSERT INTO order_items(order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
    VALUES (?,?,?,?,?,?,?,?)");

    $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

    $stmt1->execute();
}

//5. remover tudo do carrinho -- dps do pagamento ser feito


//6.informar ao usuário se está tudo ok ou se tem algum problema
header('location: ../pagamento.php?order_status=Pedido Realizado com Sucesso');
// Limpar a sessão do carrinho após o checkout bem-sucedido
unset($_SESSION['cart']);

}
?>