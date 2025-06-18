# 🧠 EducaLivre - Versão Web

Essa é a versão web do EducaLivre, uma plataforma de estudos pré-vestibular desenvolvida como projeto de TCC. O sistema oferece conteúdos organizados por matéria e tópicos, redirecionamento para vídeo-aulas, simulados e área de feedback dos usuários.

## 🌐 Tecnologias utilizadas

- HTML, CSS e JavaScript (JQuery & ES6)
- PHP (back-end)
- SQLServer (banco de dados)
- XAMPP (ambiente de desenvolvimento)
- PHPMailer (envio de emails)
- dompdf (gerar pdf)

## ✨ Funcionalidades

- Cadastro e login de usuários
- Navegação por matérias e tópicos
- Resumos com links para playlists do YouTube
- Simulados com pontuação
- Dicas sobre vestibulares
- Feedback dos usuários

## Como rodar o projeto

### ⚙️ 1. Configurar a conexão com o banco de dados

Abra o arquivo `conexao.php` e substitua os valores abaixo de acordo com sua máquina:

```php
$local_server = "DESKTOP-77FVJ8D"; // nome do seu servidor local
$usuario_server = "sa";            // usuário do banco
$senha_server = "123";             // senha do banco
$banco_de_dados = "educaLivre";   // nome do banco de dados
```

### 🗃️ 2. Importar o banco de dados
Rode o script `educalivre.sql` que está na pasta /bd para criar e popular o banco de dados necessário.

>ℹ️ **Dica:** Você pode usar o phpMyAdmin, DBeaver, SSMS ou qualquer outro gerenciador de banco que preferir.

### 📧 3. Configurar o envio de e-mails
Edite o arquivo config_email_example.php e substitua pelos seus dados reais:

```php
Copiar
Editar
<?php
define('EMAIL_USERNAME', 'seu-email@gmail.com');
define('EMAIL_PASSWORD', 'sua-chave-do-app');
```
> ⚠️ **Atenção:** Para isso funcionar, você deve ativar a autenticação em dois fatores no Gmail e gerar uma [chave de acesso para app](https://myaccount.google.com/apppasswords).

🏁 4. Executar o script de inicialização
Por fim, acesse a página inicial (home) do projeto no navegador. Isso irá acionar um script automático que completa a estrutura inicial do banco de dados com os dados básicos para funcionamento do sistema.

>⚠️ **Importante:** Esse script só será executado se as etapas anteriores (conexão e importação do .sql) estiverem corretas. Certifique-se de que o banco está acessível e configurado corretamente.

## 📱 Acesse outras versões

- [Versão Mobile (Android)](https://github.com/beceluiz/EducaLivreMobileV2)
- [Versão Desktop (Admin)](https://github.com/beceluiz/EducaLivre-Desktop)

## 📌 Observações

Essa é uma **versão pública** do projeto, com os dados sensíveis removidos por segurança. Algumas funcionalidades podem não estar operacionais sem a configuração completa do ambiente.

---

Desenvolvido por Luiz Fernando dos Santos Luz como TCC do curso de Desenvolvimento de Sistemas.
