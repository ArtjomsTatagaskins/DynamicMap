<?php
require "lib/db.php";

try {
    $sql = "SELECT course_id, course_name FROM courses";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lecture_options = "";
    if (!empty($results)) {
        foreach ($results as $row) {
            $lecture_options .= "<option value='" . htmlspecialchars($row['course_id']) . "'>" . htmlspecialchars($row['course_name']) . "</option>";
        }
    } else {
        $lecture_options = "<option value=''>Nav lekciju</option>";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interaktīvā karte</title>
    <link rel="stylesheet" href="/styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <script src="script.js" defer></script>
    <div class="wrapper">
        <?php  require_once "blocks/header.php"; ?>
        <main class="user">
            <div class="button-list">

                <label for="popup-toggle1" class="open-btn">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Pievienot lekcijas
                </label>
                <input type="checkbox" id="popup-toggle1" class="popup-toggle">

                <div class="popup" id="popup1">
                    <div class="popup-content">
                        <label for="popup-toggle1" class="close-btn">&times;</label>
                        <form action="lib/schelude.php" method="post" class="user-form">

                            <label for="course-id">Nosaukums (Lekcija)</label>
                            <select id="course-id" name="course-id" required>
                                <?php echo $lecture_options; ?>
                            </select>

                            <label for="events-date">Datums</label>
                            <input type="date" id="events-date" name="events-date" required><br>

                            <label for="events-starttime">Sākuma laiks</label>
                            <input type="time" id="events-starttime" name="events-starttime" required><br>

                            <label for="events-endtime">Beiguma laiks</label>
                            <input type="time" id="events-endtime" name="events-endtime" required><br>

                            <label for="events-room">Auditorija</label>
                            <input type="text" id="events-room" name="events-room" required><br>

                            <button type="submit">Sūtīt</button>
                        </form>
                    </div>
                </div>


                <label for="popup-toggle2" class="open-btn">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Kalendārs
                </label>
                <input type="checkbox" id="popup-toggle2" class="popup-toggle">

                <div class="popup" id="popup2">
                    <div class="popup-content">
                        <label for="popup-toggle2" class="close-btn">&times;</label>
                        <form method="POST" action="">
                            <label for="selected-date">Izvēlies datumu:</label>
                            <input type="date" id="selected-date" name="selected-date" value="<?php echo htmlspecialchars($selected_date); ?>">
                            <button type="submit">Skatīt karti</button>
                        </form>
                    </div>
                </div>

            </div>
            <div id="map-container"></div>
            <div class="tooltip">Tooltip</div>
        </main>
        <?php  require_once "blocks/footer.php"; ?>
    </div>
</body>
</html>
