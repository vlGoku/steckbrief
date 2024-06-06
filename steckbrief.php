<?php

declare (strict_types = 1);


?>

<main>
    <img src="<?= $image = $_FILES['image'] ?>">
    <div style="display: grid">
        <h2>Persönliche Daten</h2>
        <p>Geschlecht: <?= $daten['gender'] ?></p>
        <p>Vorname: <?= $daten['first_name'] ?></p>
        <p>Nachname: <?= $daten['last_name'] ?></p>
        <p>Alter: <?= $daten['age'] ?></p>
        <p>E-Mail: <?= $daten['email'] ?></p>
        <p>Telefon: <?= $daten['phone_number'] ?></p>
        <p>Straße: <?= $daten['streetname'] ?></p>
        <p>PLZ: <?= $daten['postcode'] ?></p>
        <p>Ort: <?= $daten['place'] ?></p>
    </div>
</main>
