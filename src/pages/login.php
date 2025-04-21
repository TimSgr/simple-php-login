<?php
$db = db();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $loginResult = $db->verifyUserLogin($email, $password);

    if ($loginResult === "Valid") {
        $stmt = $db->getConnection()->prepare("SELECT id, emailAdress FROM users WHERE emailAdress = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['emailAdress'];
        session_regenerate_id(true);
        flash('login_success', 'Login erfolgreich!');
        header('Location: /dashboard');
        exit;
    } elseif ($loginResult === "Wrong Credentials") {
        $error = "E-Mail oder Passwort falsch.";
    } else {
        $error = "Es gab einen Fehler beim Login.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/assets/css/style.min.css" rel="stylesheet" />
</head>
<body>
  <h2>Login</h2>
  <?php if (!empty($error)): ?>
        <div style="color: red;"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <div class="flex justify-center content-center">
    <form action="" method="POST" class="login_form flex gap-8">
      <label for="email">Email</label>
      <input type="email" name="email" id="email "/>

      <label for="password">Passwort</label>
      <input type="password" name="password" id="password "/>

      <button type="submit">Einloggen</button>
    </form>
  </div>

  <h3>noch kein account?</h3>
  <p><a href="/register/">hier</a> registrieren</p>
</body>
</html>