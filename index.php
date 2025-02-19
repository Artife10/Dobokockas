<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    session_start();
    $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['name'] = $_POST['name'] ?? '';
    }

    if (!empty($_SESSION['name'])) {
        echo "<p id='wawa'>your name is: ".$_SESSION['name']."</p>";
        echo "<a href='game.php'>game</a>";
        echo "<br>";
    }
    ?>
    <br>
    <form action="" method="post">
        Name: <input type="text" name="name"><br>
        <input type="submit">
    </form>

    <p>Use sql to clear it ty</p>



</body>
</html>
