<?php
function criaAdms() {
    if (!isset($_SESSION['banco_populado'])) {
        try {
            $pdo = conectar();       
                 

            $usuarios = [
                ['nome' => 'André', 'sobrenome' => 'Lucas', 'email' => 'andrelucas@educaLivre.com', 'celular' => '21900000000', 'senha' => '1234', 'genero' => 'M', 'dataCriacao' => '01-12-2024', 'isAdmin' => 1],
                ['nome' => 'Luiz', 'sobrenome' => 'Luz', 'email' => 'luizluz@educalivre.com', 'celular' => '11900000001', 'senha' => '1234', 'genero' => 'M', 'dataCriacao' => '01-12-2024', 'isAdmin' => 1],
                ['nome' => 'Monique', 'sobrenome' => 'Duarte', 'email' => 'moniqueduarte@educalivre.com', 'celular' => '21900000002', 'senha' => '1234', 'genero' => 'F', 'dataCriacao' => '01-12-2024', 'isAdmin' => 1],
                ['nome' => 'Victória', 'sobrenome' => 'Yumi', 'email' => 'victoriayumi@educalivre.com', 'celular' => '21900000003', 'senha' => '1234', 'genero' => 'F', 'dataCriacao' => '01-12-2024', 'isAdmin' => 1],
           

                ['nome' => 'João', 'sobrenome' => 'Silva', 'email' => 'joao.silva@gmail.com', 'celular' => '11987654321', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '15-11-2024'],
                ['nome' => 'Maria', 'sobrenome' => 'Santos', 'email' => 'maria.santos@hotmail.com', 'celular' => '11976543210', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '18-11-2024'],
                ['nome' => 'Pedro', 'sobrenome' => 'Oliveira', 'email' => 'pedro.oliveira@yahoo.com', 'celular' => '11965432109', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '20-11-2024'],
                ['nome' => 'Ana', 'sobrenome' => 'Costa', 'email' => 'ana.costa@gmail.com', 'celular' => '11954321098', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '22-11-2024'],
                ['nome' => 'Carlos', 'sobrenome' => 'Ferreira', 'email' => 'carlos.ferreira@outlook.com', 'celular' => '11943210987', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '25-11-2024'],
                ['nome' => 'Julia', 'sobrenome' => 'Almeida', 'email' => 'julia.almeida@gmail.com', 'celular' => '11932109876', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '28-11-2024'],
                ['nome' => 'Rafael', 'sobrenome' => 'Lima', 'email' => 'rafael.lima@hotmail.com', 'celular' => '11921098765', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '30-11-2024'],
                ['nome' => 'Camila', 'sobrenome' => 'Rodrigues', 'email' => 'camila.rodrigues@yahoo.com', 'celular' => '11910987654', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '02-12-2024'],
                ['nome' => 'Lucas', 'sobrenome' => 'Martins', 'email' => 'lucas.martins@gmail.com', 'celular' => '11998765432', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '04-12-2024'],
                ['nome' => 'Fernanda', 'sobrenome' => 'Pereira', 'email' => 'fernanda.pereira@outlook.com', 'celular' => '11987654322', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '06-12-2024'],
                ['nome' => 'Bruno', 'sobrenome' => 'Carvalho', 'email' => 'bruno.carvalho@gmail.com', 'celular' => '11976543211', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '08-12-2024'],
                ['nome' => 'Larissa', 'sobrenome' => 'Sousa', 'email' => 'larissa.sousa@hotmail.com', 'celular' => '11965432108', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '10-12-2024'],
                ['nome' => 'Thiago', 'sobrenome' => 'Barbosa', 'email' => 'thiago.barbosa@gmail.com', 'celular' => '11954321097', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '12-12-2024'],
                ['nome' => 'Beatriz', 'sobrenome' => 'Ribeiro', 'email' => 'beatriz.ribeiro@yahoo.com', 'celular' => '11943210986', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '14-12-2024'],
                ['nome' => 'Guilherme', 'sobrenome' => 'Dias', 'email' => 'guilherme.dias@outlook.com', 'celular' => '11932109875', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '16-12-2024'],
                ['nome' => 'Isabella', 'sobrenome' => 'Gomes', 'email' => 'isabella.gomes@gmail.com', 'celular' => '11921098764', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '18-12-2024'],
                ['nome' => 'Felipe', 'sobrenome' => 'Cunha', 'email' => 'felipe.cunha@hotmail.com', 'celular' => '11910987653', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '20-12-2024'],
                ['nome' => 'Gabriela', 'sobrenome' => 'Castro', 'email' => 'gabriela.castro@gmail.com', 'celular' => '11998765431', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '22-12-2024'],
                ['nome' => 'Vinicius', 'sobrenome' => 'Moreira', 'email' => 'vinicius.moreira@yahoo.com', 'celular' => '11987654320', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '24-12-2024'],
                ['nome' => 'Amanda', 'sobrenome' => 'Azevedo', 'email' => 'amanda.azevedo@outlook.com', 'celular' => '11976543209', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '26-12-2024'],
                ['nome' => 'Mateus', 'sobrenome' => 'Ramos', 'email' => 'mateus.ramos@gmail.com', 'celular' => '11965432107', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '28-12-2024'],
                ['nome' => 'Yasmin', 'sobrenome' => 'Freitas', 'email' => 'yasmin.freitas@hotmail.com', 'celular' => '11954321096', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '30-12-2024'],
                ['nome' => 'Leonardo', 'sobrenome' => 'Cardoso', 'email' => 'leonardo.cardoso@gmail.com', 'celular' => '11943210985', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '02-01-2025'],
                ['nome' => 'Sophia', 'sobrenome' => 'Mendes', 'email' => 'sophia.mendes@yahoo.com', 'celular' => '11932109874', 'senha' => 'senha123', 'genero' => 'F', 'dataCriacao' => '04-01-2025'],
                ['nome' => 'Diego', 'sobrenome' => 'Teixeira', 'email' => 'diego.teixeira@outlook.com', 'celular' => '11921098763', 'senha' => 'senha123', 'genero' => 'M', 'dataCriacao' => '06-01-2025']            
            ];
            foreach ($usuarios as $usuario) {
                $verificaExiste = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE email = :email");
                $verificaExiste->bindValue(':email', $usuario['email']);
                $verificaExiste->execute();
                $usuarioExiste = $verificaExiste->fetchColumn();
                if ($usuarioExiste == 0) {
                    $hashSenha = password_hash($usuario['senha'], PASSWORD_DEFAULT);
 $sql = $pdo->prepare("
                    INSERT INTO usuario (nome, sobrenome, email, celular, senha, genero, dataCriacao, isAdmin)
                    VALUES (:nome, :sobrenome, :email, :celular, :senha, :genero, :dataCriacao, :isAdmin)");
                    $sql->bindValue(':nome', $usuario['nome']);
                    $sql->bindValue(':sobrenome', $usuario['sobrenome']);
                    $sql->bindValue(':email', $usuario['email']);
                    $sql->bindValue(':celular', $usuario['celular']);
                    $sql->bindValue(':senha', $hashSenha);
                    $sql->bindValue(':genero', $usuario['genero']);
                    $sql->bindValue(':dataCriacao', $usuario['dataCriacao']);
                    $sql->bindValue(':isAdmin', isset($usuario['isAdmin']) ? $usuario['isAdmin'] : 0);
                    $sql->execute();
                }
            }
           
            $feedbacks = [
                ['texto' => 'Excelente plataforma! Me ajudou muito a organizar meus estudos para o ENEM.', 'data' => '16-11-2024', 'nota' => 5, 'idUsuario' => 5],
                ['texto' => 'Os simulados são muito bem estruturados e similares ao ENEM real.', 'data' => '19-11-2024', 'nota' => 5, 'idUsuario' => 6],
                ['texto' => 'Adorei as dicas de redação! Consegui melhorar muito minha escrita.', 'data' => '21-11-2024', 'nota' => 4, 'idUsuario' => 7],
                ['texto' => 'Site muito intuitivo e fácil de usar. Recomendo!', 'data' => '23-11-2024', 'nota' => 5, 'idUsuario' => 8],
                ['texto' => 'Os materiais de estudo são de alta qualidade. Muito bom!', 'data' => '26-11-2024', 'nota' => 4, 'idUsuario' => 9],
                ['texto' => 'Plataforma completa, tem tudo que preciso para estudar.', 'data' => '29-11-2024', 'nota' => 5, 'idUsuario' => 10],
                ['texto' => 'Os vídeos explicativos são muito claros e objetivos.', 'data' => '01-12-2024', 'nota' => 4, 'idUsuario' => 11],
                ['texto' => 'Consegui melhorar minhas notas depois que comecei a usar o site.', 'data' => '03-12-2024', 'nota' => 5, 'idUsuario' => 12],
                ['texto' => 'Interface poderia ser mais moderna, mas o conteúdo é excelente.', 'data' => '05-12-2024', 'nota' => 4, 'idUsuario' => 13],
                ['texto' => 'Muito útil ter todas as provas anteriores do ENEM em um só lugar.', 'data' => '07-12-2024', 'nota' => 5, 'idUsuario' => 14],
                ['texto' => 'Os simulados me deram mais confiança para fazer a prova.', 'data' => '09-12-2024', 'nota' => 4, 'idUsuario' => 15],
                ['texto' => 'Gostei muito das dicas sobre gerenciamento de tempo.', 'data' => '11-12-2024', 'nota' => 5, 'idUsuario' => 16],
                ['texto' => 'Plataforma gratuita e de qualidade. Parabéns aos desenvolvedores!', 'data' => '13-12-2024', 'nota' => 5, 'idUsuario' => 17],
                ['texto' => 'Material de matemática muito bem explicado.', 'data' => '15-12-2024', 'nota' => 4, 'idUsuario' => 18],
                ['texto' => 'Os temas de redação anteriores me ajudaram a treinar.', 'data' => '17-12-2024', 'nota' => 4, 'idUsuario' => 19],
                ['texto' => 'Site carrega rápido e funciona bem no celular também.', 'data' => '19-12-2024', 'nota' => 4, 'idUsuario' => 20],
                ['texto' => 'Consegui identificar minhas dificuldades através dos simulados.', 'data' => '21-12-2024', 'nota' => 5, 'idUsuario' => 21],
                ['texto' => 'Muito bom ter feedback detalhado após cada simulado.', 'data' => '23-12-2024', 'nota' => 5, 'idUsuario' => 22],
                ['texto' => 'A organização por matérias facilita muito o estudo.', 'data' => '25-12-2024', 'nota' => 4, 'idUsuario' => 23],
                ['texto' => 'Salvou meus estudos! Obrigada pela plataforma gratuita.', 'data' => '27-12-2024', 'nota' => 5, 'idUsuario' => 24],
                ['texto' => 'Poderia ter mais questões de física, mas no geral está ótimo.', 'data' => '29-12-2024', 'nota' => 4, 'idUsuario' => 25],
                ['texto' => 'Interface limpa e organizada. Fácil de navegar.', 'data' => '31-12-2024', 'nota' => 4, 'idUsuario' => 26],
                ['texto' => 'Os links para vídeos complementares são muito úteis.', 'data' => '03-01-2025', 'nota' => 5, 'idUsuario' => 27],
                ['texto' => 'Melhor site gratuito para estudar para o ENEM que já usei.', 'data' => '05-01-2025', 'nota' => 5, 'idUsuario' => 28],
                ['texto' => 'Consegui me organizar melhor nos estudos com ajuda da plataforma.', 'data' => '07-01-2025', 'nota' => 4, 'idUsuario' => 29]            
            ];
            foreach ($feedbacks as $feedback) {
                $sql = $pdo->prepare("INSERT INTO Feedback (textoFeedback, dataFeedback, notaFeedback, idUsuario)VALUES (:texto, :data, :nota, :idUsuario)                ");
                $sql->bindValue(':texto', $feedback['texto']);
                $sql->bindValue(':data', $feedback['data']);
                $sql->bindValue(':nota', $feedback['nota']);
                $sql->bindValue(':idUsuario', $feedback['idUsuario']);
                $sql->execute();
            }
            $dicas = [
                ['titulo' => 'Como organizar cronograma de estudos', 'texto' => 'Organize seu cronograma dividindo as matérias por dias da semana. Dedique mais tempo às disciplinas que você tem maior dificuldade e não esqueça de incluir revisões semanais. O segredo é manter a consistência!', 'data' => '05-12-2024', 'idUsuario' => 1],
                ['titulo' => 'Técnicas de memorização para História', 'texto' => 'Para memorizar datas históricas, crie linhas do tempo visuais e associe eventos a imagens marcantes. Use mapas mentais para conectar causas e consequências dos acontecimentos históricos.', 'data' => '10-12-2024', 'idUsuario' => 1],
                ['titulo' => 'Estratégias para questões de Matemática', 'texto' => 'Antes de resolver uma questão de matemática, leia cuidadosamente o enunciado e identifique o que está sendo pedido. Anote os dados importantes e escolha a fórmula adequada. Pratique muito!', 'data' => '15-12-2024', 'idUsuario' => 1],                                

                ['titulo' => 'Interpretação de textos: dicas essenciais', 'texto' => 'Para interpretar textos no ENEM, leia primeiro as perguntas para saber o que procurar. Identifique a ideia principal e os argumentos secundários. Cuidado com pegadinhas que usam palavras do texto fora de contexto.', 'data' => '06-12-2024', 'idUsuario' => 2],
                ['titulo' => 'Como melhorar sua redação rapidamente', 'texto' => 'Pratique a estrutura básica: introdução, desenvolvimento e conclusão. Na introdução, apresente o tema e sua tese. No desenvolvimento, use argumentos e exemplos. Na conclusão, proponha soluções viáveis.', 'data' => '12-12-2024', 'idUsuario' => 2],
                ['titulo' => 'Física no ENEM: o que mais cai', 'texto' => 'As questões de Física no ENEM focam em mecânica, eletricidade e termologia. Estude gráficos, interpretação de fenômenos do cotidiano e aplicações práticas. Menos decorar fórmulas, mais entender conceitos!', 'data' => '18-12-2024', 'idUsuario' => 2],                                
                              
                ['titulo' => 'Ansiedade na prova: como controlar', 'texto' => 'Para controlar a ansiedade durante a prova, pratique técnicas de respiração. Respire fundo pelo nariz, segure por 4 segundos e solte pela boca. Comece pelas questões mais fáceis para ganhar confiança.', 'data' => '08-12-2024', 'idUsuario' => 3],
                ['titulo' => 'Alimentação ideal para os estudos', 'texto' => 'Mantenha uma alimentação equilibrada durante os estudos. Inclua frutas, castanhas e muito líquido. Evite excesso de cafeína e açúcar. Faça refeições leves antes das provas para não passar mal.', 'data' => '14-12-2024', 'idUsuario' => 3],
                ['titulo' => 'Sono e estudos: encontrando o equilíbrio', 'texto' => 'Durma pelo menos 7-8 horas por noite. O sono é essencial para fixar o conteúdo estudado. Evite estudar até muito tarde, pois isso prejudica a concentração no dia seguinte. Qualidade é melhor que quantidade.', 'data' => '20-12-2024', 'idUsuario' => 3],                                
                // Dicas da Victória (ID 4)                
                ['titulo' => 'Ciências da Natureza: conectando disciplinas', 'texto' => 'No ENEM, Química, Física e Biologia aparecem integradas. Estude temas transversais como energia, meio ambiente e saúde. Entenda como os conceitos de uma disciplina se aplicam às outras.', 'data' => '07-12-2024', 'idUsuario' => 4],
                ['titulo' => 'Geografia: atualidades são fundamentais', 'texto' => 'Para Geografia no ENEM, acompanhe notícias sobre mudanças climáticas, conflitos geopolíticos e questões urbanas. Saiba interpretar mapas, gráficos e dados estatísticos. Conecte teoria com a realidade atual.', 'data' => '13-12-2024', 'idUsuario' => 4],
                ['titulo' => 'Últimos dias antes da prova', 'texto' => 'Na semana da prova, foque em revisão leve e cuidados pessoais. Não tente aprender conteúdo novo. Organize seus documentos, planeje o trajeto até o local de prova e durma bem. Confie na sua preparação!', 'data' => '19-12-2024', 'idUsuario' => 4]            
            ];
            foreach ($dicas as $dica) {
                $sql = $pdo->prepare("                    INSERT INTO Dica (tituloDica, textoDica, dataDica, idUsuario)                    VALUES (:titulo, :texto, :data, :idUsuario)                ");
                $sql->bindValue(':titulo', $dica['titulo']);
                $sql->bindValue(':texto', $dica['texto']);
                $sql->bindValue(':data', $dica['data']);
                $sql->bindValue(':idUsuario', $dica['idUsuario']);
                $sql->execute();
            }

            $_SESSION['banco_populado'] = true;
           
        } catch (PDOException $e) {
                error_log("Erro na limpeza de tokens: " . $e->getMessage());

        }
    } else {
    error_log("Banco ja populado!");
    }
}
?>
