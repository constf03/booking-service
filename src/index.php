<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/db.php";
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
  <link rel="stylesheet" href="./styles.css" />
</head>

<body>

  <div class="page">
    <div id="banner">
    </div>

    <header id="header">
      <h2>Booking Service</h2>

      <div id="header-sidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="sidepanel-btn-close" onclick="closeNav()">&times;</a>
        <h3>Booking Service</h3>
        <a href="index.php">Home</a>
        <?php if (isset($user)): ?>
        <a href="account.php">Profile</a>
        <a href="logout.php">Logout</a>
        <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.html">Register</a>
        <?php endif; ?>
        <a href="#">Contact</a>
      </div>

      <nav id="header-nav">
        <ul>
          <li>
            <button class="sidepanel-btn-open" onclick="openNav()">&#9776;</button>
          </li>
          <li>
            <a href="index.php" class="header-nav-item">
              Home
            </a>
          </li>

          <?php if (isset($user)): ?>
          <li>
            <a href="account.php" class="header-nav-item">
              Profile
            </a>
          </li>

          <li>
            <a href="logout.php" class="header-nav-item">
              Logout
            </a>
          </li>

          <?php else: ?>
          <li>
            <a href="login.php" class="header-nav-item">
              Login
            </a>
          </li>

          <li>
            <a href="register.html" class="header-nav-item">
              Register
            </a>
          </li>
          <?php endif; ?>

          <li>
            <a href="#" class="header-nav-item">
              Contact
            </a>
          </li>
        </ul>
      </nav>
    </header>

    <main id="main">
      <?php if (isset($user)): ?>
      <section>
        <div class="content-box">
          <h1>Hello, <?= $user["name"] ?>!</h1>
        </div>

        <div class="content-box">
          <h3>Bookings - <span id="week-number"></span></h3>
          <p>View available bookings below and book yourself an available time.</p>

          <div>
            <span id="week-first-date"></span>
            <span>-</span>
            <span id="week-last-date"></span>
          </div>

          <div>
            <button id="prev-week-btn" class="btn-primary">Previous Week</button>
            <button id="next-week-btn" class="btn-primary">Next Week</button>
          </div>

          <p id="bookings-table-info-text"></p>
      </section>

      <section id="wrapper-bookings-table">
        <table id="bookings-table">
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
              <td>08:00-09:00</td>
              <td class="booking-slot" id="slot1"></td>
              <td class="booking-slot" id="slot2"></td>
              <td class="booking-slot" id="slot3"></td>
              <td class="booking-slot" id="slot4"></td>
              <td class="booking-slot" id="slot5"></td>
              <td class="booking-slot" id="slot6"></td>
              <td class="booking-slot" id="slot7"></td>
            </tr>

            <tr>
              <td>09:00-10:00</td>
              <td class="booking-slot" id="slot8"></td>
              <td class="booking-slot" id="slot9"></td>
              <td class="booking-slot" id="slot10"></td>
              <td class="booking-slot" id="slot11"></td>
              <td class="booking-slot" id="slot12"></td>
              <td class="booking-slot" id="slot13"></td>
              <td class="booking-slot" id="slot14"></td>
            </tr>

            <tr>
              <td>10:00-11:00</td>
              <td class="booking-slot" id="slot15"></td>
              <td class="booking-slot" id="slot16"></td>
              <td class="booking-slot" id="slot17"></td>
              <td class="booking-slot" id="slot18"></td>
              <td class="booking-slot" id="slot19"></td>
              <td class="booking-slot" id="slot20"></td>
              <td class="booking-slot" id="slot21"></td>
            </tr>

            <tr>
              <td>11:00-12:00</td>
              <td class="booking-slot" id="slot22"></td>
              <td class="booking-slot" id="slot23"></td>
              <td class="booking-slot" id="slot24"></td>
              <td class="booking-slot" id="slot25"></td>
              <td class="booking-slot" id="slot26"></td>
              <td class="booking-slot" id="slot27"></td>
              <td class="booking-slot" id="slot28"></td>
            </tr>

            <tr>
              <td>12:00-13:00</td>
              <td class="booking-slot" id="slot29"></td>
              <td class="booking-slot" id="slot30"></td>
              <td class="booking-slot" id="slot31"></td>
              <td class="booking-slot" id="slot32"></td>
              <td class="booking-slot" id="slot33"></td>
              <td class="booking-slot" id="slot34"></td>
              <td class="booking-slot" id="slot35"></td>
            </tr>

            <tr>
              <td>13:00-14:00</td>
              <td class="booking-slot" id="slot36"></td>
              <td class="booking-slot" id="slot37"></td>
              <td class="booking-slot" id="slot38"></td>
              <td class="booking-slot" id="slot39"></td>
              <td class="booking-slot" id="slot40"></td>
              <td class="booking-slot" id="slot41"></td>
              <td class="booking-slot" id="slot42"></td>
            </tr>

            <tr>
              <td>14:00-15:00</td>
              <td class="booking-slot" id="slot43"></td>
              <td class="booking-slot" id="slot44"></td>
              <td class="booking-slot" id="slot45"></td>
              <td class="booking-slot" id="slot46"></td>
              <td class="booking-slot" id="slot47"></td>
              <td class="booking-slot" id="slot48"></td>
              <td class="booking-slot" id="slot49"></td>
            </tr>

            <tr>
              <td>15:00-16:00</td>
              <td class="booking-slot" id="slot50"></td>
              <td class="booking-slot" id="slot51"></td>
              <td class="booking-slot" id="slot52"></td>
              <td class="booking-slot" id="slot53"></td>
              <td class="booking-slot" id="slot54"></td>
              <td class="booking-slot" id="slot55"></td>
              <td class="booking-slot" id="slot56"></td>
            </tr>

            <tr>
              <td>16:00-17:00</td>
              <td class="booking-slot" id="slot57"></td>
              <td class="booking-slot" id="slot58"></td>
              <td class="booking-slot" id="slot59"></td>
              <td class="booking-slot" id="slot60"></td>
              <td class="booking-slot" id="slot61"></td>
              <td class="booking-slot" id="slot62"></td>
              <td class="booking-slot" id="slot63"></td>
            </tr>

            <tr>
              <td>17:00-18:00</td>
              <td class="booking-slot" id="slot64"></td>
              <td class="booking-slot" id="slot65"></td>
              <td class="booking-slot" id="slot66"></td>
              <td class="booking-slot" id="slot67"></td>
              <td class="booking-slot" id="slot68"></td>
              <td class="booking-slot" id="slot69"></td>
              <td class="booking-slot" id="slot70"></td>
            </tr>

            <tr>
              <td>18:00-19:00</td>
              <td class="booking-slot" id="slot71"></td>
              <td class="booking-slot" id="slot72"></td>
              <td class="booking-slot" id="slot73"></td>
              <td class="booking-slot" id="slot74"></td>
              <td class="booking-slot" id="slot75"></td>
              <td class="booking-slot" id="slot76"></td>
              <td class="booking-slot" id="slot77"></td>
            </tr>

            <tr>
              <td>19:00-20:00</td>
              <td class="booking-slot" id="slot78"></td>
              <td class="booking-slot" id="slot79"></td>
              <td class="booking-slot" id="slot80"></td>
              <td class="booking-slot" id="slot81"></td>
              <td class="booking-slot" id="slot82"></td>
              <td class="booking-slot" id="slot83"></td>
              <td class="booking-slot" id="slot84"></td>
            </tr>

            <tr>
              <td>20:00-21:00</td>
              <td class="booking-slot" id="slot85"></td>
              <td class="booking-slot" id="slot86"></td>
              <td class="booking-slot" id="slot87"></td>
              <td class="booking-slot" id="slot88"></td>
              <td class="booking-slot" id="slot89"></td>
              <td class="booking-slot" id="slot90"></td>
              <td class="booking-slot" id="slot91"></td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="booking-details" class="content-box">
        <h3>Booking Details</h3>
        <form id="booking-details-form" method="post">
          <div>
            <label>Day</label>
            <input id="booking-details-day" disabled />
          </div>
          <div>
            <label>Time</label>
            <input id="booking-details-time" disabled />
          </div>
          <button id="booking-details-button" disabled>Book Selected</button>
        </form>
      </section>

      <?php else: ?>
      <div class="content-box">
        <h2>Login Required</h2>

        <p>You must be logged in to use this service.</p>

        <p>Please <a href="./login.php">login</a> or <a href="./register.html">register.</a></p>
      </div>

      <?php endif; ?>
      </section>
    </main>

    <footer id="footer">
      <div class="container">
        <ul class="footer-left">
          <li><strong>Booking Service - a Simple PHP Learning Project (2026)</strong></li>
          <li><i>by Stefano Confalone</i></li>
        </ul>

        <ul class="footer-right">
          <li><a href="privacy-policy.php">Privacy Policy</a></li>
          <li><a href="terms-of-service.php">Terms of Service</a></li>
        </ul>
      </div>
    </footer>
  </div>

  <script>
    <?php if (isset($user)): ?>

    const
      userId = <?=  json_encode($_SESSION["user_id"]) ?> ;
    localStorage.setItem("userId", userId)

    <?php endif; ?>
  </script>
  <script type="text/javascript" src="./script.js"></script>
</body>

</html>