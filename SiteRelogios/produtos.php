<?php
 
// Username is root
$user = 'root';
$password = '';
 
// Database name is geeksforgeeks
$database = 'bdsiterelogios';
 
// Server is localhost with
// port number 3306
$servername='localhost:5500';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$sql = " SELECT * FROM relogios ORDER BY IDRelogio DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>




<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <link type="text/css" rel="stylesheet" href="style.css" />
    <title>Rolex Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="header">
        <video src="media/RolexVideo.mp4" autoplay loop muted class="bg-vid"></video>
        <div class="nav">
          <div><a href="produtos.html" class="relogios">Relógios</a></div>
          <img src="media/rolex-logo-1.png">
          <div><a href="/SiteRolex/login.php" class="login">Login</a></div>
        </div>
    </div>

    <table>
            <tr>
                <th>GFG UserHandle</th>
                <th>Practice Problems</th>
                <th>Coding Score</th>
                <th>GFG Articles</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['Nome'];?></td>
                <td><?php echo $rows['Preco'];?></td>
                <td><?php echo $rows['Cor'];?></td>
                
            </tr>
            <?php
                }
            ?>
        </table>

    <!--<div class="container">
        <h1>Produtos</h1><br>
        <div class="products" style="gap: 100px; margin-left: 175px; margin-right: 175px;">
            <div class="relogio" style="width: 300px;">
                <a href="Relogio1.html"><img src="media/Relogio1.png" alt=""></a>
                <div class="name">Rolex Submariner Green</div>
                <div class="price">20.999€</div>
            </div>

            <div class="relogio" style="width: 300px;">
              <img src="media/Relogio1.png" alt="">
              <div class="name">Rolex Submariner Green</div>
              <div class="price">20.999€</div>
            </div>

            <div class="relogio" style="width: 300px;">
                <img src="media/Relogio1.png" alt="">
                <div class="name">Rolex Submariner Green</div>
                <div class="price">20.999€</div>
            </div>
        </div>
    </div>
    

    <div class="container">
        <div class="products" style="gap: 100px; margin-left: 175px; margin-right: 175px;">
            <div class="relogio" style="width: 300px;">
              <img src="media/Relogio1.png" alt="">
              <div class="name">Rolex Submariner Green</div>
              <div class="price">20.999€</div>
            </div>

            <div class="relogio" style="width: 300px;">
              <img src="media/Relogio1.png" alt="">
              <div class="name">Rolex Submariner Green</div>
              <div class="price">20.999€</div>
            </div>

            <div class="relogio" style="width: 300px;">
                <img src="media/Relogio1.png" alt="">
                <div class="name">Rolex Submariner Green</div>
                <div class="price">20.999€</div>
            </div>
        </div>
    </div> -->




</body>
<br>
<footer>
    Nijdosadnas
</footer>
</html>