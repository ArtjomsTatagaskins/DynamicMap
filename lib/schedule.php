<?php
require "db.php";

header('Content-Type: application/json');

if (isset($_GET['selected-date'])) {
    $selected_date = $_GET['selected-date'];

    try {
        $query = $pdo->prepare("SELECT DISTINCT room FROM schedule WHERE date = :selected_date");
        $query->execute(['selected_date' => $selected_date]);
        $rooms = $query->fetchAll(PDO::FETCH_COLUMN);

        if (count($rooms) > 0) {
            echo json_encode($rooms);
        } else {
            echo json_encode(['message' => 'Nav lekciju']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Nav izvēlēts datums']);
}
