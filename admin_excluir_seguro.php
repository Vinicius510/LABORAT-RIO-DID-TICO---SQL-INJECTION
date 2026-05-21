<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin Excluir Seguro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Painel Admin - Exclusão Segura</h1>
<p><a href="index.php">Voltar</a></p>

<div class="alerta">
    Esta tela também apenas simula. A correção usa conversão para inteiro e prepared statement.
</div>

<form method="POST">
    <input type="number" name="id" placeholder="ID do produto para excluir">
    <button type="submit">Simular exclusão segura</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST["id"];

    echo "<h3>SQL preparado:</h3><pre class='codigo'>DELETE FROM produtos WHERE id = ?</pre>";
    echo "<div class='resultado sucesso'>Valor recebido como inteiro: <strong>$id</strong>. O payload malicioso não é interpretado como SQL.</div>";
}
?>
</div>
</body>
</html>
