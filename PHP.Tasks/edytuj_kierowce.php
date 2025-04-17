<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die("Blad polaczenia z serwerem: " . mysqli_connect_error());
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
 $q="UPDATE kolokwium_2_kierowcy SET imie_kierowcy='".$_POST['imie_kierowcy']."',
nazwisko_kierowcy='".$_POST['nazwisko_kierowcy']."', nr_PESEL='".$_POST['nr_PESEL']."' WHERE
id_kierowcy='".$_POST['id_kierowcy']."';";

 mysqli_query($conn,$q);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Igor Kamski</title>
</head>
<body>
<?php
$q = "SELECT * FROM kolokwium_2_kierowcy ORDER BY id_kierowcy ASC";
$res = mysqli_query($conn, $q);
 echo '<table border=1px solid black>';
 echo '<h2>Igor Kamski 1 grupa zad 3 </h2>';
 while($a = mysqli_fetch_array($res))
 {

if((isset($_GET['kierowca_id']))&&($_GET['kierowca_id']==$a['id_kierowcy']))
 {
 echo '<form action="edytuj_kierowce.php" method="POST">';
 echo '<tr>';
 echo '<td>'.$a['id_kierowcy'].'</td>';
 echo '<td>'.'<input name="imie_kierowcy"
value="'.$a['imie_kierowcy'].'"'.'</td>';
 echo '<td>'.'<input name="nazwisko_kierowcy"
value="'.$a['nazwisko_kierowcy'].'"'.'</td>';
 echo '<td>'.'<input name="nr_PESEL"
value="'.$a['nr_PESEL'].'"'.'</td>';
 echo '<td>'.'<input type="hidden" name="id_kierowcy"
value="'.$a['id_kierowcy'].'"'.'</td>';
 echo '<input type="submit" value="Zatwierdz">';
 echo '</tr>';
 }
 else
 {
 echo '<tr>';
 echo '<td>'.$a['id_kierowcy'].'</td>';
 echo '<td>'.$a['imie_kierowcy'].'</td>';
 echo '<td>'.$a['nazwisko_kierowcy'].'</td>';
 echo '<td>'.$a['nr_PESEL'].'</td>';
 echo "<td>"."<a href='edytuj_kierowce.php?kierowca_id=".$a['id_kierowcy']."'>"."zmien"."</a></td>";
 echo '</tr>';
 }

 }
 echo '</table>';
?>
</body>
</html>