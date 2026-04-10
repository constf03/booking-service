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

  <main id="main" class="container">
    <section>
      <?php if (isset($user)): ?>

      <h1>Welcome back!</h1>

      <section>
        <h3>Bookings - <span id="week-number"></span></h3>
        <p>View available bookings below and book yourself an available time.</p>

        <div>
          <span id="week-first-date"></span>
          <span>-</span>
          <span id="week-last-date"></span>
        </div>

        <table border="1" id="bookings-table">
          <thead>
            <tr>
              <th>Time / Day</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
              <th>Saturday</th>
              <th>Sunday</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>8:00-9:00</td>
              <td class="booking-slot" id="slot02"></td>
              <td class="booking-slot" id="slot03"></td>
              <td class="booking-slot" id="slot04"></td>
              <td class="booking-slot" id="slot05"></td>
              <td class="booking-slot" id="slot06"></td>
              <td class="booking-slot" id="slot07"></td>
              <td class="booking-slot" id="slot08"></td>
            </tr>
            <tr>
              <td>9:00-10:00</td>
              <td class="booking-slot" id="slot09"></td>
              <td class="booking-slot" id="slot10"></td>
              <td class="booking-slot" id="slot11"></td>
              <td class="booking-slot" id="slot12"></td>
              <td class="booking-slot" id="slot13"></td>
              <td class="booking-slot" id="slot14"></td>
              <td class="booking-slot" id="slot15"></td>
            </tr>
            <tr>
              <td>10:00-11:00</td>
              <td class="booking-slot" id="slot16"></td>
              <td class="booking-slot" id="slot17"></td>
              <td class="booking-slot" id="slot18"></td>
              <td class="booking-slot" id="slot19"></td>
              <td class="booking-slot" id="slot20"></td>
              <td class="booking-slot" id="slot21"></td>
              <td class="booking-slot" id="slot22"></td>
            </tr>
            <tr>
              <td>11:00-12:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>12:00-13:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>13:00-14:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>14:00-15:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>15:00-16:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>16:00-17:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>17:00-18:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>18:00-19:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>19:00-20:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
            <tr>
              <td>20:00-21:00</td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
              <td class="booking-slot"></td>
            </tr>
          </tbody>
        </table>
        <p id="bookings-table-info-text"></p>
      </section>

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
  <script type="text/javascript" src="./script.js"></script>
</body>

</html>