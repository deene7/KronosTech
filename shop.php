<?php
include('server/connection.php');

// Inicia a sessão, se ainda não estiver iniciada
session_start();
$category = ''; // Definindo a variável $category inicialmente como vazia
$is_filter_applied = false; // Variável para verificar se o filtro foi aplicado

// Verifica se o usuário está logado
if (isset($_SESSION['logged_in'])) {
    $textoBotao = "MINHA CONTA";
    $link = "sua_conta.php"; // Altere para o link da página de conta do usuário
} else {
    $textoBotao = "ENTRAR / REGISTRAR";
    $link = "account.php"; // Altere para o link da página de login/registro
}

// Verifica se o formulário de pesquisa foi submetido
if (isset($_POST['search']) || isset($_GET['category'])) {
    // Verifica se a categoria foi selecionada via formulário ou parâmetro de URL
    if (!empty($_POST['category'])) {
        $category = $_POST['category'];
    } elseif (!empty($_GET['category'])) {
        $category = $_GET['category'];
    } else {
        $category = ''; // Se nenhum valor de categoria foi definido, define como vazio
    }

    // Marca que um filtro foi aplicado
    $is_filter_applied = true;

    // Prepara a consulta SQL para selecionar produtos apenas com a categoria selecionada
    if (!empty($category)) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ?");
        $stmt->bind_param("s", $category);
    } else {
        // Se a categoria não foi selecionada, retorna todos os produtos
        $stmt = $conn->prepare("SELECT * FROM products");
    }

    // Executa a consulta preparada
    $stmt->execute();
    $products = $stmt->get_result();
    $products_array = $products->fetch_all(MYSQLI_ASSOC);

} else {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        // Se o usuário já entrou na página então o número da página fica selecionado
        $page_no = $_GET['page_no'];
    } else {
        // Número padrão
        $page_no = 1;
    }

    // Retorna o número de produtos
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    $stmt2->bind_param("ii", $offset, $total_records_per_page);
    $stmt2->execute();
    $products = $stmt2->get_result();
    $products_array = $products->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja | KronosTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/imgs/logomini.png" type="image/x-icon">
    <style>
        .pagination a {
            color: #6222fe;
        }

        .pagination li:hover a {
            color: #fff;
            background-color: #6222fe;
        }

        #marca img {
            max-width: 11%;
            height: auto;
        }
        #shop {
            width: 70%;
            display: inline-block;
        }
    </style>
</head>
<body>

<!--BARRA DE NAVEGAÇÃO-->
<?php include('layouts/navbar.php'); ?>

<!--PRODUTOS TEXT-->
<section id="featured" class="my-5 py-5">
    <div class="container-fluid mt-4 py-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <h3>Nossos Produtos</h3>
                <hr class="custom-hr-index">
                <p>Aqui você pode ver os produtos oferecidos pela KronosTech.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <!--Filtro-->
        <div id="search" class="col-lg-3 col-md-3 col-sm-12 my-4 py-4" style="margin-top: -50px;margin-left: -50px;">
            <div class="container mt-0 py-0">
                <p>Filtrar Produtos</p>
                <hr class="custom-hr-index">

                <form action="shop.php" method="POST" id="filterForm">
                    <div class="row mx-auto container">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>Departamentos</p>
                            <?php
                            $categories = [
                                'processador' => 'Processador',
                                'placa de vídeo' => 'Placa de Vídeo',
                                'placa mãe' => 'Placa Mãe',
                                'memória' => 'Memória RAM',
                                'teclado' => 'Teclado Gamer',
                                'mouse' => 'Mouse Gamer',
                                'fone de ouvido' => 'Fones de Ouvido',
                                'hdd' => 'HDD',
                                'ssd' => 'SSD',
                                'cadeira' => 'Cadeira Gamer',
                                'monitor' => 'Monitor Gamer',
                                'fonte' => 'Fonte de Alimentação',
                                'gabinete' => 'Gabinete Gamer'
                            ];
                            foreach ($categories as $key => $value) {
                                echo '
                                    <div class="form-check">
                                        <input class="form-check-input" value="' . $key . '" type="radio" name="category" id="category_' . $key . '" ' . ($category == $key ? 'checked' : '') . '>
                                        <label class="form-check-label" for="category_' . $key . '">' . $value . '</label>
                                    </div>
                                ';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group my-3 mx-3">
                        <input type="submit" name="search" value="Filtrar" class="btn btn-primary">
                        <input type="submit" name="clear_filter" value="Limpar Filtro" class="btn btn-secondary">
                    </div>
                </form>
            </div>
        </div>

        <!--CARDS PRODUTOS-->
        <div id="shop" class="col-lg-9 col-md-9 col-sm-12">
            <div class="row">
                <?php foreach (array_slice($products_array, 0, 60) as $row) { ?>
                    <!-- Produtos -->
                    <div class="product col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="row container">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <img class="card-img-top" src="assets/imgs/<?php echo $row['product_image']; ?>">
                                    <h5 class="p-name" title="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?></h5>
                                    <hr>
                                    <h4 class="p-price" style="color: #6221fe;">R$ <?php echo number_format($row['product_price'], 2, ',', '.'); ?></h4>
                                    <a href="<?php echo "produto1.php?product_id=" . $row['product_id']; ?>"><button class="btn btn-primary">Comprar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Navegação de Página-->
            <?php if (!$is_filter_applied) { ?>
            <div class="row">
                <nav aria-label="Page navigation example" class="mx-auto">
                    <ul class="pagination mt-5 mx-auto">
                        <li class="page-item <?php if ($page_no <= 1) { echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if ($page_no <= 1) { echo '#'; } else { echo "?page_no=" . ($page_no - 1); } ?>">Anterior</a>
                        </li>

                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                        <?php if ($page_no >= 3) { ?>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no ?>"><?php echo $page_no; ?></a></li>
                        <?php } ?>

                        <li class="page-item <?php if ($page_no >= $total_no_of_pages) { echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) { echo '#'; } else { echo "?page_no=" . $next_page; } ?>">Próximo</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
