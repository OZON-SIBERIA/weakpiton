<?php
require_once "db_settings.php";
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

<div class="heading">
    <h2> Old todolist for old pitons</h2>
</div>
<form method="post" action="todolist_entry_page.php" class="input_form">
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button" onclick="insertion()">Add Task</button>
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
                <a title = "Delete task" class="del_btn" onclick="deletion(<?php echo $row['id']; ?>)">X</a>
            </td>
        </tr> <?php } ?>
    </tbody>
</table>
<script type="text/javascript" src="jquery-3.4.0.js">
    function insertion () {
        var task = document.getElementById("task");
        var ins_request = new XMLHttpRequest();
        ins_request.onreadystatechange = function() {
            if(ins_request.readyState === 4 && ins_request.status === 200) {
                ins_request.responseText;
            }
            ins_request.open('POST', 'insertion.php');
            ins_request.send(task);
        }
    }
    var del_id;
    function deletion (del_id) {
        var del_request = new XMLHttpRequest();
        del_request.onreadystatechange = function() {
            if(del_request.readyState === 4 && del_request.status === 200) {
                del_request.responseText;
            }
            del_request.open('GET', 'deletion.php?del_id=' + del_id);
            del_request.send();
        }
    }
</script>
</body>
</html>
