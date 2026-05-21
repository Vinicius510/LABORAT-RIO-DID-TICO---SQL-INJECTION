<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Laboratório SQL Injection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Laboratório Didático: SQL Injection</h1>
    <div class="alerta">
        Use somente em <strong>localhost</strong> ou ambiente autorizado. O objetivo é aprender a encontrar falhas para corrigir sistemas.
    </div>

    <h2>Telas vulneráveis</h2>
    <div class="menu">
        <a class="card" href="login_vulneravel.php">1. Login (Corrigido)</a>
        <a class="card" href="buscar_usuario_vulneravel.php">2. Buscar usuário por ID (Corrigido)</a>
        <a class="card" href="produtos_vulneravel.php">3. Pesquisa de produtos (Corrigido)</a>
        <a class="card" href="admin_excluir_vulneravel.php">4. Painel admin/exclusão vulnerável</a>
        <a class="card" href="blind_vulneravel.php">5. Blind SQL Injection vulnerável</a>
    </div>

    <h2>Telas corrigidas</h2>
    <div class="menu">
        <a class="card" href="login_seguro.php">Login seguro</a>
        <a class="card" href="buscar_usuario_seguro.php">Busca por ID segura</a>
        <a class="card" href="produtos_seguro.php">Pesquisa segura</a>
        <a class="card" href="admin_excluir_seguro.php">Exclusão segura</a>
        <a class="card" href="blind_seguro.php">Blind seguro</a>
    </div>

    <h2>Usuários de teste</h2>
    <p><strong>admin@teste.com</strong> / 123456</p>
    <p><strong>aluno@teste.com</strong> / 123456</p>
</div>
</body>
</html>
