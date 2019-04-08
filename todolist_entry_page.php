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
    <?php
    $connection = mysqli_connect('localhost', 'root', '122435606', 'todolist_database', '3306', '1050');
    $query_gettasks = 'SELECT * FROM tasks';
    $query_delete = 'DELETE * FROM tasks';
    $errors = "";
    if(isset($_POST['submit'])) {
        if(empty($_POST['task'])) {
            $errors = "You must fill in the task";
        }
        else {
            $task = $_POST['task'];
            $query_insertion ="INSERT INTO tasks (task) VALUES ($task)";
            $insertion = mysqli_query($connection, $query_insertion);
            header('location: todolist_entry_page.php');
        }
    }
        if (isset($errors)) {
            ?>
    <p> <?php echo $errors; ?> </p>p>
    <?php
        }
    ?>
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
    <?php
        $tasks = mysqli_query($connection, $query_gettasks);
        $i =1;
        while($row = mysqli_fetch_array($tasks)) {
            ?>
    <tr>
        <td> <?php echo $i; ?> </td>
        <td class = "task"> <?php echo $row['task']; ?> </td>
        <td class= "delete">
            <a href="todolist_entry_page.php?del_task=<?php echo $row['id'] ?>">x</a>
        </td>
    </tr>
    <?php
    $i++;
        }
    ?>
    </tbody>
</table>
</body>
</html>

