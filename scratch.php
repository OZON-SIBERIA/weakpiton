<html>
<center>
    <img src="https://cs8.pikabu.ru/images/big_size_comm/2016-04_4/146080718119713034.jpg" alt="Сорри, питон">
    </br>
    <?php
    $current_timezone = new DateTimeZone("Asia/Vladivostok");

    $a = new DateTime("now", $current_timezone);
    $morning = new DateTime("5:00:00", $current_timezone);
    $dinner = new DateTime("12:00:00", $current_timezone);
    $evening = new DateTime("18:00:00", $current_timezone);
    $night = new DateTime("23:59:59", $current_timezone);
    if($morning<=$a && $a<=$dinner) {
        echo("доброе утро, питон");
    } elseif ($dinner<$a && $a<=$evening){
        echo("добрый день, питон");
    } elseif($evening<$a && $a<=$night) {
        echo ("добрый вечер, питон");
    } else {
        echo("доброй ночи, питон");
    }
    ?>
</center>
</html>



