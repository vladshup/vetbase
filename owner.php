<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');


$rnd = new renderPHPClass();
$rnd->o['result'] = "";



if (!empty($_GET['id']))
{
	$id = $db->real_escape_string($_GET['id']);
	
	$query = sprintf("SELECT fio, phone, address, lastcall FROM owners WHERE id = $id");
	
	if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		
		while ($owner = $result->fetch_assoc()) {
		$fio = $owner['fio'];
		$phone = $owner['phone'];
		$address = $owner['address'];
		$lastcall = $owner['lastcall'];
		}
	

	$query = sprintf("SELECT * FROM pets WHERE ownerid = $id");
	
	if (!$result = $db->query($query))
	{
		echo "Не удалось найти запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		$i = 0;
		while ($pet = $result->fetch_assoc()) {
		$i++;
		$rnd->o['result'] .= "<tr>";	
		$rnd->o['result'] .= "<td>$i</td>";
		$rnd->o['result'] .= "<td><a href='/pet.php?petid=" . $pet['id'] . "'>" . $pet['petname'] . "</a></td>";
		$rabies = date("d-m-Y", $pet['rabies']);
		$rnd->o['result'] .= "<td>$rabies</td>";
		$infection = date("d-m-Y", $pet['infection']);
		$rnd->o['result'] .= "<td>$infection</td>";
		$rnd->o['result'] .= "</tr>";
		}
		
	}
	
	}	

	
	
}


if(!empty($_POST['id']))
{
	$id = $db->real_escape_string($_POST['id']);
	$fio = $db->real_escape_string($_POST['fio']);
	echo $fio;
	$phone = $db->real_escape_string($_POST['phone']);
	$address = $db->real_escape_string($_POST['address']);
	$lastcall = d2unix($db->real_escape_string($_POST['lastcall']));
	$query = sprintf("UPDATE owners SET fio='$fio', phone='$phone', address='$address', lastcall = '$lastcall' WHERE id=$id");
	
	if (!$result = $db->query($query))
	{
		echo "Не удалось обновить запись: (" . $db->errno . ") " . $db->error;
	}
	else
	{
		$query = sprintf("UPDATE pets SET lastcall = '$lastcall' WHERE ownerid=$id");
		
		if (!$result = $db->query($query))
		{
			echo "Не удалось обновить запись: (" . $db->errno . ") " . $db->error;
		}
				
		header("Location: http://localhost/owner.php?id=$id");		
	}	
}

$rnd->o['title'] = "ВетЛига";
$rnd->o['left'] = "";
$rnd->o['center'] = "<h3>Карточка владелеца</h3>";
$rnd->o['right'] = "<h3>Функции</h3>";
$rnd->o['id'] = $id;
$rnd->o['fio'] = $fio;
$rnd->o['phone'] = $phone;
$rnd->o['address'] = $address;
$rnd->o['lastcall'] = date("Y-m-d",$lastcall);

$rnd->render('tpl/owner.html');