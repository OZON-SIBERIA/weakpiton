<?php
require_once "db_settings.php";
    try {
        $DBH = new PDO("mysql:$host;dbname=$dbname", $user, $pass);
    }
    catch (PDOException $msg) {
        echo $msg->getMessage();
    }
    $insertion = $DBH->prepare("INSERT INTO tasks (task) VALUES (:task)");
    $selection = $DBH->prepare("SELECT task FROM tasks");
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
    if (isset($_POST['submit'])) {
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
        $selection->execute();
        $i = 1;
        while($row = $selection->fetch(PDO::FETCH_ASSOC)) {
            var_dump($row);
        }
    ?>
    </tbody>
</table>
</body>
</html>