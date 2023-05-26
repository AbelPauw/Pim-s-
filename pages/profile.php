<?php

require_once('../database/dbconnect.php');
if (!isset($_SESSION['LoggedInUser'])) {
  header('location: login.php');
  exit();
}

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

      .upload-pfp {
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
  include '../components/navbar.php';

  $query = "SELECT * FROM `gebruikers` WHERE email = '{$_SESSION['email']}'";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  ?>
  <div class="d-flex p-1 justify-content-evenly align-items-center flex-wrap custombanner">
    <img class="bannerimages flip" src="/images/meteor.png">
    <h2 class="d-flex bannerimages justify-content-center align-items-center"><?php echo "<img class='bannerimages object-fit-cover rounded-circle' src='{$result['picture']}'>" ?></h2>
    <img class="bannerimages" src="/images/meteor.png">
  </div>
  <div class="container-sm">
    <div class="d-flex flex-row  justify-content-space-between">
      <div class="col-md-4" id="links">
        <div class="col p-4">
          <div class="p-3">Your firstname: <?php echo $result['firstname'] ?></div>
          <div class="p-3">Your lastname: <?php echo $result['lastname'] ?></div>
          <div class="p-3">Your birthday: <?php echo $result['dateofbirth'] ?></div>
          <div class="p-3">Your email: <?php echo $result['email'] ?></div>
          <div class="p-3">Your phone number: <?php echo $result['phone'] ?></div>
          <div class="p-3"><a class="signup" href="editprofile.php">Edit your profile</a></div>
        </div>
      </div>

      <div class="col-md-8 text-center d-flex flex-column  align-items-end flex-wrap " id="gege">
        <h2>Bio</h2>
        <textarea name="bio" cols="30" rows="10" readonly><?php echo $result['info'] ?></textarea>
      </div>
    </div>
    <p class="p-3"></p>
  </div>

  <?php
  include '../components/footer.php';
  ?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>