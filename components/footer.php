<footer class="primarycolor d-flex justify-content-between flex-row p-3 align-items-center flex-wrap">
    <span>Copyright ©</span>
    <?php

    if (!isset($_SESSION['LoggedInUser'])) {
    } else {
        echo ("<span id='firstname' hidden>{$_SESSION['LoggedInUser']}</span>");
        echo ('<span id="time"></span>');
        echo ('<script src="/script/script.js"></script>');
    }
    ?>
</footer>
