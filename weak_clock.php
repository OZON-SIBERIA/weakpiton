<!DOCTYPE html>
<html>
<head>
    <title>Weak Clock</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<script type="text/javascript" src="jquery-3.4.0.js">
</script>
    <form method="post" action="weak_clock.php" class="input_form">
        <input type="time" name="time_set" class="time_input">
        <input type= "text" name="score_set" class="score_input">
        <button type="submit"  name="set" id="set_button">Set</button>
    </form>
</body>
<?php
$current_timezone = new DateTimeZone("Asia/Vladivostok");
$time = new DateTime('00:00:00', $current_timezone);
$time_end = new DateTime('00:00:00', $current_timezone);
if (!empty($_POST("time_set")) && !empty($_POST("score_set"))) {
    $time_set = $_POST("time_set");
    $time = new DateTime($time_set, $current_timezone);
    $score = $_POST("score_set");
    while ($time != $time_end) {
        $time->sub(new DateInterval('P1S'));
    }
}
?>