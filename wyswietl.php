<?php 
include 'autoryzacja.php'; 
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die("Blad polaczenia z serwerem: " . mysqli_connect_error());

$q = "SELECT * FROM kolokwium_2_samochody ORDER BY rok_produkcji ASC";
$res = mysqli_query($conn, $q);
echo '<h2>Igor Kamski 1 grupa zad 1 </h2>';
echo '<h3>Tabela Samochody</h3>';
echo '<table border = 1px solid black>';
while ($a = mysqli_fetch_array($res))
{
 echo '<tr>';
 echo '<td>'.$a['nr_rejestracyjny'].'</td>';
 echo '<td>'.$a['marka'].'</td>';
 echo '<td>'.$a['model'].'</td>';
 echo '<td>'.$a['rok_produkcji'].'</td>';
 echo '<td>'.$a['rodzaj_napedu'].'</td>';
 echo '</tr>';
}

echo '</table>';
echo '</br>';
echo '</br>';
$q2="SELECT * FROM kolokwium_2_kierowcy ORDER BY nazwisko_kierowcy ASC";
$res2 = mysqli_query($conn, $q2);
echo '<h3>Tabela Kierowcy</h3>';
echo '<table border = 1px solid black>';
while ($a2 = mysqli_fetch_array($res2))
{
echo '<tr>';
echo '<td>'.$a2['id_kierowcy'].'</td>';
echo '<td>'.$a2['imie_kierowcy'].'</td>';
echo '<td>'.$a2['nazwisko_kierowcy'].'</td>';
echo '<td>'.$a2['nr_PESEL'].'</td>';
echo '</tr>';
}
echo '</table>';
mysqli_close($conn);
?>