<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin Excluir Vulnerável</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Painel Admin - Exclusão Vulnerável</h1>
<p><a href="index.php">Voltar</a></p>

<div class="alerta">
    Para evitar apagar de verdade em aula, esta tela mostra o SQL de exclusão, mas não executa o DELETE.
</div>

<form method="POST">
    <input type="text" name="id" placeholder="ID do produto para excluir">
    <button type="submit">Simular exclusão</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // VULNERÁVEL
    $sql = "DELETE FROM produtos WHERE id = $id";

    echo "<h3>SQL que seria executado:</h3><pre class='codigo'>" . htmlspecialchars($sql) . "</pre>";

    echo "<div class='resultado erro'>Perigo: se o aluno digitar <strong>1 OR 1=1</strong>, a condição atinge todos os registros.</div>";
}
?>

<h2>Testes didáticos</h2>
<pre class="codigo">1
1 OR 1=1</pre>
</div>
</body>
</html>
