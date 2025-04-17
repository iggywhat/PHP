<?php
	
    session_start();

	if ((!isset($_POST['email'])) || (!isset($_POST['haslo'])))
	{
		header('Location: user_login.php');
		exit();
	}

	require_once "autoryzacja.php";

	$polaczenie = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$email = $_POST['email'];
		$haslo = $_POST['haslo'];
		
		$email = htmlentities($email, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM Uzytkownicy WHERE Email='%s' AND Haslo='%s'",
		mysqli_real_escape_string($polaczenie,$email),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
				
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['user_id'] = $wiersz['user_id'];
				$_SESSION['Imie'] = $wiersz['Imie'];
				$_SESSION['Drewno'] = $wiersz['Drewno'];
				$_SESSION['Kamien'] = $wiersz['Kamien'];
				$_SESSION['Metal'] = $wiersz['Metal'];

				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: ekwipunkeuzytkownik.php');
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: user_login.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>