<?php
	require 'includes/config.php';
	require 'includes/db.php';

    if (isset($_SESSION['user']) ) {
        header('Location: index.php');
    }

	if ( isset($_POST['login']) ) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `role` = '$role'";
		$result = mysqli_fetch_assoc(mysqli_query($connection, $query));

		if ( !empty($result) ) {
			$_SESSION['user'] = $result;

			header('Location: index.php');

			echo '
				<div class="alert success">Вход успешно выполнен, скоро вы будете перенаправлены на главную страницу</div>
			';
		} else {
			echo '
				<div class="alert danger">Данные введены неверно</div>
			';
		}
	}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" >
		<title><?php echo $config['title'] ?></title>
		<link rel="stylesheet" href="css/app.min.css">
		<link rel="shortcut icon" href="images/dest/favicon.png">
		<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
	</head>
	<body class="layout">
		<div class="layout__heading text-center">
			<h1>Добро пожаловать в <?php echo $config['title'] ?></h1>
		</div>
		<main class="layout__main">
			<form class="form" method="POST">
				<h4 class="form__title">Вход</h4>
				<div class="form__content">
					<input type="email" required name="email" class="form-control" placeholder="Почта">
					<input type="password" required name="password" class="form-control" placeholder="Пароль">
					<select class="form-control" name="role">
						<option value="student">Я студент</option>
						<option value="teacher">Я преподаватель</option>
					</select>
					<button type="submit" name="login" class="form-control">Войти</button>
				</div>
			</form>
		</main>
		<?php include 'includes/footer.php' ?>

		<script src="js/app.min.js"></script>
	</body>
</html>