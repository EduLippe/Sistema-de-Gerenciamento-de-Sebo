<?php

    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $editora = trim($_POST['editora'] ?? '');

    $novoTitulo = trim($_POST['novoTitulo'] ?? '');
    $novoAutor = trim($_POST['novoAutor'] ?? '');
    $novaPaginas = intval($_POST['novaPaginas'] ?? 0);
    $novaEditora = trim($_POST['novaEditora'] ?? '');    
    $novoAno = trim($_POST['novoAno_publicacao'] ?? '');
    $novaQuantidade = intval($_POST['novaQuantidade'] ?? 0);

    if ($titulo && $autor && $editora) {

        // Verifica se o disco existe com base no dados fornecido
        $stmt = $conexao->prepare("
            SELECT id FROM livros 
            WHERE titulo = ? AND autor = ? AND editora = ?
        ");

        $stmt->bind_param("sss", $titulo, $autor, $editora);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Disco encontrado
            $update = $conexao->prepare("
                UPDATE livros 
                SET titulo = ?, autor = ?, paginas = ?, editora = ?, ano_publicacao = ?, quantidade = ?
                WHERE titulo = ? AND autor = ? AND editora = ?
            ");

            $update->bind_param(
                "ssisiisss", 
                $novoTitulo, $novoAutor, $novaPaginas, $novaEditora, $novoAno, $novaQuantidade,
                $titulo, $autor, $editora
            );

            if ($update->execute()) {
                header("Location: /Trab/template/formulario/formulario_editar_livros.html");
            } 
            
            else {
                header("Location: /Trab/template/formulario/formulario_editar_livros.html");
            }

            $update->close();

        }
        
        else {
            header("Location: /Trab/template/formulario/formulario_editar_livros.html");
        }

        $stmt->close();

    } 

    else {
        header("Location: /Trab/template/formulario/formulario_editar_livros.html");
    }

    $conexao->close();

?>