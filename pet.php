<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');


$rnd = new renderPHPClass();

$cat = $dog = $rabbit = $man = $woman = $styes = $stno = "";


//Вывод карточки
if (!empty($_GET['petid']))
{
	$id = $db->real_escape_string($_GET['petid']);
	
	$query = sprintf("SELECT * FROM pets WHERE id = $id");
	
	if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		
		while ($pet = $result->fetch_assoc()) {
		$ownerid = $pet['ownerid'];
		$petname = $pet['petname'];
		$kind = $pet['kind'];
		$sex = $pet['sex'];
		$birthday = date("Y-m-d",$pet['birthday']);
		$sterilized = $pet['sterilized'];
		$rabies = date("Y-m-d",$pet['rabies']);
		$infection = date("Y-m-d",$pet['infection']);
		}
		
		if((int)$kind == 0)
		{
			$cat = "selected";
		}
		
		if((int)$kind == 1)
		{
			$dog = "selected";
		}

		if((int)$kind == 2)
		{
			$rabbit = "selected";
		}

		if((int)$sex == 0)
		{
			$man = "selected";
		}
		
		if((int)$sex == 1)
		{
			$woman = "selected";
		}

		if((int)$sterilized == 0)
		{
			$stno = "selected";
		}
		
		if((int)$sterilized == 1)
		{
			$styes = "selected";
		}		
	}	

	$query = sprintf("SELECT fio, phone FROM owners WHERE id = $ownerid");
	
		if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		
		while ($owner = $result->fetch_assoc()) {
		$fio = $owner['fio'];
		$phone = $owner['phone'];
		}
		
	}	
}

//Обновление карточки
if (!empty($_POST['petname']))
{
	$id = $db->real_escape_string($_POST['id']);
	$ownerid = $db->real_escape_string($_POST['ownerid']);
	$petname = $db->real_escape_string($_POST['petname']);
	$kind = $db->real_escape_string($_POST['kind']);
	$sex = $db->real_escape_string($_POST['sex']);
	$birthday = d2unix($db->real_escape_string($_POST['birthday']));
	$sterilized = $db->real_escape_string($_POST['sterilized']);
	$rabies = d2unix($db->real_escape_string($_POST['rabies']));
	$infection = d2unix($db->real_escape_string($_POST['infection']));	
	$lastchange = time();
	
	$query = sprintf("UPDATE pets SET ownerid='$ownerid', petname='$petname', kind='$kind', sex='$sex', birthday='$birthday', sterilized='$sterilized', rabies='$rabies', infection='$infection' WHERE id=$id");
	
	if (!$db->query($query))
	{
		echo "Не удалось добавить запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
	header("Location: http://localhost/pet.php?petid=$id");
	}
}

//Удаление карточки
if ((!empty($_GET['pid'])) AND ($_GET['del'] == "1"))
{
	$id = $db->real_escape_string($_GET['pid']);
	$ownerid = $db->real_escape_string($_GET['ownerid']);
	
	$query = sprintf("DELETE FROM pets WHERE id='$id'");
	
	if (!$db->query($query))
	{
		echo "Не удалось добавить запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
	header("Location: http://localhost/owner.php?id=$ownerid");
	}	
}


$rnd->o['title'] = "ВетЛига";
$rnd->o['left'] = "";
$rnd->o['center'] = "<h3>Карточка животного</h3>";
$rnd->o['right'] = "<h3>Функции</h3>";
$rnd->o['id'] = $id;
$rnd->o['ownerid'] = $ownerid;
$rnd->o['petname'] = $petname;
$rnd->o['kind'] = $kind;
$rnd->o['sex'] = $sex;
$rnd->o['birthday'] = $birthday;
$rnd->o['sterilized'] = $sterilized;
$rnd->o['rabies'] = $rabies;
$rnd->o['infection'] = $infection;
$rnd->o['cat'] = $cat;
$rnd->o['dog'] = $dog;
$rnd->o['rabbit'] = $rabbit;
$rnd->o['man'] = $man;
$rnd->o['woman'] = $woman;
$rnd->o['stno'] = $stno;
$rnd->o['styes'] = $styes;
$rnd->o['owner'] = "<a href=\"/owner.php?id=$ownerid\">$fio тел. $phone</a>";

$rnd->render('tpl/pet.html');