<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src = "prototype.js"></script>
</head>
<body onload = "selection()">
<div class="heading">
    <h2> Old todolist for old pitons</h2>
</div>
<form class="input_form">
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button" onclick=insertion()>Add Task</button>
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
    $i = 1;
    foreach ($rows as $row) { ?>
        <tr>
            <td class="id"><?php echo $i; $i++; ?> </td>
            <td class="selection"> <?php echo htmlspecialchars($row['task'],ENT_QUOTES); ?> </td>
            <td class="delete" >
                <button title="Delete task" class="del_btn" onclick=deletion(<?php echo $row['id']; ?>)>X</button>
            </td>
        </tr> <?php } ?>
    </tbody>
</table>
<script>
    var del_id;
    function selection () {
        var sel_request = new XMLHttpRequest();
        sel_request.onreadystatechange = function() {
            if(sel_request.readyState === 4 && sel_request.status === 200) {
                console.log(sel_request.responseText);
                var data = JSON.parse(sel_request.responseText);
                console.log(data);
            }
        }
        sel_request.open('GET', 'selection.php');
        sel_request.send();
    }
    function insertion () {
        var task = document.getElementById("task");
        var ins_request = new XMLHttpRequest();
        ins_request.onreadystatechange = function() {
            if(ins_request.readyState === 4 && ins_request.status === 200) {
                console.log(ins_request.responseText);
                selection();
            }
        }
        ins_request.open('POST', 'insertion.php');
        ins_request.send(task);
    }
    function deletion (del_id) {
        var del_request = new XMLHttpRequest();
        del_request.onreadystatechange = function() {
            if(del_request.readyState === 4 && del_request.status === 200) {
                console.log(del_request.responseText);
                selection();
            }
        }
        del_request.open('GET', 'deletion.php?del_id=' + del_id);
        del_request.send();
    }
</script>
</body>
</html>
