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

// Buscar os relógios no banco de dados
$sql = "SELECT * FROM relogios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <title>Rolex Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="header">
        <video src="media/RolexVideo.mp4" autoplay loop muted class="bg-vid"></video>
        <div class="nav">
            <div><a href="#products" class="relogios">Relógios</a></div>
            <img src="media/rolex-logo-1.png">
            <div>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" class="login" onclick="confirmarLogout(event)">Logout</a>
                <?php else: ?>
                    <a href="login.html" class="login">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="products" class="container">
        <p class="titulo">Novidades</p>
        <div class="products">
            <?php
            if ($result->num_rows > 0) {
                // Exibe cada relógio da base de dados
                while ($row = $result->fetch_assoc()) {
                    echo '<div id="'.$row['IDRelogio'].'" class="relogio">';
                    echo '<img src="' . $row['Imagem'] . '" alt="' . $row['Nome'] . '">';
                    echo '<div class="name">' . $row['Nome'] . '</div>';
                    echo '<div class="price">' . number_format($row['Preco'], 2, ',', '.') . '€</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-info">
            <p style="font-size: 2rem;">Redes Sociais</p>
            <div class="footer-img">
                <a style="width: 2rem;" href="https://x.com/ROLEX?ref_src=twsrc" target="_blank">
                    <img src="media/PHOTO-2024-12-13-10-41-07-removebg-preview.png" alt="">
                </a>
                <a style="width: 2rem;" href="https://www.instagram.com/rolex/" target="_blank">
                    <img src="media/PHOTO-2024-12-13-10-41-08-removebg-preview.png" alt="">
                </a>
            </div>
        </div>
        <div class="footer-info">
            <p style="font-size: 2rem;">Informação</p>
            <a href="sobre.html" target="_blank">Sobre Nós</a>
            <a href="sobre.html#rolex" target="_blank">Sobre a Rolex</a>
        </div>
        <div class="footer-info">
            <p style="font-size: 2rem;">Novidades</p>
            <a href="produtos.php" target="_blank">Lançamentos e Promoções</a>
            <a href="https://newsroom.rolex.com/?cmpid=rolexcom_newsroom" target="_blank">Newsroom</a>
        </div>
        <div class="footer-info">
            <p style="font-size: 2rem;">Parcerias</p>
            <a href="https://rolex.com" target="_blank">Rolex</a>
            <a href="https://cartier.com" target="_blank">Cartier</a>
            <a href="https://tyffany.com" target="_blank">Tyffany & Co</a>
        </div>
    </footer>
</body>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let relogios = document.querySelectorAll('.relogio');
    
    relogios.forEach(function(relogio) {
      relogio.addEventListener("click", function() {
        let relogioId = relogio.id;  
        
        window.location.href = "relogio.php?id=" + relogioId;
      });
    });
  });
</script>


</html>

<?php
$conn->close();
?>
