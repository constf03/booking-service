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
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.orange.min.css"
    />
    <link rel="stylesheet" href="./styles.css" />
  </head>
  <body>
    <header id="header" class="header">
      <div class="container">
        <h3><strong>Booking Service</strong></h3>
        <nav id="header-nav">
          <ul>
            <?php if(isset($user)): ?>
              <li><a href="#" class="header-nav-item">My Bookings</a></li>
              <li>
                <a href="#" class="header-nav-item" id="nav-user-name">
                  <?= htmlspecialchars($user["name"]) ?>
                </a>
              </li>
              <li><a href="../src/logout.php" class="header-nav-item">Logout</a></li>
              <details class="dropdown" id="header-nav-mobile-menu">
                <summary>
                  Menu
                </summary>
                <ul dir="rtl">
                  <li><a href="#">My Bookings</a></li>
                  <li><a href="#">Settings</a></li>
                  <li><a href="#">Logout</a></li>
                </ul>
              </details>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </header>

    <main id="main" class="container">
      <section>
        <?php if(isset($user)): ?>

          <h1>Welcome back!</h1>

          <div></div>

        <?php else: ?>

          <h2>Login Required</h2>
          <p>You must be logged in to use this service.</p>
          <p>Please <a href="./login.php">login</a> or <a href="./register.html">register.</a></p>

        <?php endif; ?>
      </section>
    </main>

    <footer id="footer" class="page-footer">
      <div class="container">
        <small><strong>Booking Service - a Simple PHP Learning Project (2026)</strong></small>
        <br>
        <small><i>by Stefano Confalone</i></small>
      </div>
    </footer>
    
    <script>
      <?php if(isset($user)): ?>
        
        // truncate user name on nav to avoid overlapping
        const truncateString = (str, num) => {
          if (str.length <= num) {
            return str;
          } else {
            return str.slice(0, num) + "...";
          }
        }

        const truncated = truncateString(<?= json_encode($user["name"]) ?>, 8);
        document.querySelector("#nav-user-name").innerHTML = truncated;

      <?php endif; ?>
    </script>
  </body>
</html>
