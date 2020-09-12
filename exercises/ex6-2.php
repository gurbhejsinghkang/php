<?php

function showTitle($title)
{
    echo "<h2>&#9830; $title</h2>";
    echo '<hr/>';
}

// reference https://www.php.net/manual/fr/function.date.php
// date formating https://www.php.net/manual/fr/datetime.format.php

showTitle('timezone specified in php.ini');
echo 'timezone:'.date_default_timezone_get();

showTitle('current timestamp, seconds since january 1st, 1970');
$t = time();
print_r($t);

showTitle('Create a timestamp for a given date 20h:25min:10s on 10 january 2019');
// 1st method with mktime
// 20h:25min:10s january-10-2019
$t = mktime(20, 25, 10, 1, 10, 2019);
echo $t.' with mktime(20, 25, 10, 1, 10, 2019)<br>';

//2nd method with strotime()
$t = strtotime('10 January 2019 20 hours 25 minutes 10 seconds');
echo $t.' with strtotime("10 January 2019")';

showTitle('Exercice 1 full date and time');
echo date(DATE_RFC2822, $t).'<br>';

showTitle('Exercice 2 Day only');
echo date('l', $t);

showTitle('Exercice 3 The Month only');
echo date('F', $t)."\n";

showTitle('Exercice 4 The Year only');
echo date('Y', $t)."\n";

showTitle('Exercice 5 Date displayed like 10,january,2019');
echo date('j\,F\,Y', $t)."\n";

showTitle('Exercice 6 Add 1 month and full display');
echo date('j F Y', strtotime('+ 1 month', $t))."\n";

showTitle('Exercice 7 Number of days since 31 décembre 1973');
$datetime1 = date_create('31-12-1973');
$datetime2 = date_create('10-01-2019');
$interval = date_diff($datetime1, $datetime2);
echo $interval->format('Difference between two dates: %a days');

showTitle('Exercice 8 Date displayed like Thurday, 10 january 2019');
echo date('l\,j F\,Y', $t)."\n";
