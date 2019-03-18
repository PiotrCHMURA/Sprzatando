<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
<title>Sprzątando</title>
<meta charset="utf-8">
</head>

<body>
<div>
<form action="Logowanie.php" method=post>
Zaloguj się </br> </br>
Login: <input type=text name="login"></br>
Hasło: <input type=password name="haslo"></br>
	   <input type=submit value="Zaloguj">
</form>
<a href="rejestracja.php">Nie posiadasz konta?</a>
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];

?>
</div>
</body>
</html>