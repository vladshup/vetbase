<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');

$rnd = new renderPHPClass();

$rnd->o['title'] = "ВетЛига";
$rnd->o['left'] = "";
$rnd->o['center'] = "<h3>Добавление нового животного</h3>";
$rnd->o['right'] = "<h3>Функции</h3>";
$rnd->o['fio'] = "";
$rnd->o['ownerid'] = "";

if (!empty($_GET['id']))
{
	$id = $db->real_escape_string($_GET['id']);
	$query = sprintf("SELECT * FROM owners WHERE id = $id");
	if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{		
		while ($owner = $result->fetch_assoc()) {
		$fio = $owner['fio'];
		$rnd->o['fio'] = $fio;
		$rnd->o['ownerid'] = $id;
		}		
	}
}


if (!empty($_POST['petname']))
{
	$petname = $db->real_escape_string($_POST['petname']);
	$ownerid = $db->real_escape_string($_POST['ownerid']);
	$kind = $db->real_escape_string($_POST['kind']);
	$sex = $db->real_escape_string($_POST['sex']);
	echo $_POST['birthday'] . "<br>";
	$birthday = d2unix($db->real_escape_string($_POST['birthday']));
	echo $birthday;
	$sterilized = $db->real_escape_string($_POST['sterilized']);
	$rabies = d2unix($db->real_escape_string($_POST['rabies']));
	$infection = d2unix($db->real_escape_string($_POST['infection']));	
	$lastchange = time();
	
	$query = sprintf("INSERT INTO pets (ownerid, petname, kind, sex, birthday, sterilized, rabies, infection, lastchange) VALUES ('$ownerid', '$petname', '$kind', '$sex', '$birthday', '$sterilized', '$rabies', '$infection', '$lastchange')");
	
	if (!$db->query($query))
	{
		echo "Не удалось добавить запись: (" . $db->errno . ") " . $db->error;
	}
	$petid = $db->insert_id;
	header("Location: http://localhost/pet.php?petid=$petid");
}



$rnd->render('tpl/addpet.html');
?>