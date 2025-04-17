<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="Strona projektu na zaliczenie">
    <title>Survivly - Logowanie</title>
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
            text-align: center;
            padding: 20px 0;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        form {
            background-color: #fff;
            padding: 50px;
            margin: 40px auto;
            width: 90%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        form input[type="submit"] {
            background-color: rgb(50, 142, 138);
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

        form input[type="submit"]:hover {
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

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 2rem;
            }

            form input[type="submit"] {
                font-size: 0.9rem;
                padding: 10px;
            }

            a {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Zaloguj się jako użytkownik</h1>
    </header>
    <main>
        <form action="user_loginvalid.php" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="haslo">Hasło:</label>
            <input type="password" id="haslo" name="haslo" required>
            <input type="submit" value="Zaloguj się">
        </form>
        <a href="bd2interfejs.php">Wróć</a>
    </main>
    <footer>
        <p>&copy; 2025 Survivly. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>