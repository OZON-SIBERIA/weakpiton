<?php
require_once "db_settings.php";
require_once "insertion.php";
require_once "deletion.php";
try {
    $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $msg) {
    echo $msg->getMessage();
}
    $selection = $DBH->prepare("SELECT * FROM todolist_database.tasks");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<script type="text/javascript" src="jquery-3.4.0.js">
    function insertion() {
        var task = $('#task').val();
        $.ajax({
            type: "POST",
            url: 'insertion.php',
            data: {task:task}
        })
    }
    function deletion() {
        var del_id = $('#del_id').val();
        $.ajax({
            type: "GET",
            url: 'deletion.php',
            data: {del_id:del_id}
        })
    }
</script>
<div class="heading">
    <h2> Old todolist for old pitons</h2>
</div>
<form method="post" action="todolist_entry_page.php" class="input_form">
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button" onClick = "insertion()">Add Task</button>
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
                <a title = "Delete task" href = "todolist_entry_page.php?del_id=<?php echo $row['id']; ?>" class="del_btn" onClick = "deletion()">X</a>
            </td>
        </tr> <?php } ?>
    </tbody>
</table>
</body>
</html>
