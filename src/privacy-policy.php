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
        <article>
            <h1>Privacy Policy</h1>
            <p>Welcome to our Booking Service! This privacy policy outlines how we collect, use, and protect your
                personal information.</p>
            <!-- Add more content as needed -->

        </article>
    </main>

    <footer id="footer" class="page-footer">
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

    <script>
        <?php if (isset($user)): ?>

        const
            userId = <?=  json_encode($_SESSION["user_id"]) ?> ;

        localStorage.setItem("userId", userId)

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
            const
                userName = <?= json_encode($user["name"]) ?> ;
            userNameLinks[i].innerHTML = truncateString(userName, 8);
        }

        <?php endif; ?>
    </script>
    <script type="text/javascript" src="./script.js"></script>
</body>

</html>