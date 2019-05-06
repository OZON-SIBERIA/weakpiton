<?php
require_once "db_settings.php";
try {
    $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $msg) {
    echo $msg->getMessage();
}
$deletion = $DBH->prepare("DELETE FROM todolist_database.tasks2 WHERE id=:id");
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $deletion->bindParam(':id', $id, PDO::PARAM_INT);
    $deletion->execute();
    exit;
}