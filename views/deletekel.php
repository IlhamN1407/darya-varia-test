<?php

include_once("../conndb.php");


$id = $_GET['id'];
$idpeg = $_GET['idx'];


$sql = "DELETE FROM table_keluarga WHERE kl_id=$id";
if ($mysqli->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: edit.php?idx=$idpeg");
} else {
    echo "Error deleting record: " . $mysqli->error;
}
