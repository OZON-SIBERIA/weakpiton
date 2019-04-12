<?php
require_once "db_settings.php";
    try {
        $DBH = new PDO("mysql:$host;dbname=$dbname", $user, $pass);
    }
    catch (PDOException $msg) {
        echo $msg->getMessage();
    }
    $STH = $DBH->prepare("INSERT INTO tasks (task) VALUES (:task)");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="heading">
    <h2> Old Todolist for old pitons</h2>
</div>
<form method="post" action="todolist_entry_page.php" class="input_form">
    <?php
        if (isset($errors)) {
    ?> <p> <?php echo $errors; ?></p>
    <?php ) ?>
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button">Add Task</button>
    <?php

    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $input_error = "Enter task, would you kindly";
        }
        else {
            $task = $_POST['task'];
            $STH->execute(':task => $task');
        }
    }
    ?>
</form>
<table id="tasks_table">
    <thead>
    <tr>
        <th>id</th>
        <th>Task</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="id"> 1 </td>
        <td class = "task"> Placeholder </td>
        <td class= "delete"> <a href="#">x</a></td>
    </tr>
    </tbody>
</table>
</body>
</html>