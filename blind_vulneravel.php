<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Blind SQL Injection Vulnerável</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Blind SQL Injection - Vulnerável</h1>
<p><a href="index.php">Voltar</a></p>

<p>A tela não mostra dados nem erro detalhado. Ela só informa se encontrou ou não encontrou.</p>

<form method="GET">
    <input type="text" name="id" placeholder="ID do usuário">
    <button type="submit">Verificar existência</button>
</form>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // VULNERÁVEL
    $sql = "SELECT id FROM usuarios WHERE id = '$id'";

    echo "<h3>SQL gerado:</h3><pre class='codigo'>" . htmlspecialchars($sql) . "</pre>";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        echo "<div class='resultado sucesso'>Usuário encontrado.</div>";
    } else {
        echo "<div class='resultado erro'>Usuário não encontrado.</div>";
    }
}
?>

<h2>Testes didáticos</h2>
<pre class="codigo">1' AND '1'='1' #
1' AND '1'='2' #
1' OR '1'='1' #</pre>
</div>
</body>
</html>
