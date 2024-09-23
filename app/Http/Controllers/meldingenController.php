<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[]="Vul de attractie-naam in.";
}
$type = isset($_POST['type']) ? $_POST['type'] : null;
if (empty($type))
{
    $errors[] = "Kies een type.";
}

$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit ))
{
    $errors[]="Vul voor capaciteit een getal in.";
}
if(isset($_POST['prioriteit']))
{
    $prioriteit = 1;
}
else
{
    $prioriteit = 0;
}
$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[]="Vul alstublieft u naam in.";
}
$overig = $_POST['overig'];
if(isset($errors))
{
    var_dump($errors);
    die();
}

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
