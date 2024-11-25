<?php
require "db.php";

if (isset($_GET['selected-date'])) {
    $selectedDate = $_GET['selected-date'];
    try {
        $sql = "
            SELECT s.room, c.course_name
            FROM schedule s
            JOIN courses c ON s.course_id = c.course_id
            WHERE s.date = ?
        ";
        $query = $pdo->prepare($sql);
        $query->execute([$selectedDate]);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            echo json_encode(["message" => "Nav datu šai dienai."]);
            exit;
        }

        $rooms = [];
        foreach ($result as $row) {
            $rooms[$row['room']] = $row['course_name'];
        }

        echo json_encode($rooms);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Kļūda, ielādējot datus: " . htmlspecialchars($e->getMessage())]);
    }
} else {
    echo json_encode(["error" => "Datums nav norādīts!"]);
}
?>
