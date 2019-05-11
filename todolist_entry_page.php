<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload = "selection()">
<div class="heading">
    <h2> Old todolist for old pitons</h2>
</div>
<form class="input_form" method="post">
    <input id = "task" type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button" onclick="event.stopPropagation(); insertion(); ">Add Task</button>
</form>
<table id="tasks_table">
    <thead>
    <tr>
        <th>id</th>
        <th>Task</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody id="data"> </tbody>
</table>
<script>
    $("#form").submit(function(e) {e.preventDefault()};
    function selection () {
        var sel_request = new XMLHttpRequest();
        sel_request.open('GET', 'selection.php', true);
        sel_request.send();
        sel_request.onreadystatechange = function() {
            if(sel_request.readyState === 4 && sel_request.status === 200) {
                console.log(sel_request.responseText);
                var data = JSON.parse(sel_request.responseText);
                console.log(data);
                var html = "";
                var i = 1;
                for (var a = 0; a < data.length; a++) {
                    var task = data[a].task;
                    var id = data[a].id;
                    console.log(id);
                    html += "<tr>";
                    html += "<td class=\"id\">" + i + "</td>";
                    html += "<td class=\"selection\">" + task + "</td>";
                    html += "<td class=\"delete\" >" + "<button title=\"Delete task\" class=\"del_btn\" onclick=deletion(" + id + ")>" + "X" + "</button>" + "</td>";
                    html += "</tr>";
                    i++;
                }
                document.getElementById("data").innerHTML = html;
            }
        }
    }
    function insertion () {
        var task = document.getElementById("task").value;
        console.log(task);
        var ins_request = new XMLHttpRequest();
        ins_request.onreadystatechange = function() {
            if(ins_request.readyState === 4 && ins_request.status === 200) {
                console.log(ins_request.responseText);
                selection();
            }
        }
        ins_request.open('POST', 'insertion.php', true);
        ins_request.setRequestHeader("Content-Type", "application/json");
        ins_request.send(JSON.stringify({task:task}));
    }
    function deletion (id) {
        var del_request = new XMLHttpRequest();
        del_request.onreadystatechange = function() {
            if(del_request.readyState === 4 && del_request.status === 200) {
                console.log(id);
                console.log(del_request.responseText);
                selection();
            }
        }
        del_request.open('GET', 'deletion.php?id=' + id, true);
        del_request.send();
    }
</script>
</body>
</html>
