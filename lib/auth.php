<?php
session_start();


$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

try {
    require "db.php";

    $sql = "SELECT * FROM users WHERE email = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        echo "No such user or incorrect password";
    } else {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['is_admin'] = (int)$user['is_admin'];

        setcookie('login', $email, time() + 3600 * 24 * 30, '/');
        header('Location: /user.php');
        exit;
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
