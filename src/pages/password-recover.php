<?php
if (isset($_SESSION['user_id'])) {
    header('Location: /dashboard');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <p>Wenn Sie ihr Passwort verloren oder vergessen haben, können Sie es hier einfach zurücksetzen lassen.</p>
    <p>Bitte geben Sie Ihre Emailadresse ein und wir senden Ihnen einen Reset Link </p>
    <form method="POST" action="/logout">
        <input type="text" placeholder="Ihre Mailadresse" name="email" id="email" required>
        <button type="submit">Logout</button>
    </form>
</body>
</html>