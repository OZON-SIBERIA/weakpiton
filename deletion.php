<?php
require_once "db_settings.php";
try {
    $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $msg) {
    echo $msg->getMessage();
}
$deletion = $DBH->prepare("DELETE FROM todolist_database.tasks WHERE id=:del_id");
if (!empty($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $deletion->bindParam(':del_id', $del_id, PDO::PARAM_INT);
    $deletion->execute();
    /*header("Location: /todolist_entry_page.php");*/
    exit;
}