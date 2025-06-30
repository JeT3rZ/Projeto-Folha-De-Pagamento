<?php
include "conexao.php";
include "protect.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Impede exclusão do usuário 1
    if ($id === 1) {
        echo "<script>alert('Esse usuário não pode ser excluído.'); window.location.href = 'listar_usuarios.php';</script>";
        exit;
    }
    //apaga da tabela contracheque
    $conn->query("DELETE FROM contracheque WHERE usuario_id = $id");

    //apaga da tabela de usuários
    $conn->query("DELETE FROM usuarios WHERE id = $id");


    header("Location: listar_usuarios.php");
    exit;
} else {
    echo "ID inválido.";
}
