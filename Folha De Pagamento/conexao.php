<?php
$usuarios = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$conn = new mysqli($host, $usuarios, $senha, $database);


if ($conn->error) {
    die("Falha ao conectar ao banco de dados:" . $mysqli->error);
}
