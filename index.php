<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');
require_once (dirname(__FILE__) . '/backup.php');

$rnd = new renderPHPClass();

$rnd->o['title'] = "ВетЛига";
$rnd->o['left'] = "";
$rnd->o['center'] = "<h3>Поиск по базе</h3>";
$rnd->o['right'] = "<h3>Функции</h3>";
$rnd->o['result'] = "";
$rnd->o['numresults'] = "";


if (!empty($_POST['fio']))
{
	$search = $db->real_escape_string($_POST['fio']);
	//$query = sprintf("SELECT * FROM owners WHERE LOCATE ('$search', fio)");
	$query = sprintf("SELECT * FROM owners WHERE MATCH fio AGAINST ('$search')");
	
	if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		$i = 0;
		while ($owner = $result->fetch_assoc()) {
		$i++;	
		$rnd->o['result'] .= "<tr>";
		$rnd->o['result'] .= "<td>$i</td>";
		$rnd->o['result'] .= "<td><a href='/owner.php?id=" . $owner['id'] . "'>" . $owner['fio'] . "</a></td>";
		$rnd->o['result'] .= "<td>" . $owner['address'] . "</td>";
		$rnd->o['result'] .= "<td>" . $owner['phone'] . "</td>";
		$rnd->o['result'] .= "</tr>";
		}
		
	}
	
	$rnd->o['numresults'] = "Найдено записей - " . $result->num_rows;
}


$rnd->render('tpl/index.html');

