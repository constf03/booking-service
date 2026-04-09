<?php

$is_valid = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/../src/db.php";
    $query = sprintf(
        "SELECT * FROM users
      WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    $result = $mysqli->query($query);
    $user = $result->fetch_assoc();

    if (!$user) {
        $is_valid = false;
    }

    if ($user && !password_verify($_POST["password"], $user["password_hash"])) {
        $is_valid = false;
    }

    if ($is_valid) {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime

        session_start();
        session_regenerate_id();

        $_SESSION["user_id"] = $user["id"];

        header("Location: index.php");
        exit;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.orange.min.css" />
  <title>Login - Booking Service</title>
</head>

<body>
  <header></header>

  <main class="container">
    <section>
      <h1>Login</h1>

      <form method="post">
        <div>
          <label for="email">Email</label>
          <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" />
        </div>

        <div>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" />
        </div>

        <button>Login</button>

        <br />

        <?php if (!$is_valid): ?>
        <em>Invalid login.</em>
        <?php endif; ?>
      </form>
    </section>
  </main>

  <footer></footer>
</body>

</html>