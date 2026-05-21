<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Corrigido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Login - Versão Segura</h1>
    <p><a href="index.php">Voltar</a></p>

    <form method="POST">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // CORREÇÃO: Utilizando Prepared Statements para evitar SQL Injection
    // O '?' atua como um placeholder que será preenchido de forma segura pelo bind_param
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    
    // "ss" indica que ambos os parâmetros são strings
    $stmt->bind_param("ss", $email, $senha);
    
    // Executa a consulta preparada
    $stmt->execute();
    
    // Obtém o resultado da execução
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        echo "<div class='resultado sucesso'>Login realizado com sucesso! Bem-vindo, <strong>" . htmlspecialchars($usuario["nome"]) . "</strong>.</div>";
    } else {
        echo "<div class='resultado erro'>Email ou senha incorretos.</div>";
    }
    
    // Fecha o statement para liberar recursos
    $stmt->close();
}
?>
</div>
</body>
</html>
