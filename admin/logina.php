<?php
session_start();
include('../server/connection.php');

// Verificar se o usuário já está logado e redirecionar para o painel de controle
if(isset($_SESSION['admin_logged_in'])) {
    header('location: dashboard.php');
    exit;
}

// Verificar se o formulário foi enviado
if(isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email=? LIMIT 1");
    $stmt->bind_param('s', $email);

    if($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->fetch();

        // Verificar se a senha está correta
        if(password_verify($password, $admin_password)) {
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: dashboard.php?login_success=Você entrou na conta com sucesso');
            exit();
        } else {
            // Senha incorreta
            header('location: logina.php?error=Senha ou email incorretos');
            exit();
        }
    } else {
        // Erro genérico de banco de dados
        header('location: logina.php?error=Alguma coisa deu errado');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm. Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<section class="my-5 py-5 container-adm">
    <div class="container text-center mt-3 pt-5">
        <img src="assets/imgs/logomini.png" alt="logo" class="icon">
        <hr class="custom-hr-shop mx-auto">
        <h2 class="form-weight-bold">Login</h2>        
    </div>

    <div class="mx-auto container">
        <form id="login-form" method="POST" action="logina.php">
            <p style="color:red" class="text-center"><?php if(isset($_GET['error'])) {echo $_GET['error'];}  ?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Insira seu e-mail" required/>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Insira sua senha" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
            </div>
        </form>
    </div>
</section>

</body>
</html>
