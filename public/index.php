<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../src/db.php";
    $query = "SELECT * FROM users
              WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($query);
    $user = $result->fetch_assoc();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Booking Service</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
    />
    <link rel="stylesheet" href="./styles.css" />
  </head>
  <body>
    <header id="header" class="header">
      <div class="container">
        <h1>Booking Service</h1>
      </div>
    </header>

    <main id="main" class="container">
      <section>
        <?php if(isset($user)): ?>

          <h1>Welcome</h1>
          <p>Hello <?= htmlspecialchars($user["name"]) ?></p>

          <a href="../src/logout.php">Log out</a>

        <?php else: ?>

          <h2>Login Required</h2>
          <p>You must be logged in to use this service.</p>
          <p>Please <a href="./login.php">login</a> or <a href="./register.html">register.</a></p>

        <?php endif; ?>
      </section>
    </main>

    <footer id="footer" class="footer">
      <div class="container">
        <p>&copy; 2025 Stefano Confalone</p>
      </div>
    </footer>
  </body>
</html>
