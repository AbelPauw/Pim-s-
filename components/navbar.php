<nav class="primarycolor navbar navbar-dark navbar-expand-lg">
    <a class="navbar-brand" href="/"><img src="/images/logo.png" class="100%" style="max-width: 75px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-between text-center w-100">
            <li class="nav-item ml-auto">
                <a class="nav-link" href="/pages/about.php">About</a>
            </li>

            <li class="nav-item search-bar" style="width: 100%; max-width: 950px;">
                <form method="post">
                    <input class="bg-light" type="text" name="search" placeholder="Search" style="width: 100%; max-width: 500px;">
                </form>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/toevoegen.php">Add task</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/profile.php">Profile</a>
            </li>
            <?php
            if (isset($_SESSION['SessionType']) && $_SESSION['SessionType'] == "admin") {
                echo '<li class="nav-item">
                    <a class="nav-link" href="/pages/administrator.php">Admin</a>
                </li>';
            }
            ?>
            <li class="nav-item d-flex align-self-center">
                <a href="/pages/logout.php" style="text-decoration: none;" class="text-light border border-light p-1">Sign out</a>
            </li>
            <!-- <div class="collapse">
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="/pages/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/profile.php">Profile</a>
                </li>
            </div> -->
            <p></p>
        </ul>
    </div>
</nav>