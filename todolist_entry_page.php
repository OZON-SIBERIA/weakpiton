<?php
function force_exit($msg) {
    echo $msg;
    die();
}
$connection = new mysqli("127.0.0.1", "root", "122435606", "todolist_database");
if ($connection->connect_errno) {
    force_exit("Database Error" . $connection->connect_error);
}
$connection->set_charset('utf8');
if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $insertion = $connection->query("INSERT INTO tasks (task) VALUES ('$task')");
    mysqli_close('$connection');
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
    <h2> Old Todolist for old pitons</h2>
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
    <tr>
        <td class="id"> 1 </td>
        <td class = "task"> Placeholder </td>
        <td class= "delete"> <a href="#">x</a></td>
    </tr>
    </tbody>
</table>
</body>
</html>