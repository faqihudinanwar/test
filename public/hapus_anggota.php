<?php
$id = $_GET['id'];
//connect to database
require_once('db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die("could not connect to the databse<br/>" . $db->connect_error);
}
//delete data int database
//escape inputs dta
//asign a query
$query1 = "DELETE FROM anggota WHERE id_anggota=" . $id . "";
//execte the query
$result1 = $db->query($query1);
if (!$result1) {
    die("Could not query the database <br/>" . $db->error);
} else {

    header("location:data_anggota.php");
    $db->close();
    exit;
}
