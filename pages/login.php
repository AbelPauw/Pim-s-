<?php

require_once('../database/dbconnect.php');

if (isset($_SESSION['LoggedInUser'])) {
    header('location: ../');
    exit();
}

if (isset($_POST['email']) && (isset($_POST['password']))) {
    $query = "SELECT * FROM gebruikers WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'email' => $_POST['email']
    ]);
    if (!FILTER_VAR($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['Error'] = ("Email is not correctly formatted");
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && password_verify($_POST['password'], $result['password'])) {
        $_SESSION['email'] = $result['email'];
        $_SESSION['SessionType'] = $result['type'];
        $_SESSION['LoggedInUser'] = $result['firstname'];
        $_SESSION['YourID'] = $result['id'];
        $_SESSION['Error'] = "";
        header('location: ../');
        exit();
    } else {
        $_SESSION['Error'] = "Incorrect Email or password";
    }
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
    <title>Login</title>
</head>

<style>
    html,
    body {
        height: 100%;
        width: 100%;
    }
</style>

<body>
    <?php
    require_once('../components/navbarlogin.php');
    ?>

    <p class="m-3 p-3"></p>
    <form method="post" class="d-flex justify-content-center flex-column align-items-center" style="height: 50%;">
        
        <h2><label for="email">Email</label></h2>
        <input class="w-40 p-4 m-2" name="email" type="text" required>
        <h2><label for="password">Password</label></h2>
        <input class="w-40 p-4 m-2" type="password" name="password" required>
        <p class="p-2"></p>
        <h2><button class="p-4 m-2" type="submit">Confirm Login</button></h2>
        <p></p>
        <?php if (isset($_SESSION['Error'])) {
            echo "<h2 class='text-center text-danger'>{$_SESSION['Error']}</h2>";
            // echo "<p></p>";
        } ?>

    </form>
    
    <p style="height: 21.5%;"></p>
    <div class="d-flex align-self-end">
        <?php require_once('../components/footer.php');

        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




</body>

</html>