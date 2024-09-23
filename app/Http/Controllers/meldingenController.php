<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit'];
$melder = $_POST['melder'];

echo $attractie . " / " . $capaciteit . " / " . $melder;

//1. Verbinding
require_once '../../../config/conn.php';

$query = "INSERT INTO meldingen(attractie,type,capaciteit,prioriteit,melder,overige_info)
VALUES(:attractie,:type,:capaciteit,:prioriteit,:melder,:overige_info)";

    $statement = $conn->prepare($query);
    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig,
    ]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");
