<?php
require_once "db_settings.php";
require_once "todolist_entry_page.php";
try {
    $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $msg) {
    echo $msg->getMessage();
}
$insertion = $DBH->prepare("INSERT INTO todolist_database.tasks (task) VALUES (:task)");
if (!empty($_POST["task"])) {
    $task = htmlspecialchars($_POST["task"],ENT_QUOTES);
    $insertion->bindParam(':task', $task);
    $insertion->execute();
    exit;
}