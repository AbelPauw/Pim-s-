<?php

require_once '../database/dbconnect.php';

if (!isset($_SESSION['YourID'])) {
    header('location: login.php');
    exit();
}

$id = $_SESSION['details'];
$userid = $_SESSION['YourID'];

$movie_query = "SELECT * FROM opdrachten WHERE id = :id";
$movie_statement = $pdo->prepare($movie_query);
$movie_statement->bindParam(':id', $_SESSION['details']);
$movie_statement->execute();
$row = $movie_statement->fetch(PDO::FETCH_ASSOC);

$queryopdracht = "SELECT * FROM opdrachten WHERE id = :id";
$query_statement = $pdo->prepare($queryopdracht);
$query_statement->bindParam(':id', $_SESSION['details']);
$query_statement->execute();
$lol = $query_statement->fetch(PDO::FETCH_ASSOC);

$queryid = "SELECT * FROM gebruikers WHERE id = :id";
$query_id = $pdo->prepare($queryid);
$query_id->bindParam(':id', $lol['userid']);
$query_id->execute();
$creater = $query_id->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['deletetask'])) {
    $deletequery = "DELETE FROM opdrachten WHERE id = :id";
    $deletestmt = $pdo->prepare($deletequery);
    $deletestmt->execute([
        'id' => $row['id']
    ]);
    header('location: ../');
}

if (isset($_POST['archivetask'])) {
    $archivequery = "UPDATE opdrachten SET archive = :kaas WHERE id = :id";
    $archivestmt = $pdo->prepare($archivequery);
    $archivestmt->execute([
        'id' => $row['id'],
        'kaas' => 1
    ]);
    header('location: ../');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>details</title>
</head>

<body>
    <?php

    include '../components/navbar.php';

    ?>

    <form method="post">
        <div class="container-sm">
            <div class="secondarycolor row align-items-start">
                <?php
                if ($row['archive'] == 1) {
                    echo "<h1 class='text-center'>This task has been archived</h1>";
                }
                ?>
                <div class="col">
                    <div class="signup dropdown m-5" id="dropdown">

                        <h1>Title</h1>
                        <p><?php

                            echo "<tr><td>" . $row["title"];
                            ?> </p>

                    </div>
                    <div class="signup m-5">
                        <h1>beschrijving</h1>

                        <p><?php echo "<tr><td>" . $row["description"];;
                            ?></p>
                    </div>
                </div>

                <div class="col" id="info">
                    <div class=" signup m-4">
                        <h1>time voor opdracht</h1>
                        <p><?php echo "<tr><td>" . $row["time"];;
                            ?></p>
                    </div>
                    <div class="signup m-4">
                        <h1>budget</h1>
                        <p><?php echo "<tr><td>" . $row["budget"];;
                            ?></p>
                    </div>
                    <div class="signup m-4">
                        <h1>type of task</h1>
                        <p><?php echo "<tr><td>" . $row["development"];;
                            ?></p>
                        </select>
                    </div>
                    <div class="signup m-4">
                        <h1>minimale eisen</h1>
                        <p><?php echo "<tr><td>" . $row["requirments"];;
                            ?></p>
                    </div>
                </div>
                


                <div class=" col">
                    <div>
                        <h2 class="d-flex bannerimages justify-content-center align-items-center"><?php echo "<img class='bannerimages object-fit-cover rounded-circle' src='{$creater['picture']}'>" ?></h2>
                    </div>



                    <div class="inputfields col">
                        <h1 class="m-2">customer info</h1>
                        <h1 class="m-2">
                            <p><?php echo "<tr><td>" . $creater["firstname"];;
                                ?></p>
                        </h1>
                        <h1 class="m-2">
                            <p><?php echo "<tr><td>" . $creater["lastname"];;
                                ?></p>
                        </h1>
                        <h1 class="m-2">
                            <p><?php echo "<tr><td>" . $creater["email"];;
                                ?></p>
                        </h1>
                        <h1 class="m-2">
                            <p><?php echo "<tr><td>" . $creater["phone"];;
                                ?></p>
                        </h1>
                    </div>
                </div>
    </form>

    <?php


if ($lol['userid'] == $userid && $row['archive'] !== 1) {
                    echo '<button class="btn btn-primary" name="deletetask">Delete task</button>
                    <p></p>
                    <button class="btn btn-primary" name="archivetask">Archive task</button><p></p>'
                    ;
                }
                
                
                ?>
                </div>
            </div>
        </div>
    </div>
    <p class="m-5"></p>
    <?php
    include('../components/footer.php');
    ?>
</body>

</html>