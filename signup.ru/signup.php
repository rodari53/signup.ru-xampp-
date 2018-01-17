

<?php 
  require "includes/config.php";
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="style/style.css" rel="stylesheet">
</head>
<body>
<header>
	
<ul>
	<li><a href="http://localhost/signup.ru/">Главная</a></li>
	<li><a href="http://localhost/signup.ru/">Новости</a></li>
	<li><a href="http://localhost/signup.ru/">Обратная связь</a></li>
</ul>
</header>
<content>


<?php
	
	

		$data= $_POST;
		if (isset($data['do_signup']) )
		{
			// здесь регистрируем
			$errors = array();
			if( trim ($data['login']) == '' )
			{
				$errors[] = 'Введите логин';
			}
			if( trim ($data['email']) == '' )
			{
				$errors[] = 'Введите email';
			}
			if(  ($data['password']) == '' )
			{
				$errors[] = 'Введите пароль';
			}
			if(  ($data['password_2']) != $data['password'] )
			{
				$errors[] = 'Повторный пароль введен не верно';
			}

			$login = mysqli_real_escape_string($dbc, trim($_POST['login']));
			$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
			$password = mysqli_real_escape_string($dbc, trim($_POST['password']));

			$query = "SELECT * FROM `users` WHERE login = '$login'";
			$datar = mysqli_query($dbc, $query);

			if( mysqli_num_rows($datar) > 0)
			{
				$errors[] = 'Пользователь с таким логином уже зарегестрирован';
			}

			$query = "SELECT * FROM `users` WHERE email = '$email'";
			$datar = mysqli_query($dbc, $query);

			if( mysqli_num_rows($datar) > 0)
			{
				$errors[] = "Пользователь с таким email'ом уже зарегестрирован";
			}

			if ( empty($errors) )
			{
				// все хорошо, можно регестрировать


				$login = mysqli_real_escape_string($dbc, trim($_POST['login']));
				$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
				$password = mysqli_real_escape_string($dbc, trim($_POST['password']));

			$query ="INSERT INTO `users` (login, email, password) VALUES ('$login','$email', SHA('$password'))";
			mysqli_query($dbc,$query);

				echo '<div style="color:green;">Вы успешно зарегестрированы!</div>'; ?><br>
				<input type="submit" style="width:90px;height:25px;" value="Главная" onclick=" location.href='http://localhost/signup.ru/'  "><br><hr><br><br>
			<?php
			} 
				else{
					echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
			}


			
		}

?>




<form action="signup.php" method="POST">

	<p>
		<p>Ваш Логин:</p>
		<input type="text" name="login" value="<?php echo @$data['login']; ?>">
	</p>	<br>
	<p>
		<p>Ваш Email:</p>
		<input type="email" name="email" value="<?php echo @$data['email']; ?>">
	</p>	<br>
	<p>
		<p>Ваш пароль:</p>
		<input type="password" name="password" value="<?php echo @$data['password']; ?>">
	</p>	
	<p>
		<p>Введите ваш пароль еще раз:</p>
		<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
	</p>	
	<p>
		<button type="submit" name="do_signup">Зарегестрироваться </button>
	</p>

	</form>



</content>
<footer class="clear">
	<p>Все права защищены</p>
</footer>

</body>

</html>





