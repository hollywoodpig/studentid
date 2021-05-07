<?php
    require 'includes/db.php';
    unset($_SESSION['user']);
    header('Location: login.php');