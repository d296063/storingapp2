<?php
//var_dump($_POST);
//die;
//conectie database 
require_once '../../../config/conn.php';

$action = $_POST['action'];

if ($action == "create") { 
    //Variabelen vullen
    $attractie = $_POST['attractie'];
    if (empty($attractie)) {
        $errors[] = "Vuldeattractie-naamin.";
    }
    $type = $_POST['type'];
    if (empty($type)) {
        $errors[] = "Kies een type.";
    }
    $capaciteit = isset($_POST['capaciteit']) ? intval($_POST['capaciteit']) : 0;
    if (!is_numeric($capaciteit)) {
        $errors[] = "Vul voor capaciteit een geldig getal in.";
    }
    if (isset($_POST['prioriteit'])) {
        $prioriteit = true;
    } else {
        $prioriteit = false;
    }
    $melder = $_POST['melder'];
    if (empty($melder)) {
        $errors[] = "voer uw naam in.";
    }
    $overig = $_POST['overig'];



    //1. Verbinding



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
}
if ($action == "update") {
    $id = $_POST['id'];
    $capaciteit = isset($_POST['capaciteit']) ? intval($_POST['capaciteit']) : 0;
    if (!is_numeric($capaciteit)) {
        $errors[] = "Vul voor capaciteit een geldig getal in.";
    }
    if (isset($_POST['prioriteit'])) {
        $prioriteit = true;
    } else {
        $prioriteit = false;
    }
    $melder = $_POST['melder'];
    if (empty($melder)) {
        $errors[] = "voer uw naam in.";
    }
    $overig = $_POST['overig'];


    $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig,
        ":id" => $id
    ]);
    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");
}
