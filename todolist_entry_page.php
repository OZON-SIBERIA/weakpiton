<!DOCTYPE html>
<html>
<head>
    <title>Old Todolist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="heading">
    <h2> Old Todolist for old pitons</h2>
</div>
<form method="post" action="todolist_entry_page.php" class="input_form">
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button">Add Task</button>
</form>
<table id="tasks_table" border="2" bgcolor="#f0ffff" rules="rows">
    <thead>
    <tr>
        <th>id</th>
        <th>Task</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td class = "task"></td>
        <td class= "delete">
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>