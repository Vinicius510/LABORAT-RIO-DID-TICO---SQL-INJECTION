<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar Usuário Seguro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Busca de Usuário por ID - Segura</h1>
<p><a href="index.php">Voltar</a></p>

<form method="GET">
    <input type="number" name="id" placeholder="Digite o ID do usuário">
    <button type="submit">Buscar</button>
</form>

<?php
if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    $stmt = $conn->prepare("SELECT id, nome, email, perfil FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo "<h3>SQL preparado:</h3><pre class='codigo'>SELECT id, nome, email, perfil FROM usuarios WHERE id = ?</pre>";

    if ($resultado && $resultado->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nome</th><th>Email</th><th>Perfil</th></tr>";
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr><td>{$linha['id']}</td><td>" . htmlspecialchars($linha['nome']) . "</td><td>" . htmlspecialchars($linha['email']) . "</td><td>" . htmlspecialchars($linha['perfil']) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='resultado erro'>Nenhum usuário encontrado.</div>";
    }
}
?>
</div>
</body>
</html>
