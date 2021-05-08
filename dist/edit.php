<?php
    require('includes/db.php');

    $user = $_SESSION['user'];

    if ( !isset($user) ) {
        header('Location: login.php');
    }

    if ($user['role'] != 'teacher') {
        header('Location: index.php');
    }

    $student_id = $_GET['student_id'];
    $subject_id = $_GET['subject_id'];

    $student_name = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `name` from `users` WHERE `id` = '$student_id'"))['name'];
    $subject_name = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `name` from `subjects` WHERE `id` = '$subject_id'"))['name'];
    $mark = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `mark` from `marks` WHERE `subject_id` = '$subject_id' AND `student_id` = '$student_id'"))['mark'];

    if ( isset($_POST['edit-mark-send']) ) {
        $new_mark = $_POST['edit-mark'];

        if ( empty($mark) ) {
            mysqli_query($connection, "INSERT INTO `marks` (`student_id`, `subject_id`, `mark`) VALUES ('$student_id', '$subject_id', '$new_mark')");
        } else {
            // обновить

            mysqli_query($connection, "UPDATE `marks` SET `mark` = '$new_mark' WHERE `student_id` = '$student_id' AND `subject_id` = '$subject_id'");
        }

        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" >
		<title>Редактировать</title>
		<link rel="stylesheet" href="css/app.min.css">
        <link rel="shortcut icon" href="images/dest/favicon.png">
		<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
	</head>
	<body class="layout">
        <header class="header">
            <a href="index.php" class="form-control">Назад</a>
        </header>
		<main class="layout__main">
        <h4 class="form__title text-center">Оценка студента "<?php echo $student_name ?>" по предмету "<?php echo $subject_name ?>"</h4>
			<form class="form" method="POST">
				<div class="form__content">
                    <div class="input-group">
                        <input type="number" required name="edit-mark" class="form-control" value="<?php echo $mark ?>" min="2" max="5" placeholder="Оценка">
                        <button type="submit" name="edit-mark-send" class="form-control">
                            <ion-icon name="checkmark-outline" size="small"></ion-icon>
                        </button>
                    </div>
				</div>
			</form>
		</main>
		<?php include 'includes/footer.php' ?>

		<script src="js/app.min.js"></script>
	</body>
</html>