<?php
session_start();

if ((!isset($_POST['email'])) || (!isset($_POST['haslo']))) {
    header('Location: admin_login.php');
    exit();
}

require_once "autoryzacja.php";

$polaczenie = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($polaczenie->connect_errno != 0) {
    echo "Błąd połączenia z bazą danych: " . $polaczenie->connect_errno;
} else {
    $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($_POST['haslo'], ENT_QUOTES, "UTF-8");

    $stmt = $polaczenie->prepare("SELECT * FROM Administratorzy WHERE Email = ? AND Haslo = ?");
    $stmt->bind_param("ss", $email, $haslo);
    $stmt->execute();
    $rezultat = $stmt->get_result();

    if ($rezultat->num_rows > 0) {
        $admin = $rezultat->fetch_assoc();
        
        $_SESSION['Imie'] = $admin['Imie'];
        $_SESSION['Nazwisko'] = $admin['Nazwisko'];

        $query = "SELECT user_id, Imie, Nazwisko, Drewno, Kamien, Metal FROM Ekwipunek";
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="Strona projektu na zaliczenie">
    <title>Panel Administratora</title>
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

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        main {
            padding: 20px;
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        main h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .user {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .user p {
            margin: 5px 0;
        }

        .actions a {
            text-decoration: none;
            color: rgb(50, 142, 138);
            margin-right: 15px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .actions a:hover {
            color: rgb(107, 25, 74);
        }

        .actions a.delete {
            color: red;
        }

        .actions a.delete:hover {
            color: darkred;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>Panel Administratora</h1>
        <p>Witaj, <?php echo $_SESSION['Imie']; ?>! [<a href="admin_login.php" style="color: lightblue;">Wyloguj się!</a>]</p>
    </header>
    <main>
        <h2>Opcje zarządzania użytkownikami</h2>
        <?php
        if ($result = $polaczenie->query($query)) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='user'>";
                echo "<p><b>Imię:</b> " . $row['Imie'] . " | <b>Nazwisko:</b> " . $row['Nazwisko'] . "</p>";
                echo "<p><b>Drewno:</b> " . $row['Drewno'] . " | <b>Kamień:</b> " . $row['Kamien'] . " | <b>Metal:</b> " . $row['Metal'] . "</p>";
                echo "<div class='actions'>";
                echo "<a href='edit_user.php?user_id=" . $row['user_id'] . "'>Edytuj</a>";
                echo "<a href='usun_uzytkownika.php?user_id=" . $row['user_id'] . "' class='delete'>Usuń</a>";
                echo "</div></div>";
            }
            $result->free_result();
        } else {
            echo "<p>Błąd podczas pobierania danych użytkowników.</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2025 Survivly. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
<?php
    } else {
        echo "Nieprawidłowe dane logowania.";
    }

    $stmt->close();
    $polaczenie->close();
}
?>