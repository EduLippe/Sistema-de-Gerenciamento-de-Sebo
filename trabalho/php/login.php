<?php

    session_start();
    
    include 'conexao_bd.php';

    $email = trim($_POST['emailUsuario'] ?? '');
    $senha = trim($_POST['senhaUsuario'] ?? '');

    // Prepara a consulta no bd
    $stmt = $conexao->prepare("SELECT id, email, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email); // Troca o ? pelo email
    $stmt->execute();
    $result = $stmt->get_result(); // recebe o resultado da pesquisa

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Compara diretamente a senha e email
        if ($senha === $usuario['senha']) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header("Location: /Trabalho/trabalho/template/inicio/inicio.html");


        } 
        
        else { // quando a senha esta incorreta
            header("Location: /Trabalho/trabalho/template/login/login.html");
        }
        
    } 

    else {
        header("Location: /Trabalho/trabalho/template/login/login.html");
    }

    $stmt->close();
    $conexao->close();

?>