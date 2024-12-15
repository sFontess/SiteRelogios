<?php
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdsiterelogios";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o ID do relógio foi passado na URL
if (isset($_GET['id'])) {
    $relogioId = $_GET['id'];

    // Buscar informações do relógio no banco de dados
    $sql = "SELECT * FROM relogios WHERE IDRelogio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $relogioId);
    $stmt->execute();
    $result = $stmt->get_result();
    $relogio = $result->fetch_assoc();

    // Verificar se o relógio foi encontrado
    if ($relogio) {
        $nome = $relogio['Nome'];
        $preco = number_format($relogio['Preco'], 2, ',', '.');
        $imagem = $relogio['Imagem'];
        $descricao = $relogio['Descricao']; // Supondo que você tenha uma coluna 'Descricao' na tabela
    } else {
        echo "Relógio não encontrado.";
        exit;
    }
} else {
    echo "ID do relógio não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <title><?php echo $nome; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function teste() {
            var form = document.forms["pagamentoForm"];
            if (form.pagamento.selectedIndex == 0 || form.nome.value == "" || form.num.value == "" || form.cidade.value == "" || form.morada.value == "" || form.postal.value == "" || !isNaN(form.nome.value) || isNaN(form.num.value) || !isNaN(form.cidade.value))
                alert("Dados incorretos ou campos não preenchidos.");
            else
                alert("Pagamento bem sucedido!");
        }
    </script>
</head>

<body>
    <div class="nav" style="background: rgb(242, 242, 242);">
        <div><a href="index.php" class="relogios">Início</a></div>
        <img id="logo" style="cursor: pointer;" src="media/rolex-logo-1.png">
        <div>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                <a href="logout.php" class="login">Logout</a>
            <?php else: ?>
                <a href="login.php" class="login">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="prod-container">
        <div class="prod-img">
            <img src="<?php echo $imagem; ?>" alt="<?php echo $nome; ?>">
        </div>
        <div class="prod-info">
            <div class="prod-name"><?php echo $nome; ?></div>
            <div class="prod-price"><?php echo $preco; ?>€</div>
            <div class="prod-descr">
                <p>
                    <?php echo $descricao; ?>
                </p>
            </div>
            <div class="prod-pagamento">
                <form name="pagamentoForm">
                    <label for="pagamento">Método de Pagamento</label>
                    <select name="pagamento" id="pagamento">
                        <option value="0">Pagamento</option>
                        <option value="1">PayPal</option>
                        <option value="2">Visa Card</option>
                        <option value="3">Master Card</option>
                    </select>

                </form>
            </div>
            <button class="prod-button" onclick="teste()">Pagar</button>
        </div>
    </div>

    <footer>
        <div class="footer-info">
            <p style="font-size: 2rem;">Redes Sociais</p>
            <div class="footer-img">
                <a style="width: 2rem;" href="https://x.com/ROLEX?ref_src=twsrc">
                    <img src="media/PHOTO-2024-12-13-10-41-07-removebg-preview.png" alt="">
                </a>
                <a style="width: 2rem;" href="https://www.instagram.com/rolex/">
                    <img src="media/PHOTO-2024-12-13-10-41-08-removebg-preview.png" alt="">
                </a>
            </div>
        </div>

        <div class="footer-info">
            <p style="font-size: 2rem;">Informação</p>
            <a href="/SiteRelogios/sobre.html">Sobre Nós</a>
            <a href="/SiteRelogios/sobre.html#">Sobre a Rolex</a>
        </div>
        <div class="footer-info">
            <p style="font-size: 2rem;">Novidades</p>
            <a href="/SiteRelogios/produtos.php">Lançamentos e Promoções</a>
            <a href="https://newsroom.rolex.com/?cmpid=rolexcom_newsroom">Newsroom</a>
        </div>
        <div class="footer-info">
            <p style="font-size: 2rem;">Parcerias</p>
            <a href="https://rolex.com">Rolex</a>
            <a href="https://cartier.com">Cartier</a>
            <a href="https://tyffany.com">Tyffany & Co</a>
        </div>
    </footer>
</body>

<script>
    document.getElementById("logo").addEventListener("click", function () {
        window.location.href = "index.php";
    })
</script>

</html>

<?php
$conn->close();
?>
