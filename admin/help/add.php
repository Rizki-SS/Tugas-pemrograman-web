<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");

$sql = "UPDATE HELPDESK SET STATUS=:status, ANSWER=:answer WHERE ID = :id";
$db = $Koneksi->prepare($sql);
$data = array(
    ":id" => $_POST["id"],
    ":answer" => $_POST["answer"],
    ":status" => 1
);
if ($db->execute($data)) {
    header("location:index.php");
} else {
    print_r($db->errorInfo());
}
