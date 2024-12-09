<!DOCTYPE html>
<html>

<head>
    <!-- <link type="text/css" rel="stylesheet" href="login.css" />
    <meta http-equiv="refresh" content="2"> -->
    <title>Login Rolex</title>

    <style type="text/css">
        body{
            margin: 0;
            padding: 0px;
            font-family: 'Open Sans', sans-serif;
            background-color: rgb(50, 50, 50);
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
        }
        img{
            display: flex;
            margin-left: auto;
            margin-right: auto;
            width: 70px;
            padding: 10px;
        }
        table {
            background-color: rgb(70, 70, 70);
            text-align: center;
            margin: auto;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 20px 70px rgba(0, 0, 0, 0.55);
        }
        table td{
            padding: 5px;
        }

        table h1{
            color: white;
            font-weight: bold;
        }

        table input{
            width: 75%;
            height: 25px;
            color: white;
            background-color: rgb(50, 50, 50);
            border: 0px;
            padding: 5px;
        }

        table button{
            border-radius: 4px;
            border: 0px;
            width: 35%;
            padding: 5px;
        }

        table button:hover{
            background-color: rgb(18, 120, 74);
            color: white;
            transform: scale(1.1);
            transition: 0.2s;
        }

        table a{
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
    </style>

<body>

<?php
if(isset($_POST["registar"])){
    $flag=true;
    $flag_username=true;
    $flag_pass=true;

    $username=$_POST["username"];
    $pass=$_POST["pass"];

    if(!preg_match("/^[0-9A-Za-z!@#-]{1,16}$/",$username)){
        echo "Nome inválido - Ex: username123";
        $flag_username=false;
        $flag=false;
    }
    if(!preg_match("/^[0-9A-Za-z!@#-]{1,16}$/",$pass)){
        echo " Palavra-passe inválida - Ex: pass123";
        $flag_pass=false;
        $flag=false;
    }
    if($flag==false){
        echo "<p align=center>Dados incorretos</p>";
?>
    <img src="media/rolex-logo-1.png">
    <table class="table" style="text-align: center;">
        <tr>
            <td>
                <h1>Login</h1>
            </td>
        </tr>
        <form name="form" action="" method="POST">
                <?php if($flag_username){ ?>
            <tr>
                <td><input type="text" placeholder="Nome" name="username" value="<?php echo $flag_username?>"></td>
            </tr>
                <?php } else {?>
            <tr>
                <td><input type="text" placeholder="Nome" name="username">*Username incorrect</td>
            </tr>
                <?php } ?>

                <?php if($flag_pass){ ?>
            <tr>
                <td><input type="password" placeholder="Palavra-passe" name="pass" value="<?php echo $flag_pass?>"></td>
            </tr>
                <?php } else {?>
            <tr>
                <td><input type="password" placeholder="Palavra-passe" name="pass">*Password incorrect</td>
            </tr>
                <?php } ?>

            <tr>
                <td><button type="submit" name="registar" value="Criar Conta">Login</button></td>
            </tr>
        </form>
        
        <tr>
            <td>Ainda não tem uma conta?
                <a href="#">Criar conta</a>
            </td>
        </tr>
    </table>
<?php } else {
    $ligax = mysqli_connect('localhost', 'root', '');
if(!$ligax) {echo '<p> Erro: Falha na ligação.'; exit;}
mysqli_select_db($ligax, 'rolex');
$insere = "INSERT INTO tabela_rolex (username, pass) VALUES('".$username."','".$pass."')";
$result = mysqli_query($ligax, $insere);
}
if($result) ?>
    <a href="/SiteRolex/index.html">
<?php }else {?>

</head>
<img src="media/rolex-logo-1.png">
<table class="table" style="text-align: center;">
        <tr>
            <td>
                <h1>Login</h1>
            </td>
        </tr>
        <form name="form" action="" method="POST">
            <tr>
                <td><input type="text" placeholder="Nome" name="username" value=""></td>
            </tr>
            <tr>
                <td><input type="password" placeholder="Palavra-passe" name="pass" value=""></td>
            </tr>
            <tr>
                <td><button type="submit" name="registar" value="Criar Conta">Login</button></td>
            </tr>
        </form>
        <tr>
            <td>Ainda não tem uma conta?
                <a href="#">Criar conta</a>
            </td>
        </tr>
    </table>
    
    </body>    
</html>
<?php } ?>