
<?php include('header.php'); ?>  
<?php include('sidebar.php'); ?>

<main>
    <h1>Bem vindo de volta, <?php echo $_SESSION['admin_name']; ?>!</h1>
    <div class="cards">
        <div class="card-single">
            <div>
                <h1>0</h1>
                <span>Clientes</span>
            </div>
            <div>
                <span class="las la-users"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>0</h1>
                <span>Produtos</span>
            </div>
            <div>
                <span class="las la-clipboard"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>0</h1>
                <span>Pedidos</span>
            </div>
            <div>
                <span class="las la-shopping-bag"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>R$5k</h1>
                <span>Renda</span>
            </div>
            <div>
                <span class="lab la-google-wallet"></span>
            </div>
        </div>
    </div>
</main>
</div>
</body>
</html>

