<?php
include 'conexao_banco.php';

$email = trim($_POST['emailUsuario'] ?? '');
$senha = trim($_POST['senhaUsuario'] ?? '');

// validação básica
if ($email === '' || $senha === '') {
    echo 'Preencha todos os campos.';
    exit;
}

// verifica se já existe
$stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo 'E-mail já cadastrado.';
    exit;
}

// cadastra novo usuário
$stmt = $conexao->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
$stmt->bind_param("s", $email, $senha);

if ($stmt->execute()) {
    echo 'Usuário cadastrado com sucesso.';
} else {
    echo 'Erro ao cadastrar usuário.';
}

$stmt->close();
$conexao->close();
?>
