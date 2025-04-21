<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}
$successMessage = flash('login_success');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php if ($successMessage): ?>
        <div style="color: green;"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>
    <p>Du bist eingeloggt!</p>

    <form method="POST" action="/logout">
        <button type="submit">Logout</button>
    </form>
</body>
</html>