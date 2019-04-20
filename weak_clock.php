<?php/*
if (!empty($_POST("time_set")) & !empty($_POST("score_set"))) {
    $time
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weak Clock</title>
    <link rel="stylesheet" type="text/css" href="style_clock.css">
</head>
<body>
<script type="text/javascript" src="jquery-3.4.0.js">
</script>
    <form method="post" action="weak_clock.php" class="input_form">
        <input type="datetime-local" name="time_set" class="time_input">
        <button type="submit"  name="submit_time" id="set_time_button">Set Time</button>
        <input type="datetime-local" name="score_set" class="score_input">
        <button type="submit"  name="submit_score" id="set_score_button" >Set Score</button>
    </form>
</body>