<?php
require_once "db_settings.php";
try {
    $DBH = new PDO("mysql:$host;dbname=todolist_database", $user, $pass);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $msg) {
    echo $msg->getMessage();
}
$selection = $DBH->prepare("SELECT * FROM todolist_database.tasks2");
$selection->execute();
$rows = $selection->fetchAll(PDO::FETCH_ASSOC);
echo $rows;
