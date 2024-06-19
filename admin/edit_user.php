<?php
include('header.php');
include('../server/connection.php');

// Verificar se o formulário foi submetido
if (isset($_POST['edit_btn'])) {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];

    // Verificar se o checkbox para alterar a senha está marcado
    if (isset($_POST['change_password'])) {
        $new_password = $_POST['new_password'];

        // Verificar se a nova senha atende aos requisitos mínimos
        if (strlen($new_password) < 6) {
            header('Location: edit_user.php?user_id=' . $user_id . '&password_error=Senha deve ter no mínimo 6 caracteres');
            exit;
        }

        // Hash bcrypt da nova senha
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET user_email=?, user_password=? WHERE user_id=?");
        $stmt->bind_param('ssi', $email, $hashed_password, $user_id);
    } else {
        // Se o checkbox para alterar senha não estiver marcado, atualizar apenas o email
        $stmt = $conn->prepare("UPDATE users SET user_email=? WHERE user_id=?");
        $stmt->bind_param('si', $email, $user_id);
    }

    // Executar a atualização
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header('Location: clientes.php?edit_success_message=Cliente editado com sucesso!');
        exit;
    } else {
        $stmt->close();
        $conn->close();
        header('Location: clientes.php?edit_failure_message=Ocorreu um erro ao editar o cliente. Tente novamente.');
        exit;
    }
} else {
    // Se o formulário não foi submetido, verificar se foi passado um user_id válido na URL
    if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        // Consultar o banco de dados para obter os detalhes do cliente
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar se o cliente existe
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "<p>Cliente não encontrado.</p>";
            exit; // Encerrar a execução se o cliente não for encontrado
        }

        $stmt->close(); // Fechar a declaração SQL
    } else {
        echo "<p>ID do cliente não especificado.</p>";
        exit; // Encerrar a execução se o ID do cliente não estiver presente na URL
    }
}
?>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Editar Cliente</h3>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['password_error'])): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($_GET['password_error']); ?></p>
                <?php endif; ?>
                <form method="post" action="edit_user.php">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <h4>Nome:</h4>
                    <p><?php echo $user['user_name']; ?></p>
                    <br>
                    <h4>CPF:</h4>
                    <p><?php echo $user['user_cpf']; ?></p>
                    <br>
                    <h4>Número de Telefone:</h4>
                    <p><?php echo $user['user_phone']; ?></p>
                    <br>
                    <h4>Email:</h4>
                    <input type="email" name="email" class="input-large" value="<?php echo $user['user_email']; ?>" placeholder="Email do Cliente">

                    <h4>Nova Senha:</h4>
                    <input type="password" name="new_password" class="input-large" placeholder="Deixe em branco se não deseja alterar">
                    <p><small>Deixe em branco se não deseja alterar a senha.</small></p>
                    <br>
                    <input type="checkbox" id="change_password" name="change_password">
                    <label for="change_password">Confirmar Mudança de Senha</label>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="edit_btn" value="Editar">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>


