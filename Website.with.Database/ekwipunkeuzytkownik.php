<?php
session_start();

include 'autoryzacja.php';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Błąd połączenia z serwerem: " . mysqli_connect_error());

if (!isset($_SESSION['zalogowany'])) {
    header('Location: user_login.php');
    exit();
}

$userId = $_SESSION['user_id']; 
$query = "SELECT Drewno, Kamien, Metal FROM Ekwipunek WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['Drewno'] = $row['Drewno'];
    $_SESSION['Kamien'] = $row['Kamien'];
    $_SESSION['Metal'] = $row['Metal'];
} else {
    $_SESSION['Drewno'] = 0;
    $_SESSION['Kamien'] = 0;
    $_SESSION['Metal'] = 0;
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="Strona projektu na zaliczenie">
    <title>Ekwipunek gry Survivly</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(15, 119, 36);
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header p {
            margin: 0;
            font-size: 1.2rem;
        }

        header a {
            color: rgb(50, 142, 138);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header a:hover {
            color: rgb(107, 25, 74);
        }

        .resources {
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .resources p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .resources b {
            color: rgb(50, 142, 138);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 600px) {
            header p {
                font-size: 1rem;
            }

            .resources p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <p>Witaj <?php echo $_SESSION['Imie']; ?>! [<a href="user_login.php">Wyloguj się!</a>]</p>
    </header>
    <div class="resources">
        <p><b>Drewno</b>: <?php echo $_SESSION['Drewno']; ?></p>
        <p><b>Kamień</b>: <?php echo $_SESSION['Kamien']; ?></p>
        <p><b>Metal</b>: <?php echo $_SESSION['Metal']; ?></p>
    </div>
</body>
</html>