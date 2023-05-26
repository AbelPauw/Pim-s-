<?php

require('../database/dbconnect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script/script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>about</title>
    <style>
        .tag-background-color {
            margin-top: 12px;
            background-color: #D9D9D9;
            margin-right: 50px;
            margin-left: 50px;
            border-radius: 7px;
        }

        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
    <header>
        <?php require_once('../components/navbar.php'); ?>
    </header>
    <div class="tag-background-color">
        <div class="d-flex justify-content-between">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-5">
                <div class="d-flex justify-content-start">
                    <p>pim(s)</p>
                </div>
                <div class="d-flex justify-content-center">
                    <p>
                        Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Et malesuada fames ac turpis egestas integer eget aliquet.
                        Tortor consequat id porta nibh venenatis cras sed felis.
                        Eu feugiat pretium nibh ipsum consequat nisl vel pretium.
                        Rhoncus aenean vel elit scelerisque mauris.
                        Malesuada proin libero nunc consequat interdum varius.
                        Scelerisque eu ultrices vitae auctor eu augue ut lectus arcu.
                        Vel facilisis volutpat est velit egestas dui.
                        Odio aenean sed adipiscing diam donec.
                        Sit amet massa vitae tortor condimentum lacinia.
                        Sapien eget mi proin sed libero enim.
                        Eget egestas purus viverra accumsan in nisl nisi scelerisque.
                        Cras adipiscing enim eu turpis egestas.
                        Faucibus et molestie ac feugiat sed lectus.
                        Elit sed vulputate mi sit amet mauris commodo.
                        Diam volutpat commodo sed egestas.
                        Nunc mattis enim ut tellus elementum sagittis vitae et.
                        Facilisis leo vel fringilla est ullamcorper eget.
                    </p>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <div class="d-flex justify-content-center">
                    <p></p>
                    <img src="../images/profiel-foto.png" alt="j" class="d-flex" width='125' height='125'>
                </div>
                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>
    <?php

    $gebruikers = $pdo->query('SELECT * FROM gebruikers');
    foreach ($gebruikers as $admins) {
        if ($admins['type'] == 'admin') {
            echo "<div class='tag-background-color'>";
            echo "<div class='d-flex bd-highlight'>";
            echo "<div class='p-2 w-100 bd-highlight'>";
            echo "<h1>";
            echo $admins['firstname'] . ' ' . $admins['lastname'];
            echo "</h1>";
            echo "<p>";
            echo $admins['info'];
            echo "</p>";
            echo "</div>";
            echo "<div class='p-2 flex-shrink-1 bd-highlight'><img src='{$admins['picture']}' alt='profiel-foto' class='object-fit-cover rounded-circle' width='125' height='125'></div>";
            echo "<p></p>";
            echo "</div>";
            echo "</div>";
        }
    }
    require_once('../components/footer.php');

    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>