<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../src/db.php";
    $query = "SELECT * FROM users
              WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($query);
    $user = $result->fetch_assoc();
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($user["name"]) ?>
  </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.orange.min.css" />
  <link rel="stylesheet" href="./styles.css" />
</head>

<body>
  <header id="header" class="header">
    <div class="container">
      <h3><strong>Booking Service</strong></h3>

      <?php if (isset($user)): ?>
      <nav id="header-nav">
        <ul>
          <li>
            <a href="index.php" class="header-nav-item">
              Home
            </a>
          </li>

          <li>
            <a href="account.php" class="header-nav-item nav-user-name">
            </a>
          </li>

          <li>
            <a href="../src/logout.php" class="header-nav-item">
              Logout
            </a>
          </li>

          <details class="dropdown" id="header-nav-mobile-menu">
            <summary>
              Menu
            </summary>

            <ul dir="rtl">
              <li>
                <a href="index.php">
                  Home
                </a>
              </li>

              <li>
                <a href="account.php" class="nav-user-name">
                </a>
              </li>

              <li>
                <a href="#">
                  Logout
                </a>
              </li>
            </ul>
          </details>
        </ul>
      </nav>
      <?php endif; ?>
    </div>
  </header>

  <main id="main" class="container"></main>

  <footer id="footer" class="page-footer">
    <div class="container">
      <small><strong>Booking Service - a Simple PHP Learning Project (2026)</strong></small>

      <br>

      <small><i>by Stefano Confalone</i></small>
    </div>
  </footer>

  <script>
    <?php if (isset($user)): ?>

    // truncate user name on nav to avoid overlapping
    function truncateString(str, num) {
      if (str.length <= num) {
        return str;
      } else {
        const truncated = str.slice(0, num) + "...";
        return truncated;
      }
    }

    const userNameLinks = document.getElementsByClassName("nav-user-name");
    for (let i = 0; i < userNameLinks.length; i++) {
      const userName = <?= json_encode($user["name"]) ?> ;
      userNameLinks[i].innerHTML = truncateString(userName, 8);
    }

    <?php endif; ?>
  </script>
</body>

</html>