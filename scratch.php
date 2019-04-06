<html>
<style>
    div {
        background: aqua;
    }
</style>
<center>
    <img src="https://cs8.pikabu.ru/images/big_size_comm/2016-04_4/146080718119713034.jpg" alt="Сорри, питон">
    </br>


    <?php
		if((date("5:0:0")) < (date("h:i:s")) and (date("h:i:s")) < (date("12:0:0"))) {echo("Доброе утро, питон");}
		elseif((date("12:0:0")) < (date("h:i:s")) and (date("h:i:s")) < (date("18:0:0"))) {echo("Добрый день, питон");}
		elseif((date("18:0:0")) < (date("h:i:s")) and (date("h:i:s")) < (date("23:0:0"))) {echo("Добрый вечер, питон");}

        echo "ЭТО ВАМ НЕ ЭТО<br/>";
        echo(date(" h:i:s "));
        echo (date(" d.F. Y "));
    ?>
</center>
</html>


dadwad

<?php
    $a = new DateTime();
    echo($a->format('c'));



?>