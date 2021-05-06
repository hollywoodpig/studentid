<?php
	require 'includes/db.php';

    $student_id = 1;

    $student = mysqli_fetch_assoc(mysqli_query($connection, 'SELECT * FROM `students` WHERE `id` = ' . $student_id . ''));
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" >
		<title><?php echo $student['full_name'] ?></title>
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
                    <span><?php echo $student['full_name'] ?></span>
                    <ion-icon name="log-out-outline"></ion-icon>
				</a>
            </div>
        </header>
		<div class="layout__heading">
			<h1><?php echo $student['full_name'] ?></h1>
            <div>
                <h5>Группа: <?php echo $student['student_group'] ?></h5>
            </div>
		</div>
		<main class="layout__main">
            <div class="table">
                <table>
                    <tr>
                        <th><h4>Предмет</h4></th>
                        <th><h4>Оценка</h4></th>
                        <th><h4>Преподаватель</h4></th>
                    </tr>
                    <?php
                        $subjects = mysqli_query($connection, 'SELECT * FROM `subjects`');

                        while ( ($subject = mysqli_fetch_assoc($subjects)) ) {
                            $teacher_name = mysqli_fetch_assoc(mysqli_query($connection, 'SELECT `full_name` FROM `teachers` WHERE `id` = ' . $subject['teacher_id'] . ''))['full_name'];
                            $mark = mysqli_fetch_assoc(mysqli_query($connection, 'SELECT `mark` from `marks` WHERE `subject_id` = ' . $subject['id'] . ' AND `student_id` = ' . $student_id . ''))['mark'];

                            echo '
                                <tr>
                                    <td>' . $subject['name'] .'</td>
                                    <td>' . $mark . '</td>
                                    <td>' . $teacher_name . '</td>
                                </tr>
                            ';
                        }

                        mysqli_close($connection);
                    ?>
                </table>
            </div>
		</main>
        <?php include 'includes/footer.php' ?>

		<script src="js/app.min.js"></script>
	</body>
</html>