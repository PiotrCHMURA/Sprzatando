<!DOCTYPE html>
<html>

<head>
<title>Sprzątando - Weryfikacja</title>
<meta charset="utf-8">
</head>

<body>
    <?php
	$verify_string = $_GET['verify_string'];
	require_once "Bazaparametry.php";
	$conn = new mysqli($host, $userbazy, $haslobazy, $nazwabazy);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} else {

		if ($conn->query("UPDATE uzytkownicy SET verified='1' WHERE verify='$verify_string';")) {
			echo 'Weryfikacja powiodła się. </br> <a href="\sprzatando"> Zaloguj się </a>';
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}
	$conn->close();
    ?>
</body>
</html>