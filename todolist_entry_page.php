<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "db_settings.php";
    try {
        $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $msg) {
        echo $msg->getMessage();
    }
    $insertion = $DBH->prepare("INSERT INTO todolist_database.tasks (task) VALUES (:task)");
    $selection = $DBH->prepare("SELECT task FROM todolist_database.tasks");
    /*$deletion = $DBH->prepare("DELETE");*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="heading">
    <h2> Old todolist for old pitons</h2>
</div>
<form method="post" action="todolist_entry_page.php" class="input_form">
    <?php
        if (isset($errors)) {
    ?> <p> <?php echo $errors; ?></p>
    <?php } ?>
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button">Add Task</button>
    <H><?php
        $task = $_POST["task"];
        if (!empty($task)) {
            $insertion->bindParam(':task', $task);
            $insertion->execute();
        }
    /*if (!empty($submit)) {
        if (empty($task)) {
            $input_error = "Would you kindly, enter the task";
            echo $input_error;
        }
        else {
            $insertion->bindParam(':task', $task);
            $insertion->execute();
        }
    }*/
    ?>
    </H>
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
    <?php
        /*$selection->execute();
        $i = 1;
        $row = $selection->fetchAll(PDO::FETCH_ASSOC);
        $rows = $DBH->query("SELECT * FROM todolist_database.tasks", PDO::FETCH_ASSOC)->fetchAll();*/

            $selection->execute();
            $rows = $selection->fetchAll(PDO::FETCH_ASSOC);
            $i = 1;
            /*var_dump($row);*/
            foreach ($rows as $row) { ?>
    <tr>    <td class="id"><?php echo $i; $i++; ?> </td>
            <td class="selection"> <?php echo $row['task']; ?> </td>
            <td class="delete"> <a>x</a> </td>
                <?php echo "<br/>"; ?>
    </tr> <?php } ?>
    </tbody>
</table>
</body>
</html>
