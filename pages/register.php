<?php

require_once('../database/dbconnect.php');

if (isset($_SESSION['LoggedInUser'])) {
    header('location: ../');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<style>
    html,
    body {
        height: 100%;
        width: 100%;
    }
</style>

<body>
    <header>
        <?php
        require_once('../components/navbarlogin.php');
        ?>
    </header>
    <div class="wrapper">
        <h2 class="text-center mt-3 p-0 m-0">Sign up!</h2>
        <form method="post" enctype="multipart/form-data" class="d-flex flex-wrap justify-content-center flex-row text-center align-items-end">

            <div class="d-flex flex-column m-5 justify-content-center align-items-center">
                <h2>
                    <h2><label for="firstname">Firstname</label></h2>
                </h2>
                <input class="w-100 p-4 m-2" required name="firstname" type="text">
                <h2><label for="lastname">Lastname</label></h2>
                <input class="w-100 p-4 m-2" required name="lastname" type="text">
                <h2><label for="dateofbirth">Date of birth</label></h2>
                <input class="w-100 p-4 m-2" required name="dateofbirth" type="date">

            </div>
            <div class="d-flex flex-column m-5 justify-content-center align-items-center">
                <h2><label for="tel">Phone Number</label></h2>
                <input class="w-100 p-4 m-2" type="tel" name="phone">
                <h2><label for="email">Email</label></h2>
                <input class="w-100 p-4 m-2" required type="email" name="email">
                <h2><label for="password">Password</label></h2>
                <input class="w-100 p-4 m-2" required type="password" name="password">
            </div>
            <div class="d-flex flex-column m-5 justify-content-center align-items-center">
                <h2><button class="p-3 m-2" type="submit">Signup</button></h2>
                <h2><label for="pfp">Profile picture</label></h2>

                <div class="image-upload uploadbutton">
                    <label for="file-input">
                        <img class="w-100" src="/images/person.png">
                    </label>
                    <input name="pfp" accept="image/*" id="file-input" type="file">
                    <?php if (isset($_SESSION['Error348902852'])) {
                        echo "<p class='text-danger'>{$_SESSION['Error348902852']}</p>";
                    } ?>
                </div>
            </div>


        </form>
    </div>
    <p style="height: 4.25%"></p>


    <?php
    require_once('../components/footer.php');
    if (isset($_POST['firstname']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['dateofbirth'])) {


        $check = "SELECT * FROM gebruikers where email = :email";
        $stmtcheck = $pdo->prepare($check);
        $stmtcheck->execute([
            'email' => $_POST['email']
        ]);
        $result = $stmtcheck->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['Error348902852'] = "Email already exists.";
            header('Refresh: 0');
            exit();
        }

        if (strtotime($_POST['dateofbirth']) === false) {
            $_SESSION['Error348902852'] = "Invalid date of birth";
            header('Refresh: 0');
            exit();
        }

        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['Error348902852'] = "Invalid email";
            header('Refresh: 0');
            exit();
        }
        $password = trim($_POST['password']);
        if (strlen($password) < 6) {
            $_SESSION['Error348902852'] = "Your password must be at least 6 characters long";
            header('Refresh: 0');
            exit();
        }

        if (basename($_FILES['pfp']['name']) !== '') {
            $randomname = rand(0, 2147483647);
            $uploaddir = "../images/uploads/";
            $uploaded_file = $randomname . basename($_FILES['pfp']['name']);

            $target_file = $uploaddir . $uploaded_file;

            if (move_uploaded_file($_FILES['pfp']['tmp_name'], $target_file)) {
            } else {
            }
        } else {
            $uploaded_file = "person.png";
        }
        $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO gebruikers (firstname, lastname, phone, password, email, type, dateofbirth, picture)
        VALUES
        (:firstname, :lastname, :phone, :password, :email, :type, :dateofbirth, :picture)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'phone' => $_POST['phone'],
            'password' => $hashedpassword,
            'email' => $_POST['email'],
            'type' => "normal",
            'dateofbirth' => $_POST['dateofbirth'],
            'picture' => "/images/uploads/" . $uploaded_file
        ]);
        $_SESSION['Error348902852'] = "";
        echo ("<h1>Registered successfully</h1>");
        header('location: login.php');
        exit();
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>