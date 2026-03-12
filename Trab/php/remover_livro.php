<?php

    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $paginas = intval($_POST['paginas'] ?? 0);
    $editora = trim($_POST['editora'] ?? '');
    $quantidadeRemover = intval($_POST['quantidade'] ?? 0);

    if ($titulo && $autor && $paginas > 0 && $editora && $quantidadeRemover > 0) {
        
        // Verifica se o livro existe
        $stmt = $conexao->prepare("
            SELECT id, quantidade FROM livros 
            WHERE titulo = ? AND autor = ? AND paginas = ? AND editora = ?
        ");

        $stmt->bind_param("ssis", $titulo, $autor, $paginas, $editora);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $livro = $resultado->fetch_assoc();

            if ($livro['quantidade'] >= $quantidadeRemover) {

                // Atualiza a quantidade no banco
                $novaQuantidade = $livro['quantidade'] - $quantidadeRemover;
                $update = $conexao->prepare("UPDATE livros SET quantidade = ? WHERE id = ?");
                $update->bind_param("ii", $novaQuantidade, $livro['id']);

                if ($update->execute()) {
                    header("Location: /Trab/template/formulario/formulario_remover_livros.html");
                    exit;
                } else {
                    header("Location: /Trab/template/formulario/formulario_remover_livros.html" . $update->error);
                }
            } else {
                header("Location: /Trab/template/formulario/formulario_remover_livros.html");
            }
        } else {
            header("Location: /Trab/template/formulario/formulario_remover_livros.html");
        }

        $stmt->close();
    } else {
        header("Location: /Trab/template/formulario/formulario_remover_livros.html");
    }

    $conexao->close();
?>