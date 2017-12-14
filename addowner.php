<?php
include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');


if (!empty($_POST['fio']))
{
	$fio = $db->real_escape_string($_POST['fio']);
	$phone = $db->real_escape_string($_POST['phone']);
	$address = $db->real_escape_string($_POST['address']);
	$data = time();
	
	$query = sprintf("INSERT INTO owners (fio, phone, address, data) VALUES ('$fio', '$phone', '$address', '$data')");
	
	if (!$db->query($query))
	{
		echo "Не удалось добавить запись: (" . $db->errno . ") " . $db->error;
	}
	$id = $db->insert_id;
	header("Location: http://localhost/owner.php?id=$id");
}


$rnd = new renderPHPClass();

$rnd->o['title'] = "ВетЛига";
$rnd->o['left'] = "";
$rnd->o['center'] = "<h3>Добавление нового владелеца</h3>";
$rnd->o['right'] = "<h3>Функции</h3>";

$rnd->render('tpl/addowner.html');