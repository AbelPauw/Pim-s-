<?php

require('database/dbconnect.php');

if (isset($_POST['details'])) {
    $_SESSION['details'] = $_POST['details'];
    header('location: pages/detail.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
        }

        input[type=checkbox] {
            width: 15px;
        }

        label {
            width: 50%;
        }

        .color {
            background-color: lightslategray;
            color: white;
        }
    </style>
</head>

<body>
    <div class="customcolor h-75 w-100">
        <div class="d-flex flex-row justify-content-between">
            <div class="d-flex flex-row">
                <img src="images/logo.png" class="align-self-start" style="max-width: 75px; margin: 1%;">
                <a href="pages/about.php" style="text-decoration: none; margin-left: 4%;" class="text-light p-2 align-self-center">About</a>
            </div>
            <div class="align-self-center flex-row" style="margin-right: 1.5%;">
                <div class="flex-row w-100">
                    <?php if (isset($_SESSION['LoggedInUser'])) {
                        echo '<a href="pages/toevoegen.php" style="text-decoration: none;" class="text-light p-2">Add task</a>
                    <a href="pages/contact.php" style="text-decoration: none;" class="text-light p-2">Contact</a>
                    <a href="pages/profile.php" style="text-decoration: none;" class="text-light p-2">Profile</a>';
                        if (isset($_SESSION['SessionType']) && $_SESSION['SessionType'] == "admin") {
                            echo '<a href="pages/administrator.php" style="text-decoration: none;" class="text-light p-2">Admin</a>';
                        }
                        echo '<a href="pages/logout.php" style="text-decoration: none;" class="text-light border border-light p-1">Sign out</a>';
                    } else {
                        echo '<a href="pages/contact.php" style="text-decoration: none;" class="text-light p-2">Contact</a>
                    <a href="pages/login.php" style="text-decoration: none;" class="text-light border border-light p-1">login</a>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="h-75 d-flex align-items-center justify-content-around">
            <div class="d-flex flex-column">
                <h1 class="align-self-around">Make or Take the BEST Software</h1>
                <form method="post">
                    <div class="d-flex flex-row w-100">
                        <input type="text" id="search" <?php if (isset($_SESSION['search'])) {
                                                            echo "value='{$_SESSION['search']}'";
                                                        } ?>name="search" placeholder="Search for task:" class="bg-light text-dark p-2" style="width: 400%;">
                </form>
                <?php
                if (isset($_POST['search'])) {
                    $_SESSION['search'] = $_POST['search'];
                    header('location: ./');
                    exit();
                }

                if (isset($_SESSION['search'])) {
                    $query = "SELECT * FROM opdrachten WHERE title LIKE :search";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([
                        "search" => "%" . $_SESSION['search'] . "%"
                    ]);
                    $resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $query = "SELECT * FROM opdrachten";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                ?>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
        <img src="images/ship-dip-flip.png" class="align-self-end" style="width: 30%;">
    </div>
    </div>
    <div class="d-flex flex-row h-100 w-100">
        <form method="post" class="w-100 h-100">
            <div class="d-flex flex-wrap w-100">

                <?php
                for ($i = 0; $i < count($resultaten); $i++) {
                    echo "<div class='opdrachtkaart w-25 secondarycolor'>";
                    echo "<div class='d-flex flex-column secondarycolor' style='padding-bottom: 5%; border-radius: 5%'>";
                    echo "<h4 class='p-4' style='margin-bottom: 5%;'><span>{$resultaten[$i]['title']}</span></h4>";
                    echo "<span class='p-2'>Type: {$resultaten[$i]['development']}</span>";
                    echo "<span class='p-2'>Budget: €{$resultaten[$i]['budget']},-</span>";
                    echo "</div>";
                    echo "<button name='details' value='{$resultaten[$i]['id']}' style='width: 100%; border-radius: 5%' class='btn btn-primary align-self-end'>Details</button>";
                    echo "</div>";
                }

                ?>

            </div>
        </form>
        <div class="filters secondarycolor d-flex justify-content-space-around flex-column h-100 w-25">
            <div class="p-3">
                <h1>Filters:</h1>
            </div>
            <div class="p-3">
                <div>
                    <input type="checkbox" id="web" name="web" value="web">
                    <label for="web"> Web</label>
                </div>
                <div>
                    <input type="checkbox" id="app" name="app" value="app">
                    <label for="app"> App</label>
                </div>
                <div>
                    <input type="checkbox" id="game" name="game" value="game">
                    <label for="game"> Game</label>
                </div>
                <div>
                    <input type="checkbox" id="other" name="other" value="other">
                    <label for="other"> Other</label>
                </div>
                <div>
                    <input type="checkbox" id="personal use" name="personal use" value="personal use">
                    <label for="personal use"> personal use</label>
                </div>
                <div>
                    <input type="checkbox" id="business use" name="business use" value="business use">
                    <label for="business use"> business use</label>
                </div>
                <div>
                    <input type="checkbox" id="public use" name="public use" value="public use">
                    <label for="public use"> public use</label>
                </div>
            </div>
            <div class="p-3">
                <input class="bg-light" type="number" id="min" name="min" placeholder="min 0">
                <label for="min"> Min budget</label>
            </div>
            <div class="p-3">
                <input class="bg-light" type="number" id="max" name="max" placeholder="max 1000">
                <label for="max"> Max budget</label>
            </div>
            <div class="p-3">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort By
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Rating</a>
                        <a class="dropdown-item" href="#">Budget high to low</a>
                        <a class="dropdown-item" href="#">Budget low to high</a>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    <?php require_once('components/footer.php'); ?>
    <script src="script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>