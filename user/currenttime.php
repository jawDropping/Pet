<?php
date_default_timezone_set('Singapore');
$date = date('m/d/Y h:i:s a', time());
echo "The current server timezone is: " . $date;
?>