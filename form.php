<?php
declare (strict_types = 1);
include "functions.php";
include 'header.php';

$auswahl_geschlecht = '';
$geschlechter = ["Mann", "Frau", "Divers"];
$daten = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $daten = [
        'gender' => $_POST['auswahl_geschlecht'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'age' => $_POST['age'],
        'email' => $_POST['email'],
        'phone_number' => $_POST['phone_number'],
        'streetname' => $_POST['streetname'],
        'postcode' => $_POST['postcode'],
        'place' => $_POST['place'],
    ];
}

?>
<main>
    <h3>Steckbrief</h3>
    <h4>Input Personal Data </h4>
    <p>Geschlecht</p>
   
    <form action="form.php" method="POST" enctype="multipart/form-data">
    <div style="display: flex; flex-direction: row">
    <?php foreach( $geschlechter as $geschlecht) : ?>
            <label><?= $geschlecht ?> <input type="radio" name="auswahl_geschlecht" id="auswahl_geschlecht" value="<?= $geschlecht ?>" <?= $auswahl_geschlecht == $geschlecht ? 'checked' : ''?>></label>
    <?php endforeach; ?> 
    </div>
        <input type="text" name="first_name" id="first_name" placeholder="Vorname" value=<?= $_POST['first_name'] ?? ''?>>
        <input type="text" name="last_name" id="last_name" placeholder="Nachname" value=<?= $_POST['last_name'] ?? ''?>>
        <input type="text" name="age" id="age" placeholder="Alter" value=<?= $_POST['age'] ?? ''?>>
        <input type="email" name="email" id="email" placeholder="E-Mail" value=<?= $_POST['email'] ?? ''?>>
        <input type="tel" name="phone_number" id="phone_number" placeholder="Telefonnummer" value=<?= $_POST['phone_number'] ?? ''?>>
        <input type="text" name="streetname" id="streetname" placeholder="Straße" value=<?= $_POST['streetname'] ?? ''?>>
        <input type="text" name="postcode" id="postcode" placeholder="PlZ" value=<?= $_POST['postcode'] ?? ''?>>
        <input type="text" name="place" id="place" placeholder="Ort" value=<?= $_POST['place'] ?? ''?>>
        <label for="image">Upload Profile Picture:
            <input type="file" name="image" id="image" accept="image/*">
        </label>
        <input type="submit" value="Senden">
    </form>
</main>

<?php

print_r($daten);