<?php

require '../database/dbconnect.php';

if (!isset($_SESSION['LoggedInUser'])) {
    header('location: login.php');
    exit();
} else {
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['time']) && !empty($_POST['budget']) && !empty($_POST['requirments'])) {
        $addtaskquery = "INSERT INTO opdrachten (description, time, budget, title, html_css, php, javascript, sqls, csharp, cplusplus, python, java, requirments, database_skills, bootstrap, archive, development, userid) VALUES
    (
        :description,
        :time,
        :budget,
        :title,
        :html_css,
        :php,
        :javascript,
        :sqls,
        :csharp,
        :cplusplus,
        :python,
        :java,
        :requirments,
        :database_skills,
        :bootstrap,
        :archive,
        :development,
        :userid
    );
    ";
        $addstmt = $pdo->prepare($addtaskquery);
        $addstmt->execute([
            'description' => $_POST['description'],
            'time' => $_POST['time'],
            'budget' => $_POST['budget'],
            'title' => $_POST['title'],
            'html_css' => $_POST['html_css'],
            'php' => $_POST['php'],
            'javascript' => $_POST['javascipt'],
            'sqls' => $_POST['sqls'],
            'csharp' => $_POST['csharp'],
            'cplusplus' => $_POST['cplusplus'],
            'python' => $_POST['python'],
            'java' => $_POST['java'],
            'requirments' => $_POST['requirments'],
            'database_skills' => $_POST['database_skills'],
            'bootstrap' => $_POST['bootstrap'],
            'archive' => 0,
            'development' => $_POST['development'],
            'userid' => $_SESSION['YourID']
        ]);
        $_SESSION['Error'] = "";
        header('location: ../');
        exit();
    } else {
        $_SESSION['Error'] = "Error: Please input all data";
        header('location: toevoegen.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>opdacht toevoegen</title>

</head>

<body>
    <?php
    include '../components/navbar.php';
    ?>
    <form method="post">
        <div class="customcolor">
            <div class="row" style="justify-content: center;">
                <?php if (isset($_SESSION['Error'])) {
                    echo $_SESSION['Error'];
                } ?>
                <div class="m-5" id="dropdown" style="width: 20%; text-align:center;">
                    <h1>Title</h1>
                    <input type="text" name="title" class="inputfields" class="m-t 2" style="height: 50%;">
                </div>
            </div>
        </div>
        <div class="secondarycolor row align-items-start h-100">
            <div class="col">
                <?php if (isset($_SESSION['Error'])) {
                    echo $_SESSION['Error'];
                } ?>
                <div class="m-5" style="text-align: center;">
                    <h1>description</h1>

                    <textarea name="description" class="inputfields" rows="10" cols="40"></textarea>
                </div>
                <div class="m-4" style="text-align: center;">
                    <h1>minimal requirements</h1>
                    <textarea style="width: 72%;" class="inputfields" name="requirments" rows="10" cols="50"></textarea>
                </div>
            </div>

            <div class="col" id="info" style="display:flex; flex-direction:column; justify-content:space-around; margin-top: 1.6%;">
                <div class="m-4" style="text-align: center;">
                    <h1>time for task</h1>
                    <input type="date" class="inputfields" name="time" style="height: 50px; width: 100%;">
                </div>
                <div class="m-4" style="text-align: center;">
                    <h1>budget</h1>
                    <input type="number" class="inputfields" name="budget" id="budget" style="height: 50px; width: 100%;">
                </div>
                <div class="m-4" style="text-align: center;">
                    <h1>type of task</h1>
                    <select class="inputfields" name="development" style="height: 50px; width: 100%;">
                        <option value="front-end development">front-end development</option>
                        <option value="back-end development">back-end development</option>
                        <option value="full-stack development">full-stack development</option>
                        <option value="app development">app development</option>
                        <option value="website development">website development</option>
                        <option value="webshop development">webshop development</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center align-items-center" style="height: 50px;">
                    <button style="padding:3%; text-align:center; width: 91%;" type="submit" value="Update" name="submit" id="hermansubmit">submit</button>
                </div>
            </div>
            <div class="col secondary-darkcolor" style="height: 800px">
                <div>
                    <h1>checklist</h1>
                    <table>
                        <tr id="check">
                            <td> <input type="checkbox" name="html_css" value="1"> html/css </td>
                            <td> <input type="checkbox" name="php" value="1"> php </td>
                            <td> <input type="checkbox" name="javascript" value="1"> javascript </td>
                        </tr>
                        <tr id="check">
                            <td> <input type="checkbox" name="sqls" value="1"> sql </td>
                            <td> <input type="checkbox" name="csharp" value="1"> c# </td>
                            <td> <input type="checkbox" name="cplusplus" value="1"> c++ </td>
                        </tr>
                        <tr id="check">
                            <td> <input type="checkbox" name="python" value="1"> python </td>
                            <td> <input type="checkbox" name="java" value="1"> java </td>
                            <td> <input type="checkbox" name="database_skills" value="1"> database skills </td>
                            <td> <input type="checkbox" name="bootstrap" value="1"> bootstrap </td>
                    </table>


                </div>
            </div>
        </div>
        <h1></h1>
    </form>
    <?php
    include('../components/footer.php');
    ?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>