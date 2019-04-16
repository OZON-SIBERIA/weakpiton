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
    <?php
    if (!empty($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $input_error = "Would you kindly, enter the task";
        }
        else {
            $task = $_POST['task'];
            $insertion->execute(['task' => $task]);
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
    <tr> <td><?php echo $i; $i++; ?> </td>
            <td> <?php echo $row['task']; ?> </td>
            <td class="delete"> <a>x</a> </td>
                <?php echo "<br/>"; ?>
    </tr> <?php } ?>
    </tbody>
</table>
</body>
</html>
