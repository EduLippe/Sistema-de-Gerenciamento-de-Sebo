<?php

    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $cantor = trim($_POST['cantor'] ?? '');
    $faixas = intval($_POST['faixas'] ?? 0);
    $gravadora = trim($_POST['gravadora'] ?? '');
    $ano_lancamento = trim($_POST['ano_lancamento'] ?? '');
    $quantidade = intval($_POST['quantidade'] ?? 0);

    if ($titulo && $cantor && $faixas && $gravadora && $ano_lancamento && $quantidade > 0) { // Verifica se o disco já existe
        
        $stmt = $conexao->prepare(" 
            SELECT id, quantidade FROM discos 
            WHERE titulo = ? AND cantor = ? AND faixas = ? AND gravadora = ? AND ano_lancamento = ?
        "); // Verifica se o disco já existe

        $stmt->bind_param("ssiss", $titulo, $cantor, $faixas, $gravadora, $ano_lancamento);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) { // Disco já existe - atualiza a quantidade

            $disco = $resultado->fetch_assoc();
            $novaQuantidade = $disco['quantidade'] + $quantidade;

            $update = $conexao->prepare("UPDATE discos SET quantidade = ? WHERE id = ?");
            $update->bind_param("ii", $novaQuantidade, $disco['id']);
            $update->execute();
            $update->close();

        } else { // Disco não existe - insere novo

            $insert = $conexao->prepare("
                INSERT INTO discos 
                    (titulo, cantor, faixas, gravadora, ano_lancamento, quantidade) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $insert->bind_param("ssissi", $titulo, $cantor, $faixas, $gravadora, $ano_lancamento, $quantidade);
            $insert->execute();
            $insert->close();
        }

        $stmt->close();
        header("Location: /Trab/template/formulario/formulario_adicionar_discos.html");
        exit;
        
    } else { // Campos obrigatórios não preenchidos

        header("Location: /Trab/template/formulario/formulario_adicionar_discos.html");
        exit;
    }

    $conexao->close();
?>
