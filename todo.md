# Anotações TCC:

### correções: 

- [ ] Trocar cor do envelope do subscribe para branco.
- [ ] Padronizar cores em variáveis.
- [ ] Padronizar animações em variáveis.
- [X] Arrumar o botão de entrar, pq só quando clicka nas letras ele encaminha pra pagina de login.
- [x] Adicionar borda nos inputs do cadastro.
- [x] Criar arquivos separados para o Header e o Footer (header.php, footer.php) e depois usar include nas paginas que for utilizar footer e header pra não precisar ficar repetindo o código em todas as paginas que criar
- [x] Consertar Bug que os clicks continuam clickaveis mesmo depois do Accordion das Matérias fechar.
- [x] Colocar favicon.
- [ ] tirar importação de fonte de algumas paginas e importar no css.
- [ ] quando o usuario esta logado e clicka no link de recuperação de senha e altera, ele continua logado.
 
### implementações:
- [x] Transição entre pagina de login e pagina de cadastro.
- [x] Adicionar Logo e paleta de cores do site.
- [X] Adicionar Links corretos ao site.
- [ ] Trocar os strongs por spans e mudar o font-weight no CSS.

## Cadastro 
- [X] Validar inputs um por um, exemplo, regex para telefone e email, e usar CSS para dar feedback para usuario criando cadastro exemplo: ao tirar o foco do input e não cumprir os requisitos a borda ficar vermelha e colocar num ::after "o telefone tem que ter 11 digitos" "o email precisa de um @" etc...
- [X] Ao cadastrar, abrir um modal exibindo a mensagem "cadastro realizado com sucesso" e redirecionar o usuario para pagina de login.
- [x] Melhorar a responsividade do formulario do cadastro
- [x] Colocar limite de caracteres no campo "celular"
- [x] Mudar detalhes da form-image de roxo pra verde.
- [X] arrumar responsividade do formulario de cadastro.
- [ ] Validar email no cadastro.



## Login

- [x] Ao colocar e-mail e senha, ira checkar no banco de dados se usuario está cadastrado e fazer login se estiver.
- [x] Ao estar logado no site, o botão no header deve mudar para o nome do usuario e ao clickar nele abrirá um dashboard de usuario com algumas informações e talvez funcionalidades.
- [] Arrumar responsividade do Esqueci minha Senha
- [] Colocar Hover no esqueci minha senha.

## Matérias

- [x] Pagina só deve ser acessada se usuario estiver logado.
- [x] Adicionar matérias e tópicos.
- [X] Linkar cada tópico a uma playlist do youtube servindo como um curso gratuito daquele assunto.
- [x] Adicionar hover nos li dos accordions.
- [x] Quando clickar pra abrir o accordion, é pra seta (chevron) mudar a posição, mas por algum motivo não está funcionando.
- [x] Colocar animação nos accordions.
- [x] Só esta redirecionando pro link quando clicka nas palavras em vez da linha inteira.
- [ ] trocar o active do accordion para open.
- [x] colocar o tema do enem de 2024

## Dicas

- [x] Pagina só deve ser acessada se usuario estiver logado.
- [X] Vai precisar de permissões de ADM, para adicionar dicas a essa tela.
- [ ] formatar o texto que vem do campo textoDica da tabela dica.
- [ ] Colocar um botão de upvote e downvote, e o usuario vai poder votar, e quando for fazer a consulta que puxa cada dica e exibe na tela, ela vai filtrar por quem tem mais upvotes e botar em cima.
- [X] Mudar font-family do textoDica, ta feio.
- [X] Botão de cadastrar dica que aparece somente para ADMS.
- [X] Arrumar o titulo-dica que quando vai para uma resolução menor não quebra o texto e acaba cortando.
- [x] Filtrar as dicas na consulta SQL por maior id assim as ultimas registradas vão ser mostradas por ultimo.

## Feedbacks

- [X] Pagina só deve ser acessada se usuario estiver logado.
- [X] Quando usuário postar um feedback, aparecer dinamicamente na página.
- [ ] Filtrar feedbacks do site por notas dadas pelos usuários.
- [x] Tirar o cursor: pointer dos accordion-container dos feedbacks.

## Footer
- [ ] Linkar redes sociais reais aos icones.
- [ ] Linkar para paginas institucionais corretas.

## Header
- [x] Após usuario estar logado, trocar a palavra "Entrar" do botão para o "Sair"
- [X] Mudar a cor do botão de sair para vermelho quando usuario estiver logado

## Banco de Dados
- [X] em vez de ter tabela topico e conteudo, criar só topico, com tituloTopico, linkTopico.
- [ ] colocar try-catch

## Simulados
- [X] Arrumar alguns links das provas anteriores que estao quebrados.


## Futuras Implementações

- [ ] Dashboard do Usuario - pagina com painel onde ele pode acessar informações pessoais e altera-las, login, senha, email, ver estatisticas dele mesmo, quando tempo a conta foi criada... etc

- [ ] Dashboard de ADM - pagina com painel onde os administradores do site vão poder ver informações de usuarios, gerenciar permissões, conceder permissões de adms a outras usuarios, excluir usuarios, etc...

- [ ] Monitoramento de progresso - usuario vai poder checkar quais cursos ele ja assistiu e finalizou, continuar de onde parou, ver os simulados que ele ja fez e as notas que ele tirou, etc...

- [ ] Gamificação Completa - como no duolingo, usuario ganhará pontuação por acessar a plataforma diariamente, se acessar um curso, ou finaliza-lo ganhara mais pontos e até medalha e o site contará com um ranking, semanal, mensal, anual e todos os tempos, e até sistema de niveis de usuario.

- [ ] Comunidade e interação - Interações entre os usuarios da plataforma, exemplo: você pode responder as dicas postadas com opniões ou comentarios sobre a dica, você pode responder feedbacks feito por outros membros e eles podem te responder de volta e quem sabe até um chat dentro da plataforma para grupo de estudos.

- [x] Sistema de filtro em todas as paginas do site, filtrar por cursos e topicos mais acessados, filtrar feedbacks por nota ou por mais recente, filtrar dicas por mais recente ou mais votadas - mais votadas da semana, mes ou de todos os tempos (colocar um sistema de upvote e downvote nas dicas postadas)

- [ ] Conexão com redes sociais - usuario vai poder compartilhar em outra rede social quando finalizar um curso ou tirar tal nota em um vestibular