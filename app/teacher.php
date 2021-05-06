<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" >
		<title>Дима</title>
		<link rel="stylesheet" href="css/app.min.css">
		<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
	</head>
	<body class="layout">
        <header class="header">
            <a href="https://biit39.ru/" target="_blank" class="form-control logo">БИТ</a>
            <div class="header__controls">
				<button class="form-control">
                    <ion-icon name="settings-outline" size="small"></ion-icon>
                </button>
                <a href="index.html" class="form-control">
                    <span>Дима</span>
                    <ion-icon name="log-out-outline"></ion-icon>
				</a>
            </div>
        </header>
		<div class="layout__heading">
			<h1>Дима</h1>
		</div>
		<main class="layout__main">
			<div class="teacher">
				<form class="teacher__controls">
					<select class="form-control">
						<option value="" disabled selected>Выберите предмет</option>
						<option>Монтаж и наладка технологического оборудования</option>
						<option>Практика</option>
					</select>
					<button data-click class="form-control">СА-10</button>
					<button data-click class="form-control active">ВД-30</button>
					<button data-click class="form-control">ИБ-40</button>
				</form>
				<div class="table">
					<table>
						<tr>
							<th><h4>Студент</h4></th>
							<th><h4>Оценка</h4></th>
						</tr>
						<tr>
							<td>Руслан Галлимулин</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Никита Кирша</td>
							<td>
								<input type="number" class="form-control" min="2" max="5" value="2">
							</td>
						</tr>
						<tr>
							<td>Кирилл Терентьев</td>
							<td>
								2
							</td>
						</tr>
						<tr>
							<td>Владислав Зикеев</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Михаил Рыженков</td>
							<td>2</td>
						</tr>
					</table>
				</div>
			</div>
		</main>
		<?php include 'includes/footer.php' ?>
		<div class="alert">Данные сохранены</div>

		<script src="js/app.min.js"></script>
	</body>
</html>