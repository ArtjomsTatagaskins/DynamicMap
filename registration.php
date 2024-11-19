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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reģistrācija</title>
    <link rel="stylesheet" href="/styles/styles.css">
</head>
<body>
<div class="wrapper">
    <?php require_once "blocks/header.php"; ?>

    <!-- main -->
    <main class="registration">
        <div class="create-account-container">
            <h2>Izveidot kontu</h2>
            <p id="get-started">Sāciet strādāt ar kontu</p>
            <p id="required-message"><span id="symbol-required">*</span> norāda obligāto lauku.</p>
            <form action="lib/reg.php" id="registration-form" method="post">
                <label for="name">Vārds <span id="symbol-required">*</span></label>
                <input type="text" name="name" id="name" value="<?php echo $oldData['name'] ?? ''; ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <div class="error-message"><img src="/styles/icons/icon=error.svg" alt="error"><?php echo $errors['name']; ?></div>
                <?php endif; ?>

                <label for="surname">Uzvārds <span id="symbol-required">*</span></label>
                <input type="text" name="surname" id="surname" value="<?php echo $oldData['surname'] ?? ''; ?>" required>
                <?php if (isset($errors['surname'])): ?>
                    <div class="error-message"><img src="/styles/icons/icon=error.svg" alt="error"><?php echo $errors['surname']; ?></div>
                <?php endif; ?>

                <label for="email">E-pasta adrese <span id="symbol-required">*</span></label>
                <input type="email" name="email" id="email" value="<?php echo $oldData['email'] ?? ''; ?>" required>

                <label for="password">Izveidojiet paroli <span id="symbol-required">*</span></label>
                <input type="password" name="password" id="password" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="error-message"><img src="/styles/icons/icon=error.svg" alt="error"><?php echo $errors['password']; ?></div>
                <?php endif; ?>

                <label for="retype-password">Atkārtoti ievadiet paroli <span id="symbol-required">*</span></label>
                <input type="password" name="retype-password" id="retype-password" required>
                <?php if (isset($errors['retype-password'])): ?>
                    <div class="error-message"><img src="/styles/icons/icon=error.svg" alt="error"><?php echo $errors['retype-password']; ?></div>
                <?php endif; ?>

                <button type="submit">Izveidot kontu</button>
            </form>
        </div>
        <div class="benefits">
            <h3>Konta izveides priekšrocības</h3>
            <div class="point-container">
                <img src="/styles/icons/icons=table.svg" alt="elipse">
                <p>Personalizēts studiju grafiks: Ar kontu jūs varat piekļūt savam individuālajam studiju grafikam un ātri atrast lekciju vietas tieši savām vajadzībām.</p>
            </div>
            <div class="point-container">
                <img src="/styles/icons/icons=map.svg" alt="elipse">
                <p>Iespēja pielāgot karti: Lietotāji ar kontu var pievienot piezīmes, saglabāt biežāk apmeklētos maršrutus un ērti orientēties fakultātes telpās.</p>
            </div>
            <div class="point-container">
                <img src="/styles/icons/icon=notifications.svg" alt="notification">
                <p>Atgādinājumi un paziņojumi: Reģistrējoties, jūs saņemsiet svarīgus paziņojumus un atgādinājumus par gaidāmajām lekcijām un izmaiņām.</p>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>

</div>

</body>
</html>
