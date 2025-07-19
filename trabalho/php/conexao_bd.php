<?php
$host = 'localhost';
$usuario = 'root';
$senha = ''; // ou a senha do seu MySQL
$banco = 'bd_soft_livr';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>