<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/jpg" href="/favicon.jpg"/>
</head>
<body onload = "selection()">
<div class="heading">
    <h2> Old todolist for old pitons</h2>
</div>
<form id = "form" class="input_form" method="post" action="insertion.php">
    <input id = "task" type="text" name="task" class="task_input" placeholder="Would you kindly, add the task">
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
    <tbody id="data"> </tbody>
</table>
<script>
    function selection () {
        var sel_request = new XMLHttpRequest();
        sel_request.open('GET', 'selection.php', true);
        sel_request.send();
        sel_request.onreadystatechange = function() {
            if(sel_request.readyState === 4 && sel_request.status === 200) {
                console.log("ТРИ ВЯЛЫХ ПИТОНА");
                console.log(sel_request.responseText);
                var data = JSON.parse(sel_request.responseText);
                var html = "";
                var i = 1;
                for (var a = 0; a < data.length; a++) {
                    var task = data[a].task;
                    var id = data[a].id;
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
    function insertion (e) {
        e.preventDefault();
        var task = document.getElementById("task").value;
        document.getElementById("task").value = '';
        var params = "task="+task;
        var ins_request = new XMLHttpRequest();
        ins_request.onreadystatechange = function() {
            if(ins_request.readyState === 4 && ins_request.status === 200) {
                console.log("ПИТОН СОСТОЯЛСЯ");
                selection();
            }
        }
        ins_request.open('POST', 'insertion.php', true);
        ins_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ins_request.send(params);
    }
    function deletion (id) {
        var del_request = new XMLHttpRequest();
        del_request.onreadystatechange = function() {
            if(del_request.readyState === 4 && del_request.status === 200) {
                console.log("МИНУС ПИТОН");
                selection();
            }
        }
        del_request.open('GET', 'deletion.php?id=' + id, true);
        del_request.send();
    }
    var form = document.getElementById("form");
    form.addEventListener('submit', insertion);

</script>
</body>
</html>
