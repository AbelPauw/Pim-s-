<?php

ob_start();
require_once('../database/dbconnect.php');

if (!isset($_SESSION['LoggedInUser'])) {
    header('location: login.php');
    exit();
}
$query = "SELECT * FROM `gebruikers` WHERE id = '{$_SESSION['YourID']}'";
$stmt = $pdo->prepare($query);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Profile</title>

    <style>
        @media only screen and (max-width: 600px) {

            #links,
            #gege {
                width: 100%;
                background-color: #8CA0A9;
            }

            #leegte {
                margin: 0;
            }

            .upload-picture {
                width: 100%;
                margin: 0 auto;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        #links,
        #gege {
            background-color: #D9D9D9;
        }
    </style>



</head>

<body>

    <?php
    require_once '../components/navbar.php';
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="d-flex p-1 justify-content-evenly align-items-center flex-wrap custombanner">
            <img class="bannerimages flip" src="/images/meteor.png">
            <input type="file" accept="image/*" class="d-none" name="picture" id="picture">
            <label for="picture">
                <h2 class="d-flex bannerimages justify-content-center align-items-center"><?php echo "<img class='bannerimages object-fit-cover rounded-circle' src='{$result['picture']}'>" ?></h2>
            </label>
            <img class="bannerimages" src="/images/meteor.png">
        </div>
        <div class="container-sm">
            <div class="d-flex flex-row  justify-content-space-between">

                <div class="col-md-4" id="links">

                    <div class="col p-4">

                        <div class="p-3 d-flex justify-content-end">Your firstname: <input type="text" name="firstname" value="<?php echo $result['firstname'] ?>"></div>
                        <div class="p-3 d-flex justify-content-end">Your lastname: <input type="text" name="lastname" value="<?php echo $result['lastname'] ?>"></div>
                        <div class="p-3 d-flex justify-content-end">Your birthday: <input type="date" name="dateofbirth" value="<?php echo $result['dateofbirth'] ?>"></div>
                        <div class="p-3 d-flex justify-content-end">Your email: <input type="email" name="email" value="<?php echo $result['email'] ?>"></div>
                        <div class="p-3 d-flex justify-content-end">Your phone: <input type="text" name="phone" value="<?php echo $result['phone'] ?>"></div>
                        <div class="p-3 d-flex justify-content-end">Password: <input type="password" name="password"></div>
                        <div class="p-3 d-flex justify-content-end"><button value="1" name="update" type="submit">Update</button></div>
                    </div>
                </div>

                <div class="col-md-8 text-center d-flex flex-column  align-items-end flex-wrap" id="gege">
                    <h2>Bio</h2>
                    <textarea name="bio" cols="30" rows="10"><?php echo $result['info'] ?></textarea>
                </div>
    </form>
    </div>
    <p class="p-3"></p>
    </div>

    <?php

    require_once '../components/footer.php';

    if (isset($_FILES['picture']['name']) && !empty($_FILES['picture']['name'])) {
        $randomname = rand(0, 2147483647);
        $uploaddir = "../images/uploads/";
        $uploaded_file = $randomname . basename($_FILES['picture']['name']);

        $target_file = $uploaddir . $uploaded_file;

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
        } else {
        }
    } else {
        $uploaded_file = explode('/', $result['picture']);
    }

    if (isset($_POST['bio']) || isset($_POST['firstname'])) {
        if ($_POST['password'] !== '') {
            $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $hashedpassword = $result['password'];
        }
        if ($result['email'] !== $_POST['email']) {
            $querycheck = "SELECT * FROM `gebruikers` WHERE email = :email";
            $stmtcheck = $pdo->prepare($querycheck);
            $stmtcheck->execute([
                'email' => $_POST['email']
            ]);
            $resultcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
            if ($resultcheck['email'] == $_POST['email']) {
                echo ("<script>alert('Email already exists');</script>");
                exit();
            }
        }
        $query = "UPDATE gebruikers 
    SET 
    firstname = :firstname,
    lastname = :lastname,
    dateofbirth = :dateofbirth,
    email = :email,
    phone = :phone,
    info = :bio,
    password = :password,
    picture = :picture
    WHERE id = {$_SESSION['YourID']}
    ";
        $stmt = $pdo->prepare($query);
        if (is_array($uploaded_file)) {
            $stmt->execute([
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'dateofbirth' => $_POST['dateofbirth'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'bio' => $_POST['bio'],
                'password' => $hashedpassword,
                'picture' => "/images/uploads/" . $uploaded_file[3]
            ]);
        } else {
            if ($result['picture'] !== "/images/uploads/person.png") {
                unlink(".." . $result['picture']);
            }

            $stmt->execute([
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'dateofbirth' => $_POST['dateofbirth'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'bio' => $_POST['bio'],
                'password' => $hashedpassword,
                'picture' => "/images/uploads/" . $uploaded_file
            ]);
        }
        header('location: profile.php');
        exit();
    }
    ob_end_flush();

    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>