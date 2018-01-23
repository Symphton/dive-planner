<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">Diveplanner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <?php
        if (isset($_SESSION['email'])) { ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/event/event.php">Duiken</a>
                </li>
                <?php
                if (isAdmin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/carpool/carpool.php">Carpool</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/divesite/divesite.php">Duikplaatsen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/diveclub/diveclub.php">Duikclubs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/certificate/certificate.php">Certificaten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/federation/federation.php">Federaties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/user.php">Gebruikers</a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle" href="https://diveplanner.hoylaerts.be" id="profile"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="true"><?php print $_SESSION['firstname']; ?></a>
                    <div class="dropdown-menu" aria-labelledby="profile">
                        <a class="dropdown-item" href="/user/profile.php">Profiel</a>
                        <a class="dropdown-item" href="/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>