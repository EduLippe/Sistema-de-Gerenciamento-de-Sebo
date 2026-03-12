<?php

    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $cantor = trim($_POST['cantor'] ?? '');
    $gravadora = trim($_POST['gravadora'] ?? '');

    $novoTitulo = trim($_POST['novoTitulo'] ?? '');
    $novoCantor = trim($_POST['novoCantor'] ?? '');
    $novaFaixas = intval($_POST['novaFaixas'] ?? 0);
    $novaGravadora = trim($_POST['novaGravadora'] ?? '');    
    $novoAno = trim($_POST['novoAno_lancamento'] ?? '');
    $novaQuantidade = intval($_POST['novaQuantidade'] ?? 0);

    if ($titulo && $cantor && $gravadora) {

        // Verifica se o disco existe com base no dados fornecido
        $stmt = $conexao->prepare("
            SELECT id FROM discos 
            WHERE titulo = ? AND cantor = ? AND gravadora = ?
        ");

        $stmt->bind_param("sss", $titulo, $cantor, $gravadora);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Disco encontrado
            $update = $conexao->prepare("
                UPDATE discos 
                SET titulo = ?, cantor = ?, faixas = ?, gravadora = ?, ano_lancamento = ?, quantidade = ?
                WHERE titulo = ? AND cantor = ? AND gravadora = ?
            ");

            $update->bind_param(
                "ssississs", 
                $novoTitulo, $novoCantor, $novaFaixas, $novaGravadora, $novoAno, $novaQuantidade,
                $titulo, $cantor, $gravadora
            );

            if ($update->execute()) {
                header("Location: /Trab/template/formulario/formulario_editar_discos.html");
            } 
            
            else {
                header("Location: /Trab/template/formulario/formulario_editar_discos.html");
            }

            $update->close();

        }
        
        else {
            header("Location: /Trab/template/formulario/formulario_editar_discos.html");
        }

        $stmt->close();

    } 

    else {
        header("Location: /Trab/template/formulario/formulario_editar_discos.html");
    }

    $conexao->close();

?>