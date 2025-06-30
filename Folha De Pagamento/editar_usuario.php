<?php
include "conexao.php";
include "protect.php";

// Verifica se recebeu o ID pela URL
if (!isset($_GET['id'])) {
    die("ID do usuário não especificado.");
}

$id = intval($_GET['id']);

// Buscar dados do usuário
$sql = "SELECT u.id, u.nome, u.cpf, u.tipo, c.funcao
        FROM usuarios u
        LEFT JOIN contracheque c ON u.id = c.usuario_id
        WHERE u.id = $id";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("Usuário não encontrado.");
}

$usuario = $result->fetch_assoc();

// Atualizar se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $funcao = $_POST['funcao'];


    $conn->query("UPDATE usuarios SET nome = '$nome', cpf = '$cpf', tipo = '$tipo' WHERE id = $id");

    // verificar se o nome existe
    $check = $conn->query("SELECT * FROM contracheque WHERE usuario_id = $id");
    if ($check->num_rows > 0) {
        $conn->query("UPDATE contracheque SET funcao = '$funcao' WHERE usuario_id = $id");
    } else {
        $conn->query("INSERT INTO contracheque (usuario_id, funcao) VALUES ($id, '$funcao')");
    }

    echo "<script>
            alert('Dados Editados com Sucesso!');
            window.location.href = 'listar_usuarios.php';
        </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <link rel="shortcut icon" href="css/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="css\Estilo.css">
    <script>
        function mudarpag(){
            location.href = "listar_usuarios.php";
        }
    </script>
</head>
<body>
    <main class="container">
    <h1>Editar Usuário</h1>
    <form method="POST">
        <div class="box">
        <input type="text" name="nome" placeholder="Nome" value="<?php echo $usuario['nome']; ?>">
        </div>
        <div class="box">
        <input type="text" name="cpf" placeholder="CPF" value="<?php echo $usuario['cpf']; ?>">
        </div>
            <select name="tipo">
                <option value="admin" <?php if ($usuario['tipo'] === 'admin') echo 'selected'; ?>>Admin</option>
                <option value="comum" <?php if ($usuario['tipo'] === 'comum') echo 'selected'; ?>>Comum</option>
            </select>
        <div class="box">
        <input type="text" name="funcao" placeholder="Função" value="<?php echo $usuario['funcao']; ?>">
        </div>
        <button type="submit" class="Login">Salvar</button>
    </form>
    <br>
        <button onclick="mudarpag()" class="Login"> Cancelar </button>
</main>
</body>
</html>