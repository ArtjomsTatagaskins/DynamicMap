<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$oldData = $_SESSION['old_data'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old_data']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autorizācija</title>
    <link rel="stylesheet" href="/styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php  require_once "blocks/header.php"; ?>

    <!--        main          -->

    <main class="authorization">
        <div class="signin-container">
            <h2>Ienākt</h2>
            <p id="access-account">Piekļūt Jūsu kontam</p>
            <form action="lib/auth.php" method="post" id="authorization-form">
                <label for="email">E-pasta adrese</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Ievadiet paroli</label>
                <input type="password" name="password" id="password" required>
                <?php if (isset($errors['user/password'])): ?>
                    <div class="error-message"><img src="/styles/icons/icon=error.svg" alt="error"><?php echo $errors['user/password']; ?></div>
                <?php endif; ?>
                <button type="submit">Ienākt</button>
            </form>
            <p id="no-account">Jums nav konta? <a href="registration.php">Izveidot kontu</a></p>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>

</div>

</body>
</html>