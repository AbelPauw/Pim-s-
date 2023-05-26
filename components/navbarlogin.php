<nav class="primarycolor navbar navbar-dark navbar-expand-lg">
    <a class="navbar-brand" href="/"><img src="/images/logo.png" class="100%" style="max-width: 75px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/pages/contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/about.php">About</a>
            </li>
            <?php
            if ($_SERVER['REQUEST_URI'] === '/pages/login.php') {
                echo '<li class="nav-item">
                <a class="signup nav-link" href="/pages/register.php">Sign up</a>
            </li>';
            } else {
                echo '<li class="nav-item">
                <a class="signup nav-link" href="/pages/login.php">Login</a>
            </li>';
            }
            ?>
        </ul>
    </div>
</nav>