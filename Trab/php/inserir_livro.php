<?php

    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $paginas = intval($_POST['paginas'] ?? 0);
    $editora = trim($_POST['editora'] ?? '');
    $ano_publicacao = trim($_POST['ano_publicacao'] ?? '');
    $quantidade = intval($_POST['quantidade'] ?? 0);

    if ($titulo && $autor && $paginas && $editora && $ano_publicacao && $quantidade > 0) { // Verifica se o livro já existe

        $stmt = $conexao->prepare("
            SELECT id, quantidade FROM livros 
            WHERE titulo = ? AND autor = ? AND paginas = ? AND editora = ? AND ano_publicacao = ?
        ");

        $stmt->bind_param("ssiss", $titulo, $autor, $paginas, $editora, $ano_publicacao);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) { // Livro já existe → atualiza a quantidade

            $livro = $resultado->fetch_assoc(); 
            $novaQuantidade = $livro['quantidade'] + $quantidade;

            $update = $conexao->prepare("UPDATE livros SET quantidade = ? WHERE id = ?");
            $update->bind_param("ii", $novaQuantidade, $livro['id']);
            $update->execute();
            $update->close();

        } else { // Livro não existe → insere novo

            $insert = $conexao->prepare("
                INSERT INTO livros 
                    (titulo, autor, paginas, editora, ano_publicacao, quantidade) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $insert->bind_param("ssissi", $titulo, $autor, $paginas, $editora, $ano_publicacao, $quantidade);
            $insert->execute();
            $insert->close();
        }

        $stmt->close();
        header("Location: /Trab/template/formulario/formulario_adicionar_livros.html");
        exit;
        
    } else { // Campos obrigatórios não preenchidos

        header("Location: /Trab/template/formulario/formulario_adicionar_livros.html");
        exit;
    }

    $conexao->close();
?>
