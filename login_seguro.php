<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Seguro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Login Seguro com Prepared Statement</h1>
    <p><a href="index.php">Voltar</a></p>

    <form method="POST">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="senha" placeholder="Senha">
        <button type="submit">Entrar</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo "<h3>SQL preparado:</h3><pre class='codigo'>SELECT * FROM usuarios WHERE email = ? AND senha = ?</pre>";

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        echo "<div class='resultado sucesso'>Login realizado como: <strong>" . htmlspecialchars($usuario["nome"]) . "</strong></div>";
    } else {
        echo "<div class='resultado erro'>Login ou senha inválidos.</div>";
    }
}
?>
</div>
</body>
</html>
