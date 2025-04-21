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
    <title>Document</title>
</head>
<body>
  <h2>Login</h2>
  <form>
    <label for="email">Email</label>
    <input type="email" name="email" id="email "/>

    <label for="password">Passwort</label>
    <input type="password" name="password" id="password "/>
  </form>

  <h3>noch kein account?</h3>
  <p><a href="/register/">hier</a> registrieren</p>
</body>
</html>