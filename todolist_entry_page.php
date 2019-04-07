<?php
    $errors = "";
    $db = mysqli_connect("localhost", "", "", "todolist_database");

    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "Empty field is not allowed";
        }
        else {
            $task = $_POST['task'];
            $sql = "INSERT INTO tasks (task) VALUES ('$task')";
            mysqli_query($db, $sql);
            header('location: todolist_entry_page.php');
        }
    }
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: todolist_entry_page.php');
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
    <h2 style="font-style: italic;"> Old Todolist for old pitons</h2>
</div>
<form method="post" action="todolist_entry_page.php" class="input_form">
    <?php if (isset($errors)) {
        ?>
    <p><?php echo $errors; ?></p>
    <?php
    }
    ?>
    <input type="text" name="task" class="task_input">
    <button type="submit"  name="submit" id="add_button" class="add_button">Add Task</button>
</form>

<table>
    <thead>
    <tr>
        <th>N</th>
        <th>tasks</th>
        <th style-"width: 60px;">Action</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $tasks = mysqli_query($db, "SELECT*FROM tasks");

    $i = 1; while ($row = mysqli_fetch_array($tasks)){
        ?>
    <tr>
    <td> <?php echo $i; ?> </td>
    <td class="task"> <?php echo $row['task']; ?> </td>
    <td class="delete">
        <a href="todolist_entry_page.php ?> del_task=<?php echo $row['id'] ?>">x</a>
    </td>
    </tr>
    <?php $i++; } ?>
    </tbody>
</table>
</body>
</html>

