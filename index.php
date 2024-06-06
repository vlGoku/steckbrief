<?php
$title = 'Steckbrief';

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

    include 'steckbrief.php';
}
?>
<?php include 'header.php'; ?>
<?php include 'form.php'; ?>
<!-- Footer -->
</body>
</html>