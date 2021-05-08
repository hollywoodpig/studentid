<?php
    require('includes/db.php');

    $user = $_SESSION['user'];

    if ( !isset($user) ) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" >
		<title><?php echo $user['name'] ?></title>
		<link rel="stylesheet" href="css/app.min.css">
        <link rel="shortcut icon" href="images/dest/favicon.png">
		<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
	</head>
	<body class="layout">
        <header class="header">
            <a href="https://biit39.ru/" target="_blank" class="form-control logo">БИТ</a>
            <div class="header__controls">
				<a href="https://youtu.be/dQw4w9WgXcQ" target="_blank" class="form-control">
                    <ion-icon name="settings-outline" size="small"></ion-icon>
                </a>
                <a href="logout.php" class="form-control">
                    <span><?php echo $user['name'] ?></span>
                    <ion-icon name="log-out-outline"></ion-icon>
				</a>
            </div>
        </header>
		<div class="layout__heading">
			<h1><?php echo $user['name'] ?></h1>
		</div>
		<main class="layout__main">
			<div class="teacher">
                <?php if ($user['role'] == 'teacher'): ?>
                    <form class="teacher__controls" method="POST">
                        <select class="form-control" name="current-subject" required>
                            <option disabled selected>Выберите предмет</option>

                            <?php
                                $user_id = $user['id'];

                                $subjects = mysqli_query($connection, "SELECT * FROM `subjects` WHERE `teacher_id` = $user_id");

                                while ( ($subject = mysqli_fetch_assoc($subjects)) ) {
                                    echo '
                                        <option value="' . $subject['id'] . '"> ' . $subject['name'] . ' </option>
                                    ';
                                }
                            ?>
                        </select>
                        <button class="form-control" name="output-marks">Вывести оценки</button>
                    </form>
                    <?php if ( isset($_POST['output-marks']) ): ?>
                        <h4 class="teacher__subject-title">
                            <?php
                                $subject_id = $_POST['current-subject'];

                                $subject_name = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `name` from `subjects` WHERE `id` = '$subject_id'"))['name'];

                                echo $subject_name;
                            ?>
                        </h4>
                    <?php endif; ?>
                <?php endif; ?>
				<div class="table">
					<table>
                        <?php if ($user['role'] == 'teacher'): ?>
                            <?php
                                if ( isset($_POST['output-marks']) ) {
                                    if ( empty($_POST['current-subject']) ) {
                                        return false;
                                    }

                                    $subject_id = $_POST['current-subject'];

                                    echo '
                                        <tr>
                                            <th><h4>Студент</h4></th>
                                            <th><h4>Оценка</h4></th>
                                            <th>🤔</th>
                                        </tr>
                                    ';

                                    $students = mysqli_query($connection, "SELECT * FROM `users` WHERE `role` = 'student'");
                                    
                                    while ( ($student = mysqli_fetch_assoc($students)) ) {
                                        $student_id = $student['id'];

                                        $mark = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `mark` from `marks` WHERE `subject_id` = '$subject_id' AND `student_id` = '$student_id'"))['mark'];

                                        if ( empty($mark) ) {
                                            $mark = 'Нет оценки';
                                        }

                                        echo '
                                            <tr>
                                                <td>' . $student['name'] . '</td>
                                                <td>' . $mark . '</td>
                                                <td class="table__edit-row">
                                                    <a href="edit.php?student_id=' . $student_id . '&subject_id=' . $subject_id . '" class="form-control">
                                                        <ion-icon name="create-outline" size="small"></ion-icon>
                                                    </a>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }
                            ?>
                        <?php endif ?>

                        <?php if ($user['role'] == 'student'): ?>
                            <tr>
                                <th><h4>Предмет</h4></th>
                                <th><h4>Оценка</h4></th>
                                <th><h4>Преподаватель</h4></th>
                            </tr>

                            <?php
                                $subjects = mysqli_query($connection, 'SELECT * FROM `subjects`');

                                while ( ($subject = mysqli_fetch_assoc($subjects)) ) {
                                    $teacher_id = $subject['teacher_id'];
                                    $subject_id = $subject['id'];
                                    $student_id = $user['id'];

                                    $teacher_name = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `name` FROM `users` WHERE `id` = '$teacher_id' AND `role` = 'teacher'"))['name'];
                                    $mark = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `mark` from `marks` WHERE `subject_id` = '$subject_id' AND `student_id` = '$student_id'"))['mark'];

                                    if ( empty($mark) ) {
                                        $mark = 'Нет оценки';
                                    }
        
                                    echo '
                                        <tr>
                                            <td>' . $subject['name'] .'</td>
                                            <td>' . $mark . '</td>
                                            <td>' . $teacher_name . '</td>
                                        </tr>
                                    ';
                                }
                            ?>

                        <?php endif ?>
					</table>
				</div>
			</div>
		</main>
		<?php include 'includes/footer.php' ?>

		<script src="js/app.min.js"></script>
	</body>
</html>