<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: Logowanie.php');
		exit();
	}

	require_once "Baza parametry.php";

	$conn = @new mysqli($host, $userbazy, $haslobazy, $nazwabazy);
	
	if ($conn->connect_errno)
	{
		echo "Error: ".$conn->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		//Zabezpieczenie przed wstrzykiwaniem sqla zamienia apostrofy
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		//mysqli_real_escape_string-bez znaków specjalnych, sprintf-zamienia '%s' na ,$login
		if ($rezultat = @$conn->query( 
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
		mysqli_real_escape_string($conn,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			//czy jest user
			if($ilu_userow>0)
			{
				$tablica = $rezultat->fetch_assoc();
				//sprawdza czy hasło się zgadza
				if (password_verify($haslo, $tablica['hasło']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $tablica['id'];
					$_SESSION['user'] = $tablica['nazwa_użytkownika'];
					$_SESSION['drewno'] = $tablica['drewno'];
					$_SESSION['email'] = $tablica['email'];
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					//do samej strony
					header('Location: gra.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$conn->close();
	}
	
?>