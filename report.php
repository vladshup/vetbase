<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');

$rnd = new renderPHPClass();

$rnd->o['title'] = "Отчет";
$rnd->o['left'] = "";
$rnd->o['center'] = "<h3>Отчет по прививкам</h3>";
$rnd->o['right'] = "<h3>Функции</h3>";
$rnd->o['result'] = "";

$now = time();
$year = 60*60*24*365;//год
$hmonth = 60*60*24*15;//15 дней

$rbarier = $now - $year; //порог по бешенству - через год
$ibarier = $now - $year; // порог по инфекциям - через год
$cbarier = $now - $hmonth; // порог по последнему звонку - через 15 дней

$query = sprintf("SELECT rabies, infection, kind, petname, ownerid FROM pets WHERE (((rabies < $rbarier) OR (infection < $ibarier)) AND (lastcall < $cbarier)) LIMIT 10");

	if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		$i = 0;
		while ($obj = $result->fetch_assoc()) {
		$i++;	
		$rnd->o['result'] .= "<tr>";
		$ownerid = $obj['ownerid'];
		
		$query = sprintf("SELECT * FROM owners WHERE id = '$ownerid'");
			if (!$res = $db->query($query))
			{
				echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
			}
			else
			{
				while ($own = $res->fetch_assoc()) {
					
					$fio = $own['fio'];
					//$phone = $own['phone'];
					
				}
				
			}
			
		
		$rnd->o['result'] .= "<td>$i</td>";
		if ($obj['kind'] == 0)
		{
			$rnd->o['result'] .= "<td>Кошка</td>";
		}
		if ($obj['kind'] == 1)
		{
			$rnd->o['result'] .= "<td>Собака</td>";
		}
		if ($obj['kind'] == 2)
		{
			$rnd->o['result'] .= "<td>Кролик</td>";
		}
		$petname = $obj['petname'];
		$rnd->o['result'] .= "<td>$petname</td><td><a href='/owner.php?id=$ownerid'>$fio</a></td>";
		$rnd->o['result'] .= "</tr>";
		}
		
	}


$rnd->render('tpl/report.html');