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

        main {
            text-align: center;
            padding: 40px 20px;
        }

        main h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color:rgb(0, 0, 0); 
}

        .login-options {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .login-btn {
            text-decoration: none;
            color: #fff;
            background-color:rgb(50, 142, 138);
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            width: 80%;
            max-width: 300px;
            text-align: center;
        }

        .login-btn:hover {
            background-color:rgb(107, 25, 74);
            transform: translateY(-3px);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 2rem;
            }

            main h2 {
                font-size: 1.5rem;
            }

            .login-btn {
                font-size: 0.9rem;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Witaj na stronie gry Survivly</h1>
    </header>
    <main>
        <h2>Zaloguj się</h2>
        <div class="login-options">
            <a href="user_login.php" class="login-btn">Zaloguj się jako użytkownik</a>
            <a href="admin_login.php" class="login-btn">Zaloguj się jako administrator</a>
            </br>
            <a href="user_register.php" class="login-btn">Zarejestruj się</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Survivly. Wszystkie prawa zastrzeżone.</p>
    </footer>
    <?php
        if (isset($_SESSION['blad'])) echo $_SESSION['blad'];
    ?>
</body>
</html>