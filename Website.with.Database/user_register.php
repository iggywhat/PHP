<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die("Blad polaczenia z serwerem: " . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Imie = $_POST['Imie'];
    $Nazwisko = $_POST['Nazwisko'];
    $Email = $_POST['Email'];
    $Haslo = $_POST['Haslo'];

    if (isset($Imie) && isset($Nazwisko) && isset($Email) && isset($Haslo)) {

        $query1 = "INSERT INTO Uzytkownicy (Imie, Nazwisko, Email, Haslo)
                   VALUES ('$Imie','$Nazwisko','$Email','$Haslo')";
        if (mysqli_query($conn, $query1)) {
            $query2 = "INSERT INTO Ekwipunek (Imie, Nazwisko, Drewno, Kamien, Metal)
                       VALUES ('$Imie', '$Nazwisko', 0, 0, 0)";
            if (mysqli_query($conn, $query2)) {
                echo "Brawo! Udało ci się stworzyć konto.";
                echo '</br>';
                echo '<h3><a href="user_login.php">Zaloguj się</a></h3>';
            } else {
                echo "Błąd podczas dodawania do tabeli Ekwipunek: " . mysqli_error($conn);
            }
        } else {
            echo "Błąd podczas dodawania do tabeli Uzytkownicy: " . mysqli_error($conn);
        }
    } else {
        echo "Wszystkie pola są wymagane.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="Strona projektu na zaliczenie">
    <title>Rejestracja użytkownika</title>
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
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 30px;
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: rgb(0, 0, 0);
            color: #fff;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: rgb(107, 25, 74);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }

        .message {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .message a {
            color: rgb(50, 142, 138);
            font-weight: bold;
            text-decoration: none;
        }

        .message a:hover {
            color: rgb(107, 25, 74);
        }
        a {
            text-decoration: none;
            color: rgb(0, 0, 0);
            font-weight: bold;
            display: block;
            text-align: center;
            margin-top: 20px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: rgb(107, 25, 74);
        }
    </style>
</head>
<body>
    <header>
        <h1>Rejestracja użytkownika</h1>
    </header>
    <main>
        <h2>Zarejestruj się</h2>
        <form action="user_register.php" method="POST">
            <label for="Imie">Imię:</label>
            <input type="text" name="Imie" required>

            <label for="Nazwisko">Nazwisko:</label>
            <input type="text" name="Nazwisko" required>

            <label for="Email">Email:</label>
            <input type="email" name="Email" required>

            <label for="Haslo">Hasło:</label>
            <input type="password" name="Haslo" required>

            <input type="submit" value="Zarejestruj się">
        </form>
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($Imie) && isset($Nazwisko) && isset($Email) && isset($Haslo)) { ?>
            <div class="message">
                <p>Brawo! Udało ci się stworzyć konto. <a href="user_login.php">Zaloguj się</a></p>
            </div>
        <?php } ?>
        <a href="bd2interfejs.php">Wróć</a>
    </main>
    <footer>
        <p>&copy; 2025 Survivly. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>