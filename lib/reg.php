<?php
session_start();

$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$retypePassword = trim($_POST['retype-password']);

$errors = [];

if (strlen($name) < 2) {
    $errors['name'] = "Vārdam jābūt vismaz 2 rakstzīmju garam";
}

if (strlen($surname) < 2) {
    $errors['surname'] = "Uzvārdam jābūt vismaz 2 rakstzīmes garam";
}

if (strlen($password) < 6) {
    $errors['password'] = "Parolei jābūt vismaz 6 rakstzīmju garai";
}

if ($password !== $retypePassword) {
    $errors['retype-password'] = "Paroles nesakrīt";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old_data'] = $_POST;
    header('Location: /registration.php');
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    require 'db.php';

    $sql = 'INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)';
    $query = $pdo->prepare($sql);

    if ($query->execute([$name, $surname, $email, $hashed_password])) {
        header('Location: /authorization.php');
        exit;
    }

} catch (PDOException $e) {
    echo "Datubāzes savienojuma kļūda: " . $e->getMessage();
}
?>
