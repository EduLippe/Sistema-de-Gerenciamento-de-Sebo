<?php

    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $cantor = trim($_POST['cantor'] ?? '');
    $faixas = intval($_POST['faixas'] ?? 0);
    $gravadora = trim($_POST['gravadora'] ?? '');
    $quantidadeRemover = intval($_POST['quantidade'] ?? 0);

    if ($titulo && $cantor && $faixas > 0 && $gravadora && $quantidadeRemover > 0) {
        // Verifica se o livro existe
        $stmt = $conexao->prepare("
            SELECT id, quantidade FROM discos 
            WHERE titulo = ? AND cantor = ? AND faixas = ? AND gravadora = ?
        ");
        $stmt->bind_param("ssis", $titulo, $cantor, $faixas, $gravadora);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $disco = $resultado->fetch_assoc();

            if ($disco['quantidade'] >= $quantidadeRemover) {
                // Atualiza a quantidade no banco
                $novaQuantidade = $disco['quantidade'] - $quantidadeRemover;
                $update = $conexao->prepare("UPDATE discos SET quantidade = ? WHERE id = ?");
                $update->bind_param("ii", $novaQuantidade, $disco['id']);

                if ($update->execute()) {
                    header("Location: /Trab/template/formulario/formulario_remover_discos.html");
                    exit;
                } else {
                    header("Location: /Trab/template/formulario/formulario_remover_discos.html" . $update->error);
                }
            } else {
                header("Location: /Trab/template/formulario/formulario_remover_discos.html");
            }
        } else {
            header("Location: /Trab/template/formulario/formulario_remover_discos.html");
        }

        $stmt->close();
    } else {
        header("Location: /Trab/template/formulario/formulario_remover_discos.html");
    }

    $conexao->close();
?>