<?php

$attractie = $_POST['attractie'];
$type = $_POST['type'];
$capaciteit = $_POST['capaciteit'];
$melder = $_POST['melder'];
$prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
$overig = $_POST['overig'];

require_once 'conn.php';

$query = "
INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

$statement = $conn->prepare($query);
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => $capaciteit,
    ':prioriteit' => $prioriteit,
    ':melder' => $melder,
    ':overige_info' => $overig
]);

$items = $statement->fetchAll(PDO::FETCH_ASSOC);

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
