<?php
// Receber os dados do formulário
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$preco = $_POST['preco'];
$paginas = $_POST['paginas'];
$editora = $_POST['editora'];
$ano_publicacao = $_POST['ano_publicacao'];
$quantidade = $_POST['quantidade'];
$urlImagem = $_POST['url_imagem'];
$descricao = $_POST['descricao'];
$sinopse = $_POST['sinopse'];

// Gerar um número sequencial para o nome do arquivo (ex: itemL07.html)
$numero = rand(10, 99); // Ideal: usar ID do banco ou contar arquivos existentes
$nomeArquivo = "itemL$numero.html";

// Criar o conteúdo HTML com base no template
$html = <<<HTML
<!DOCTYPE html>
<html>s
<head>
    <title>Trabalho 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- opcional, só se usar jQuery -->
    <script src="js/scripts.js"></script> <!-- seu JS customizado -->

    <!--FEITO POR MIM-->

    <script>
        $().ready($(function() {
            $(".carousel").carousel({
                interval: 2000
            });
    }));
    </script>

    <link href="css/item.css" rel="stylesheet">

</head>

<body>
<body>
    <nav class="menu-navbar navbar navbar-expand-lg mb-4">
    <!--navbar: classe padrão do Bootstrap para criar uma navbar.
        navbar-expand-lg: torna o menu expansível (se adapta em telas pequenas).
        navbar-dark bg-dark: aplica um tema escuro.
        mb-4: margem inferior para afastar do conteúdo.-->

        <div class="container-fluid"><!-- container-fluid: ocupa toda a largura da tela.-->
            <a class="navbar-brand" href="inicio.html">LibreriaHonyasan</a><!--navbar-brand: nome ou logo do site-->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="inicio.html">Início</a>
                    </li>
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" href="estoque.html" id="estoqueDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Estoque
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="estoqueDropdown">
                            <li><a class="dropdown-item" href="estoque_livros.html">Livros</a></li>
                            <li><a class="dropdown-item" href="estoque_discos.html">Discos</a></li>
                            <li><a class="dropdown-item" href="estoque_total.html">Estoque Total</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Logout</a>
                    </li>
                </ul>
            </div>

            <form class="navbar-form navbar-left" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <div class="container">

        <h1 class="nome-livro">$titulo - $autor</h1>
        <h2><strong>$preco</strong></h2>

        <div class="row">

            <div class="col-md-6">
                <div id="carrossel-imagens" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carrossel-imagens" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carrossel-imagens" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carrossel-imagens" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carrossel-imagens" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="$urlImagem" class="img-fluid">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carrossel-imagens" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carrossel-imagens" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            </div>
            
            <div class="col-md-4">

                <div class="texto-lateral">
                    <h3>Informações Gerais</h3>
                    <p><strong>Título:</strong> $titulo</p>
                    <p><strong>Autor:</strong> $autor</p>
                    <p><strong>Páginas:</strong> $paginas</p>
                    <p><strong>Editora:</strong> $editora</p>
                    <p><strong>Data Publicação:</strong> $ano_publicacao</p>
                    <h3>Descrição</h3>
                    <p>$descricao</p>
                </div>

            </div>
        </div>

        <!-- Botões de contato -->
        <div class="botoes mt-4">

            <a href="formulario_editar_livros.html" class="btn botao-editar">
                <i class="bi bi-pen"></i>
                <span><strong>Editar</strong></span>
            </a>

        </div>

        <div class="mt-4 sinopse">
            <h3><strong>Sinopse</strong></h3>
            <p>$sinopse</p>
        </div>
    </div>
</body>
</html>
HTML;

// Salvar arquivo na pasta do site
file_put_contents("../$nomeArquivo", $html); // coloque a pasta correta

// Redirecionar ou exibir mensagem
header("Location: ../estoque_total.html");
exit;




include 'conexao_login.php';

$titulo = trim($_POST['titulo'] ?? '');
$autor = trim($_POST['autor'] ?? '');
$paginas = intval($_POST['paginas'] ?? 0);
$editora = trim($_POST['editora'] ?? '');
$ano_publicacao = trim($_POST['ano_publicacao'] ?? '');
$quantidade = intval($_POST['quantidade'] ?? 0);

if ($titulo && $autor && $paginas && $editora && $ano_publicacao && $quantidade) {
    $stmt = $conexao->prepare("
        INSERT INTO livros 
            (titulo, autor, paginas, editora, ano_publicacao, quantidade) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Erro na preparação: " . $conexao->error);
    }

    $stmt->bind_param("ssissi", 
        $titulo, $autor, $paginas, $editora, $ano_publicacao, $quantidade);

    if ($stmt->execute()) {
        header("Location: /Trabalho/trabalho/formulario_adicionar_livros.html");
    } 
    
    else {
        header("Location: /Trabalho/trabalho/formulario_adicionar_livros.html");
    }

    $stmt->close();

    } 
    
    else {
        // caso os campos obrigatórios não sejam preenchidos
        header("Location: /Trabalho/trabalho/formulario_adicionar_livros.html");
    }

$conexao->close();
?>
