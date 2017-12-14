<?php

//Calendar html form to unixtime
function d2unix(string $dat)
{
$date = array();
$date = explode("-", $dat);
return mktime(0, 0, 0, (int)$date[1], (int)$date[2], (int)$date[0]);
}