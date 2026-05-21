# Laboratório de SQL Injection - Versão Corrigida

Este repositório contém uma versão corrigida do laboratório didático de SQL Injection, focando na prevenção de vulnerabilidades através do uso de Prepared Statements.

## Integrantes da Dupla

*   [Nome do Integrante 1]
*   [Nome do Integrante 2]

## Telas Corrigidas

Foram selecionadas e corrigidas as seguintes telas:

1. `login_vulneravel.php` (o arquivo original foi modificado para incluir a correção)
2. `buscar_usuario_vulneravel.php` (o arquivo original foi modificado para incluir a correção)
3. `produtos_vulneravel.php` (o arquivo original foi modificado para incluir a correção)

As versões `login_seguro.php`, `buscar_usuario_seguro.php`, `produtos_seguro.php` já implementavam as correções e servem como referência para comparação.

## 1. Login (`login_vulneravel.php`)

### Explicação da Vulnerabilidade

A versão vulnerável (`login_vulneravel.php` original) construía a consulta SQL de autenticação concatenando diretamente as entradas do usuário (email e senha) na string da consulta. Isso permitia que um atacante inserisse trechos de código SQL maliciosos, como `' OR '1'='1' #`, para manipular a lógica da consulta e realizar um login sem credenciais válidas. Por exemplo:

```sql
SELECT * FROM usuarios WHERE email = 'admin@teste.com' OR '1'='1' #' AND senha = 'qualquer coisa'
```

Onde `' OR '1'='1' #` faz com que a condição `OR '1'='1'` seja sempre verdadeira, e o `#` comenta o restante da consulta, ignorando a verificação da senha.

### Explicação da Correção Aplicada

A correção foi implementada utilizando **Prepared Statements** com a extensão MySQLi do PHP. A consulta SQL é pré-definida com *placeholders* (`?`) para os valores que serão fornecidos pelo usuário. Em seguida, os valores são vinculados a esses *placeholders* de forma segura, garantindo que sejam tratados como dados e não como parte da lógica SQL. Isso impede que caracteres especiais alterem a estrutura da consulta.

```php
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
```

Os parâmetros `"ss"` em `bind_param` indicam que ambos os valores (`$email` e `$senha`) são do tipo string.

## 2. Busca de Usuário por ID (`buscar_usuario_vulneravel.php`)

### Explicação da Vulnerabilidade

A versão vulnerável (`buscar_usuario_vulneravel.php` original) recebia um ID via parâmetro GET e o inseria diretamente na consulta SQL. Isso permitia que um atacante injetasse valores numéricos ou trechos de SQL para listar todos os usuários (`1 OR 1=1`), ou até mesmo extrair informações do banco de dados usando `UNION SELECT`.

```php
$sql = "SELECT id, nome, email, perfil FROM usuarios WHERE id = $id";
```

### Explicação da Correção Aplicada

A correção envolveu duas etapas:

1.  **Type Casting:** A entrada `$id` é explicitamente convertida para um inteiro usando `(int)$_GET["id"]`. Isso garante que apenas valores numéricos sejam considerados, descartando qualquer caractere não numérico que possa fazer parte de um ataque.
2.  **Prepared Statements:** Assim como no login, um Prepared Statement é utilizado. O ID (já convertido para inteiro) é vinculado ao *placeholder* da consulta.

```php
$id = (int)$_GET["id"];
$stmt = $conn->prepare("SELECT id, nome, email, perfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
```

O parâmetro `"i"` em `bind_param` indica que o valor (`$id`) é do tipo inteiro.

## 3. Pesquisa de Produtos (`produtos_vulneravel.php`)

### Explicação da Vulnerabilidade

A versão vulnerável (`produtos_vulneravel.php` original) permitia a pesquisa de produtos por nome, concatenando a entrada do usuário diretamente na cláusula `LIKE` da consulta SQL. Isso possibilitava a injeção de SQL para listar todos os produtos (`%' OR '1'='1' #`) ou exfiltrar dados de outras tabelas usando `UNION SELECT`.

```php
$sql = "SELECT id, nome, categoria, preco FROM produtos WHERE nome LIKE 
'%
$busca
%'";
```

### Explicação da Correção Aplicada

A correção para a pesquisa de produtos também utiliza **Prepared Statements**. O termo de busca é preparado adicionando os caracteres `%` antes e depois da entrada do usuário no lado do servidor, e então o termo completo é vinculado ao *placeholder* da consulta `LIKE`.

```php
$termo_busca = "%" . $_GET["busca"] . "%";
$stmt = $conn->prepare("SELECT id, nome, categoria, preco FROM produtos WHERE nome LIKE ?");
$stmt->bind_param("s", $termo_busca);
$stmt->execute();
```

O parâmetro `"s"` em `bind_param` indica que o valor (`$termo_busca`) é do tipo string.

## Como Executar o Projeto Localmente (XAMPP)

Para executar este laboratório corrigido em seu ambiente local, siga os passos abaixo:

1.  **Baixe e Instale o XAMPP:** Se você ainda não tem, baixe e instale o XAMPP (ou similar como WAMP/MAMP) para o seu sistema operacional. O XAMPP inclui Apache, MySQL e PHP.

2.  **Copie os Arquivos do Projeto:**
    *   Copie a pasta `repo_corrigido` (ou o nome que você deu ao seu repositório) para o diretório `htdocs` do XAMPP. Por exemplo:
        `C:\xampp\htdocs\repo_corrigido` (Windows)
        `/Applications/XAMPP/htdocs/repo_corrigido` (macOS)
        `/opt/lampp/htdocs/repo_corrigido` (Linux)

3.  **Inicie o Apache e MySQL:**
    *   Abra o painel de controle do XAMPP e inicie os serviços **Apache** e **MySQL**.

4.  **Importe o Banco de Dados:**
    *   Acesse o phpMyAdmin em seu navegador: `http://localhost/phpmyadmin`.
    *   Crie um novo banco de dados chamado `aula_sql_injection`.
    *   Selecione o banco de dados `aula_sql_injection` que você acabou de criar.
    *   Clique na aba `Importar`.
    *   Clique em `Escolher arquivo` e selecione o arquivo `banco.sql` que está dentro da pasta do seu projeto (`repo_corrigido/banco.sql`).
    *   Clique em `Executar` para importar o esquema e os dados.

5.  **Acesse o Laboratório:**
    *   Abra seu navegador e acesse a página inicial do laboratório:
        `http://localhost/repo_corrigido/index.php`

Agora você pode navegar pelas telas corrigidas e observar como as vulnerabilidades de SQL Injection foram mitigadas.

## Credenciais de Teste

Para testar as funcionalidades de login e busca, você pode usar as seguintes credenciais:

*   **Email:** `admin@teste.com` / **Senha:** `123456`
*   **Email:** `aluno@teste.com` / **Senha:** `123456`

Para a busca de usuário, os IDs válidos são `1`, `2` e `3`.

---

**Observação:** Este laboratório é para fins educacionais. Em um ambiente de produção, outras medidas de segurança, como validação de entrada robusta, tratamento de erros adequado e uso de senhas com hash, também seriam essenciais.
