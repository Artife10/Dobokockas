<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Roll</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();

    $servername = "localhost";
    $username = "admin";
    $password = "admin123";
    $dbname = "dobokocka";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_SESSION['name'];
    $tableid = $_SESSION['id'];


    $plnum = 0;
    $ainum = 0;
    $plwon = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $plnum = rand(1, 6);
        $ainum = rand(1, 6);
        if ($plnum != $ainum) {
            if ($ainum > $plnum) {
                $plwon = 0;
            }else{
                $plwon = 1;
            }  
        }else{
            $plwon = 0;
        }

        $sql = "INSERT INTO jatekok (ID, name, ai_num, pl_num, won) VALUES (".$tableid.",'".$name."', ".$ainum.",". $plnum.",". $plwon.");";
        $_SESSION['id'] += 1;
        $conn->query($sql);
        
    }
    ?>

    <a href="index.php">Change Name</a>

    <h1>Your number:</h1>
    <p><?php echo $plnum; ?></p>

    <h1>AI number:</h1>
    <p><?php echo $ainum; ?></p>

    <form method="post">
        <button type="submit">Roll</button>
    </form>

    <h1>Games: </h1>
    <table>
        <tr>
            <th>Name</th>
            <th>AI Number</th>
            <th>Player Number</th>
            <th>Won</th>
        </tr>
        <?php
        $sql = "SELECT * FROM jatekok";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . $row["ai_num"] . "</td>";
                echo "<td>" . $row["pl_num"] . "</td>";
                echo "<td>" . ($row["won"] ? "Yes" : "No") . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No results found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
