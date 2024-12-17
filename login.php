<?php
// Configuração do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$nome_do_banco = 'form';

$conn = new mysqli($host, $usuario, $senha, $nome_do_banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebendo os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    // Verificar a query SQL
    $sql = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado === FALSE) {
        echo "Erro na query SQL: " . $conn->error;
        exit();
    }

    if ($resultado->num_rows > 0) {
        echo "Login realizado com sucesso! Redirecionando...";
        header("Location: html/login.html");
        exit();
    } else {
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>erro</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>

    <div class="page">
            <form action="html/index.html" class="formLogin" method="POST">
            <h1>Login</h1>
            <br>
            <p>Email ou Senha incorretas</p>
            <p>Caso não tenha cadastro, volte e clique em cadastrar-se</p>
            <input type="submit" value="Voltar" class="btn" />
        </form>
        
    </div>
</body>
</html>

