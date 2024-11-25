<?php
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO schedule (course_id, date, start_time, end_time, room) VALUES (?, ?, ?, ?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([
            $_POST['course-id'],
            $_POST['events-date'],
            $_POST['events-starttime'],
            $_POST['events-endtime'],
            $_POST['events-room'],
        ]);

        header('Location: /user.php');
    } catch (PDOException $e) {
        echo "<p>Kļūda pievienojot lekciju: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<p>Nederīgs pieprasījums!</p>";
}
?>
