<?php
declare (strict_types = 1);
include "functions.php";
include 'header.php';

$auswahl_geschlecht = '';
$geschlechter = ["Mann", "Frau", "Divers"];
$daten = [];

$error = '';
$max_file_size = 1024 * 1024 * 4;
$upload_dir = __DIR__ . '/uploads/';
$allowed_types = ['image/jpeg', 'image/png'];
$allowed_extensions = ['jpg' ,'jpeg', 'png']; 

function get_file_path( string $filename, string $path ): string {
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = preg_replace('/[^A-z0-9]/', '-', $basename);
    $i = 0;
    while(file_exists($path . $filename) ) {
        $i++;
        $filename = $basename . $i . '.' . $extension;
    }

    return __DIR__ . '/uploads/' . $filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $image = $_FILES['image'] ?? null;
    $error = $image['error'] === 1 ? 'Image is too big' : '';
    if($image['error'] === 0){
        $error = $image['size'] > $max_file_size ? 'File too large ' : '';
        $typ = mime_content_type($image['tmp_name']);
        $error .= in_array($typ, $allowed_types, true) ? '' : 'File type not allowed';
        $extension = pathinfo( strtolower($image['name']), PATHINFO_EXTENSION);
        $error .= in_array($extension, $allowed_extensions, true) ? '' : 'File extension not allowed';
        if( ! $error ){
            $filename = $image['name'];
            $destination = get_file_path($filename, $upload_dir);
            $moved = move_uploaded_file($image['tmp_name'], $destination);
        }
    } else {
        echo 'Sorry, there was an Error: ' . $image['error'];
    }
}

/*
<?php foreach ($sex as $s): ?>
    <label><?= $s ?><input type="radio" name="sex" id="sex" value="<?= $s ?>" <?= $data['gender'] === $s ? 'checked' : '' ?> /></label>
<?php endforeach; ?> */


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
   
    <form action="index.php" method="POST" enctype="multipart/form-data">
    <div style="display: flex; flex-direction: row">
    <?php foreach( $geschlechter as $geschlecht) : ?>
            <label><?= $geschlecht ?> <input type="radio" name="auswahl_geschlecht" id="auswahl_geschlecht" value="<?= $geschlecht ?>"></label>
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
            <input type="file" name="image" id="image" accept="image/jpeg, image/png">
        </label>
        <span style="color: red"><?= e( $error ) ?></span>
        <input type="submit" value="Senden">
    </form>
</main>
