<?php

$attractie = $_POST['attractie'];
if (empty($attractie)) {
    $errors[] = 'Attractie is verplicht';
}

$type = $_POST['type'];
if (empty($type)) {
    $errors[] = 'Type is verplicht';
}

$capaciteit = $_POST['capaciteit'];
if (!is_numeric($capaciteit)) {
    $errors[] = 'Capaciteit moet een getal zijn';
}

$melder = $_POST['melder'];
if (empty($melder)) {
    $errors[] = 'Melder is verplicht';
}

$prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
$overig = $_POST['overig'];

if (isset($errors)) {
    var_dump($errors);
    die();
}

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