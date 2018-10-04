<?php

require_once 'classes/DB.php';

$db = DB::get_instance();

$contact = [NULL,'Ewerton','Marschalk','Ewerton@hotmail.com','44444444444','5555555555555'];

//$db->query("",[]);
$db->query("INSERT INTO `contacts` (`id`,`fname`, `lname`, `email`, `cell_phone`, `home_phone`) VALUES (?, ?, ?, ?, ?, ?)",$contact);


$query = $db->query("SELECT * FROM contacts ORDER BY lname, fname");

$contacts = $query->get_results();
var_dump($contacts);