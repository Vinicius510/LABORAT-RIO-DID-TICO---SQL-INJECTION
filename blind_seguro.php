<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Blind SQL Injection Seguro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Blind SQL Injection - Seguro</h1>
<p><a href="index.php">Voltar</a></p>

<form method="GET">
    <input type="number" name="id" placeholder="ID do usuário">
    <button type="submit">Verificar existência</button>
</form>

<?php
if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo "<h3>SQL preparado:</h3><pre class='codigo'>SELECT id FROM usuarios WHERE id = ?</pre>";

    if ($resultado && $resultado->num_rows > 0) {
        echo "<div class='resultado sucesso'>Usuário encontrado.</div>";
    } else {
        echo "<div class='resultado erro'>Usuário não encontrado.</div>";
    }
}
?>
</div>
</body>
</html>
