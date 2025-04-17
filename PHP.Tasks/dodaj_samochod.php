<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Igor Kamski</title>
</head>
<body>
    <h2>Igor Kamski 1 grupa zadanie 2 </h2>
 <form action="dodaj_samochod.php" method="POST">
 Nr Rejestracyjny: <input name="nr_rejestracyjny"><br>
 Marka:<input name="marka"><br>
 Model: <input name="model"><br>
 Rok produkcji: <input name="rok_produkcji"><br>
 Rodzaj napedu: <input name="rodzaj_napedu"><br>
</br>
 <input type="submit" value="Wyślij"/>
 </form>
</body>
</html>
<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die("Blad polaczenia z serwerem: " . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
 $nr_rejestracyjny=$_POST['nr_rejestracyjny'];
 $marka=$_POST['marka'];
 $model=$_POST['model'];
 $rok_produkcji=$_POST['rok_produkcji'];
 $rodzaj_napedu=$_POST['rodzaj_napedu'];

 if(isset($nr_rejestracyjny) && isset($marka) && isset($model) && isset($rok_produkcji) && isset($rodzaj_napedu))
 {
 $query="INSERT INTO kolokwium_2_samochody (nr_rejestracyjny,
marka, model, rok_produkcji, rodzaj_napedu)
 VALUES ('$nr_rejestracyjny','$marka','$model','$rok_produkcji','$rodzaj_napedu')";
 mysqli_query($conn,$query);
 }
 $res = mysqli_query($conn,"SELECT * FROM kolokwium_2_samochody");
 echo '<table border=1px solid black>';

 while($array=mysqli_fetch_array($res))
 {

 echo '<tr>';
 echo
"<td>".$array['nr_rejestracyjny']."</td><td>".$array['marka']
."</td><td>".$array['model']."</td><td>".$array['rok_produkcji']."</td><td>".$array['rodzaj_napedu']."</td>";
 echo '</tr>';
 }
 echo '</table>';
}
?>