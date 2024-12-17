<?php
// Configuração do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$nome_do_banco = 'form';

// Criar conexão
$conn = new mysqli($host, $usuario, $senha, $nome_do_banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os dados estão presentes no POST
    if (isset($_POST["email"]) && isset($_POST["senha"])) {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        // Prevenir SQL Injection usando prepared statements
        $stmt = $conn->prepare("INSERT INTO login (email, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $senha);

        // Executar a query
        if ($stmt->execute()) {
            // Se a inserção for bem-sucedida, redirecionar
            header("Location: html/index.html");
            exit;
        } else {
            // Caso ocorra algum erro
            echo "Erro na inserção dos valores: " . $stmt->error;
        }

        // Fechar a conexão
        $stmt->close();
    } else {
        // Caso os dados não estejam no POST, exibe um erro
        echo "Erro: Dados não enviados corretamente.";
    }
} else {
    echo "Erro: O formulário não foi enviado corretamente.";
}

// Fechar a conexão
$conn->close();
?>