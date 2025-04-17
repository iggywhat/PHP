<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die("Blad polaczenia z serwerem: " . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $q1 = "UPDATE Ekwipunek SET 
        Imie = '" . $_POST['Imie'] . "',
        Nazwisko = '" . $_POST['Nazwisko'] . "',
        Drewno = '" . $_POST['Drewno'] . "',
        Kamien = '" . $_POST['Kamien'] . "',
        Metal = '" . $_POST['Metal'] . "' 
        WHERE user_id = '" . $_POST['user_id'] . "';";

    mysqli_query($conn, $q1);

    $q2 = "UPDATE Uzytkownicy SET 
        Imie = '" . $_POST['Imie'] . "',
        Nazwisko = '" . $_POST['Nazwisko'] . "' 
        WHERE user_id = '" . $_POST['user_id'] . "';";

    mysqli_query($conn, $q2);
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="Strona projektu na zaliczenie">
    <title>Panel Edycji Użytkowników</title>
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
            max-width: 900px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: grey;
        }

        table th, table td {
            padding: 10px;
            border: 5px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: rgb(115, 226, 199);
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            width: 80%;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
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
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: rgb(107, 25, 74);
            transform: translateY(-3px);
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
        <h1>Panel Edycji Użytkowników</h1>
    </header>
    <main>
        <h2>Edycja danych o użytkownikach</h2>
        <?php
        $q = "SELECT * FROM Ekwipunek ORDER BY user_id ASC";
        $res = mysqli_query($conn, $q);
        echo '<table>';
        echo '<tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Drewno</th><th>Kamień</th><th>Metal</th><th>Akcje</th></tr>';
        while ($a = mysqli_fetch_array($res)) {
            if ((isset($_GET['user_id'])) && ($_GET['user_id'] == $a['user_id'])) {
                echo '<form action="edit_user.php" method="POST">';
                echo '<tr>';
                echo '<td>' . $a['user_id'] . '</td>';
                echo '<td><input name="Imie" value="' . $a['Imie'] . '"></td>';
                echo '<td><input name="Nazwisko" value="' . $a['Nazwisko'] . '"></td>';
                echo '<td><input name="Drewno" value="' . $a['Drewno'] . '"></td>';
                echo '<td><input name="Kamien" value="' . $a['Kamien'] . '"></td>';
                echo '<td><input name="Metal" value="' . $a['Metal'] . '"></td>';
                echo '<td><input type="hidden" name="user_id" value="' . $a['user_id'] . '"></td>';
                echo '<td><input type="submit" value="Zatwierdź"></td>';
                echo '</tr>';
                echo '</form>';
            } else {
                echo '<tr>';
                echo '<td>' . $a['user_id'] . '</td>';
                echo '<td>' . $a['Imie'] . '</td>';
                echo '<td>' . $a['Nazwisko'] . '</td>';
                echo '<td>' . $a['Drewno'] . '</td>';
                echo '<td>' . $a['Kamien'] . '</td>';
                echo '<td>' . $a['Metal'] . '</td>';
                echo "<td><a href='edit_user.php?user_id=" . $a['user_id'] . "'>Zmień</a></td>";
                echo '</tr>';
            }
        }
        echo '</table>';
        ?>
        <a href="admin_loginvalid.php">Wróć</a>
    </main>
    <footer>
        <p>&copy; 2025 Survivly. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>