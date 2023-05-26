<?php

require('../database/dbconnect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script/script.js" defer></script>
    <title>contact</title>
    <style>
        #rotate-img {
            transform: rotate(135deg);
            width: 90%;
        }
    </style>
</head>

<body>
    <header>
        <?php require_once('../components/navbar.php'); ?>
    </header>
    <p></p>
    <div class="kaartje d-flex justify-content-center flex-row flex-wrap p-md d-grid gap-3 text-center kaartje">
        <p></p>
        <div class="kaartje d-flex justify-content-between align-items-center flex-wrap border border-secondary rounded kaartje flex-grow-1 flex-column" style="width: 300px; background-color: #8CA0A9;">
            <img src="../images/satelliet.png" class="kaartje card-img-top kaartje" alt="telefoon_foto" id="rotate-img">
            <p></p>
            <h1></h1>
            <p></p>
            <h1></h1>
            <div class="kaartje card-body">
                <h5 class="kaartje card-title">telefoonnummer</h5>
                <p class="kaartje card-text">bedrijf: 072 547 6600</p>
                <a href="tel:+3113181318" class="kaartje btn btn-primary">call</a>
            </div>
        </div>
        <p></p>
        <div class="kaartje d-flex justify-content-end align-items-end flex-wrap border border-secondary rounded flex-grow-1" style="width: 300px; background-color: #8CA0A9;">
            <img src="../images/spaceship.png" class="kaartje card-img-top" alt="email_foto">
            <div class="kaartje card-body">
                <h5 class="kaartje card-title">Direct contact</h5>
                <p class="kaartje card-text">Contact directly on the site!
                </p>
                <a onclick="contact()" class="kaartje btn btn-primary">Contact directly</a>
            </div>
        </div>
        <p></p>
        <div class="kaartje d-flex justify-content-end align-items-end flex-wrap border border-secondary rounded kaartje flex-grow-1" style="width: 300px; background-color: #8CA0A9;">
            <img src="../images/spacerock.png" class="kaartje card-img-top" alt="Locatie_foto">
            <div class="kaartje card-body">
                <h5 class="kaartje card-title">Locatie</h5>
                <p class="kaartje card-text">Adres: Kruseman Van Eltenweg 4, 1817 Bc Alkmaar.</p>
                <a href="https://www.bing.com/maps?q=horizon+college+alkmaar&FORM=HDRSC7&cp=52.637218%7E4.744406&lvl=15.7" class="kaartje btn btn-primary">see on a map</a>
            </div>
        </div>
        <p></p>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {
        // Prepare the SQL statement
        $sql = "INSERT INTO contactbericht SET
        title = :title,
        email = :email,
        message = :message";
    
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':message', $_POST['message']);
    
        if ($stmt->execute()) {
            exit();
        } else {
            echo "Error inserting record: " . $stmt->errorInfo()[2];
        }
    }
    
?>
    <form hidden method="post" class="d-flex flex-column justify-content-center align-items-center contat">
        <a hidden class="contat signup" href="contact.php">Back</a>
        <h2 hidden class="contat"><label for="title">Title</label></h2>
        <input hidden class="contat" type="text" name="title" class="w-25 p-2 m-2">
        <h2 hidden class="contat"><label for="title">Email</label></h2>
        <input hidden class="contat" type="email" name="email" class="w-25 p-2 m-2">
        <h2 hidden class="contat"><label for="title">Message</label></h2>
        <textarea hidden class="contat" name="message" cols="30" rows="10 p-2 m-2"></textarea>
        <p hidden class="contat"></p>
        <button hidden class="contat" type="submit">Send</button>
    </form>

    <?php

    require_once('../components/footer.php');

    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="/script/script.js"></script>
</body>

</html>