<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos Corrigido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Pesquisa de Produtos - Versão Segura</h1>
    <p><a href="index.php">Voltar</a></p>

    <form method="GET">
        <input type="text" name="busca" placeholder="Digite o nome do produto" required>
        <button type="submit">Pesquisar</button>
    </form>

<?php
if (isset($_GET["busca"])) {
    // CORREÇÃO: Tratando o termo de busca para uso no LIKE
    $termo_busca = "%" . $_GET["busca"] . "%";

    // CORREÇÃO: Utilizando Prepared Statements para a cláusula LIKE
    $stmt = $conn->prepare("SELECT id, nome, categoria, preco FROM produtos WHERE nome LIKE ?");
    
    // "s" indica que o parâmetro é uma string
    $stmt->bind_param("s", $termo_busca);
    
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Produto</th><th>Categoria</th><th>Preço</th></tr>";
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr><td>{$linha['id']}</td><td>" . htmlspecialchars($linha['nome']) . "</td><td>" . htmlspecialchars($linha['categoria']) . "</td><td>R$ " . number_format($linha['preco'], 2, ',', '.') . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='resultado erro'>Nenhum produto encontrado com o termo '" . htmlspecialchars($_GET["busca"]) . "'.</div>";
    }
    
    $stmt->close();
}
?>
</div>
</body>
</html>
