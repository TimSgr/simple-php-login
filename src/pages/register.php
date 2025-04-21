<?php
$db = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $db->createUser(
        $_POST['email'], 
        $_POST['firstname'], 
        $_POST['lastname'], 
        $_POST['password']
    );
    echo $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    <form method="POST" action="">
        <label for="firstname">Vorname</label>
        <input type="text" name="firstname" id="firstname" required />

        <label for="lastname">Nachname</label>
        <input type="text" name="lastname" id="lastname" required />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />

        <label for="password">Passwort</label>
        <input type="password" name="password" id="password" required />

        <button type="submit">Nutzerkonto erstellen</button>
    </form>
</body>
</html>