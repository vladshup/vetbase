<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');

$rnd = new renderPHPClass();

if (!empty($_POST['birthday']))
{
	$dat = $_POST['birthday'];
	$rnd->o['phpdat'] = $dat;
	echo date("Y-m-d", d2unix($dat));
	$rnd->o['dat'] = d2unix($dat);
	$rnd->o['data'] = date("Y-m-d", d2unix($dat));
}
else
{
	$rnd->o['dat'] = "";
	$rnd->o['data'] = "";
}
//$dat = "15.01.2015";


//echo date('d-m-Y', d2unix($dat));



$rnd->render('tpl/test.html');
/*
function d2unix(string $dat)
{
$date = array();
$date = explode(".", $dat);
return mktime(0, 0, 0, $date[1], $date[0], $date[2]);
}
*/
?>