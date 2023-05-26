<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script/script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Admin panel</title>
    <style>
        .tag-background-color {
            margin-top: 12px;
            background-color: #D9D9D9;
            border-radius: 7px;
        }

        html,
        body {
            height: 100%;
        }

        .container {
            height: 100vh;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <?php
    require('../database/dbconnect.php');
    if ($_SESSION['SessionType'] !== "admin") {
        header('location: /');
    } else {
    ?>
        <?php

            if (isset($_POST['inspecteer'])) {
                $_SESSION['inspecteer'] = $_POST['inspecteer'];
                header('location: profile.php');
            }
        ?>


        <header>
            <?php require_once('../components/navbar.php'); ?>
        </header>
        <div class="d-flex flex-column">
            <form method="post">
                <div class="d-flex flex-row w-100">
                    <?php
                    if (isset($_SESSION['searchfirstname'])) {
                        $value = "value='{$_SESSION['searchfirstname']}'";
                    } else {
                        $value = "value=''";
                    }
                    ?>
                    <input type="text" id="search" <?= $value ?> name="searchfirstname" placeholder="Search for task:" class="bg-light text-dark p-2" style="width: 400%;">
                    <input type="submit">

                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <input type="radio" name="options" value="firstname" checked>
                                <p>firstname</p>
                            </div>
                            <div class="d-flex flex-row">
                                <input type="radio" name="options" value="lastname">
                                <p>lastname</p>
                            </div>
                            <div class="d-flex flex-row">
                                <input type="radio" name="options" value="email">
                                <p>email</p>
                            </div>
                            <div class="d-flex flex-row">
                                <input type="radio" name="options" value="phone">
                                <p>phone</p>
                            </div>
                            <div class="d-flex flex-row">
                                <input type="radio" name="options" value="id">
                                <p>id</p>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['searchfirstname'])) {
                        $_SESSION['searchfirstname'] = $_POST['searchfirstname'];
                        $_SESSION['options'] = $_POST['options'];
                    }

                    if (isset($_SESSION['searchfirstname']) && isset($_SESSION['options'])) {
                        $email = $_SESSION['options'];
                        $query = "SELECT * FROM gebruikers WHERE $email LIKE :searchfirstname";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([
                            "searchfirstname" => "%" . $_SESSION['searchfirstname'] . "%"
                        ]);
                        $gebruikers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        $query = "SELECT * FROM gebruikers";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $gebruikers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                    echo "<div class='container'>";
                    echo "<ul class='list-group'>";
                    foreach ($gebruikers as $admins) {
                        if ($admins['type'] == 'normal') {
                            echo "<li>";
                            echo "<div class='tag-background-color'>";
                            echo "<div class='d-flex bd-highlight'>";
                            echo "<div class='p-2 w-100 bd-highlight'>";
                            echo "<h1>";
                            echo $admins['firstname'] . ' ' . $admins['lastname'];
                            echo "</h1>";
                            echo "<p>";
                            echo $admins['info'];
                            echo "</p>";
                            echo "<p>";
                            echo  'email: ' . $admins['email'] . '. klant id: ' . $admins['id'];
                            echo "</p>";
                            echo "<p>";
                            echo  'klant telefoon nummer: ' . $admins['phone'] . '. klant geboorte datum: ' . $admins['dateofbirth'];
                            echo "</p>";
                            echo "</div>";
                            echo "<button type='submit' name='inspecteer' value=" . $admins['email'] . "'>inspecteer</button>";
                            echo "<div class='p-2 flex-shrink-1 bd-highlight'><img src='{$admins['picture']}' alt='profiel-foto' class='object-fit-cover rounded-circle' width='125' height='125'></div>";
                            echo "<p></p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</li>";
                        }
                    }
                    echo "</ul>";
                    echo "</div>";
                    ?>
                </div>
            </form>

            <?php
            require_once('../components/footer.php');

            ?>
            <p></p>
            <h1></h1>
            <p></p>
            <p></p>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php
    }
    ?>
</body>

</html>