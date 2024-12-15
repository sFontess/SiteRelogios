<?php
session_start();

// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdsiterelogios";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter dados do formulário
$user = $_POST['username'];
$pass = $_POST['password'];

// Proteção contra SQL Injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Preparar a consulta
$sql = "SELECT * FROM users WHERE Nome=? AND Password=?";
$stmt = $conn->prepare($sql);

// Verificar se a consulta foi preparada corretamente
if ($stmt === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}

// Vincular os parâmetros
$stmt->bind_param('ss', $user, $pass);

// Executar a consulta
$stmt->execute();

// Obter o resultado
$result = $stmt->get_result();

// Verificar se o usuário foi encontrado
if ($result->num_rows > 0) {
    // Usuário encontrado
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user;
    // Redirecionar para a página protegida
    header("Location: index.php");
    exit();
} else {
    // Usuário não encontrado
    header("Location: login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
