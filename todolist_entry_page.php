<?php
require_once "db_settings.php";
    try {
        $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES, false);
    }
    catch (PDOException $msg) {
        echo $msg->getMessage();
    }
    $insertion = $DBH->prepare("INSERT INTO todolist_database.tasks (task) VALUES (:task)");
    $selection = $DBH->prepare("SELECT * FROM todolist_database.tasks");
    $deletion = $DBH->prepare("DELETE FROM todolist_database.tasks WHERE id=:del_id");

    if (!empty($_POST["task"])) {
        $task = $_POST["task"];
        $insertion->bindParam(':task', $task);
        $insertion->execute();
        header("Location: /todolist_entry_page.php");
        exit;
    }
    if (!empty($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
        $deletion->bindParam(':del_id', $del_id, PDO::PARAM_INT);
        $deletion->execute();
        header("Location: /todolist_entry_page.php");
        exit;
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
            <td class="selection"> <?php echo htmlspecialchars($row['task'],ENT_QUOTES); ?> </td>
            <td class="delete">
                <a title = "Delete task" href = "todolist_entry_page.php?del_id=<?php echo $row['id']; ?>" class="del_btn">X</a>
            </td>
            <?php echo "<br/>"; ?>
        </tr> <?php } ?>
    </tbody>
</table>
</body>
</html>
