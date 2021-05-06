<?php
	require 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" >
		<title><?php echo $config['title'] ?></title>
		<link rel="stylesheet" href="css/app.min.css">
		<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
	</head>
	<body class="layout">
		<div class="layout__heading text-center">
			<h1>Добро пожаловать в <?php echo $config['title'] ?></h1>
		</div>
		<main class="layout__main">
			<form class="form" data-type="register">
				<h4 class="form__title">Регистрация</h4>
				<div class="form__content">
					<input type="text" class="form-control" placeholder="Код приглашения">
					<input type="email" class="form-control" placeholder="Введите вашу почту">
					<input type="text" class="form-control" placeholder="Придумайте логин">
					<input type="password" class="form-control" placeholder="Придумайте пароль">
					<button type="submit" class="form-control">Зарегистрироваться</button>
				</div>
				<div class="form__footer">
					<button class="button-link" data-type-open="auth">Есть аккаунт?</button>
				</div>
			</form>
			<form class="form" data-type="auth" data-visible="true">
				<h4 class="form__title">Вход</h4>
				<div class="form__content">
					<input type="email" class="form-control" placeholder="Почта">
					<input type="password" class="form-control" placeholder="Пароль">
					<button type="submit" class="form-control">Войти</button>
				</div>
				<div class="form__footer">
					<button class="button-link" data-type-open="register">Нет аккаунта?</button>
					<button class="button-link" data-type-open="restore-password">Забыли пароль?</button>
				</div>
			</form>
			<form class="form" data-type="restore-password">
				<h4 class="form__title">Восстановление пароля</h4>
				<div class="form__content">
					<input type="email" class="form-control" placeholder="Почта">
					<button type="submit" class="form-control">Восстановить пароль</button>
				</div>
				<div class="form__footer">
					<button class="button-link" data-type-open="register">Обратно</button>
				</div>
			</form>
		</main>
		<?php include 'includes/footer.php' ?>

		<script src="js/app.min.js"></script>
	</body>
</html>