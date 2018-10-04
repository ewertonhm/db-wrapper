<?php

// imports db class
require_once 'DB.php';

// instance PDO
$db = DB::get_instance();

// array with values to be inserted in DB
$contact = [NULL,'Ewerton','Marschalk','Ewerton@hotmail.com','44444444444','5555555555555'];

//$db->query("",[]);
// values are ?, the function bind then to the array
$db->query("INSERT INTO `contacts` (`id`,`fname`, `lname`, `email`, `cell_phone`, `home_phone`) VALUES (?, ?, ?, ?, ?, ?)",$contact);

// the array is optcional, you can pass querys with no value, like a SELECT, it will return an object with the result
$query = $db->query("SELECT * FROM contacts ORDER BY lname, fname");


$contacts = $query->get_results();
var_dump($contacts);