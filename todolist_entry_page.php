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
    $selection = $DBH->prepare("SELECT * FROM todolist_database.tasks");
    $deletion = $DBH->prepare("DELETE FROM todolist_database.tasks WHERE (id)=(:id) LIMIT 1");

    if (!empty($_POST["task"])) {
        $task = $_POST["task"];
        $insertion->bindParam(':task', $task);
        $insertion->execute();
        header("Location: /todolist_entry_page.php");
        exit;
    }
    if (!empty($_POST["del_id"])) {
        $del_id = $_POST["del_id"];
        $deletion->bindParam(':id', $del_id);
        $deletion->execute();
    }
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
            $rows = $selection->fetchAll(PDO::FETCH_ASSOC);
            $i = 1;
        foreach ($rows as $row) { ?>
        <tr>
            <td class="id"><?php echo $i; $i++; ?> </td>
            <td class="selection"> <?php echo $row['task']; ?> </td>
            <td class="delete">
                <a href="todolist_entry_page.php?del_id=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
            </td>
            <input  name="del_id" type="hidden" value="<?=$row['id']; ?>" class="del_id">
            <?php echo "<br/>"; ?>
        </tr> <?php } ?>
    </tbody>
</table>
</body>
</html>
